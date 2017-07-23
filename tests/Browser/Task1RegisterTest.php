<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Artisan;
use Tests\DuskTestCase;

class Task1RegisterTest extends DuskTestCase
{
    private $userData = [
        'first_name' => 'test',
        'last_name' => 'test',
        'password' => 'secret',
        'email' => 'example@example.com',
    ];

    public function setUp()
    {
        parent::setUp();
        Artisan::call("migrate:refresh");
    }

    public function testRegisterButton()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->assertSeeLink('Register')
                ->clickLink('Register')
                ->assertPathIs('/register');
            ;
        });
    }

    public function testCreatesUser()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                ->assertSee('Register')
                ->type('first_name', $this->userData['first_name'])
                ->type('last_name', $this->userData['last_name'])
                ->type('email', $this->userData['email'])
                ->value('input[name=password]', $this->userData['password'])
                ->value('input[name=password_confirmation]', $this->userData['password'])
                ->press('Register');
        });

        $this->assertDatabaseHas('users', [
            'first_name' => $this->userData['first_name'],
            'last_name' => $this->userData['last_name'],
            'email' => $this->userData['email'],
        ]);
    }
}
