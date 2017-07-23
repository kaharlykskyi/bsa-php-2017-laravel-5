<?php

namespace Tests\Feature;

use App\Entity\User;
use Tests\MigrateWithData;
use Tests\TestCase;

class Task3AuthorizationTest extends TestCase
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
    }

    private function createAdmin()
    {
        $this->admin = factory(User::class)->create([
            'is_admin' => true
        ]);
    }

    public function testUserCanAccessApi()
    {
        $this->createUser();

        $this->actingAs($this->user)
            ->json('get', '/api/cars')
            ->assertStatus(200);

        $this->actingAs($this->user)
            ->json('get', '/api/cars/1')
            ->assertStatus(200);
    }

    public function testAdminCanAccessApi()
    {
        $this->createAdmin();

        $this->actingAs($this->admin)
            ->json('get', '/api/cars')
            ->assertStatus(200);

        $this->actingAs($this->admin)
            ->json('get', '/api/cars/1')
            ->assertStatus(200);
    }

    public function testUserCanNotAccessAdminApi()
    {
        $this->createUser();

        $this->actingAs($this->user)
            ->json('get', '/api/admin/cars')
            ->assertStatus(403);

        $this->actingAs($this->user)
            ->json('get', '/api/admin/cars/1')
            ->assertStatus(403);

        $this->actingAs($this->user)
            ->json('post', '/api/admin/cars')
            ->assertStatus(403);

        $this->actingAs($this->user)
            ->json('put', '/api/admin/cars/1')
            ->assertStatus(403);

        $this->actingAs($this->user)
            ->json('delete', '/api/admin/cars/1')
            ->assertStatus(403);
    }

    public function testAdminCanAccessAdminApi()
    {
        $this->createAdmin();

        $this->actingAs($this->admin)
            ->json('get', '/api/admin/cars')
            ->assertStatus(200);

        $this->actingAs($this->admin)
            ->json('get', '/api/admin/cars/1')
            ->assertStatus(200);

        $this->actingAs($this->admin)
            ->json('post', '/api/admin/cars')
            ->assertStatus(200);

        $this->actingAs($this->admin)
            ->json('put', '/api/admin/cars/1')
            ->assertStatus(200);

        $this->actingAs($this->admin)
            ->json('delete', '/api/admin/cars/1')
            ->assertStatus(200);
    }
}
