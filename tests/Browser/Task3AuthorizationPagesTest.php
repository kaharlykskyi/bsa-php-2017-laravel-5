<?php

namespace Tests\Browser;

use App\Entity\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\MigrateWithData;

class Task3AuthorizationPagesTest extends DuskTestCase
{
    use MigrateWithData;

    public function setUp()
    {
        parent::setUp();

        $this->migrateWithData();
    }

    private function createUser()
    {
        $this->user = factory(User::class)->create();
        return $this->user;
    }

    private function createAdmin()
    {
        $this->admin = factory(User::class)->create([
            'is_admin' => true
        ]);

        return $this->admin;
    }

    public function testUserDontSeeCreateCarPage()
    {
        $this->createUser();

        $this->browse(function ($browser) {
            $browser
                ->loginAs($this->user)
                ->visit('/cars/create')
                ->assertPathIs('/');
        });
    }

    public function testUserDontSeeEditCarPage()
    {
        $this->createUser();

        $this->browse(function ($browser) {
            $browser
                ->loginAs($this->user)
                ->visit('/cars/1/edit')
                ->assertPathIs('/');
        });
    }

    public function testUserCantDeleteCar()
    {
        $this->createUser();

        $this->actingAs($this->user)
            ->withSession(['X-CSRF-TOKEN' => csrf_token()])
            ->delete('/cars/1', [
                '_token' => csrf_token(),
            ])
            ->assertRedirect('/');

        $this->assertDatabaseHas('cars', [
            'id' => 1
        ]);
    }

    public function testAdminSeeCreateCarPage()
    {
        $this->createAdmin();

        $this->browse(function ($browser) {
            $browser
                ->loginAs($this->admin)
                ->visit('/cars/create')
                ->assertPathIs('/cars/create');
        });
    }

    public function testAdminSeeEditCarPage()
    {
        $this->createAdmin();

        $this->browse(function ($browser) {
            $browser
                ->loginAs($this->admin)
                ->visit('/cars/1/edit')
                ->assertPathIs('/cars/1/edit');
        });
    }

    public function testAdminCanDeleteCar()
    {
        $this->createAdmin();

        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->admin)
                ->visit('/cars/1')
                ->assertSee('Delete')
                ->click('.delete-button')
                ->assertPathIs('/cars');
        });

        $this->assertDatabaseMissing('cars', [
            'id' => 1
        ]);
    }
}
