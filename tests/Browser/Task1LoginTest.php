<?php

namespace Tests\Browser;

use App\Entity\User;
use Illuminate\Support\Facades\Artisan;
use Tests\DuskTestCase;

class Task1LoginTest extends DuskTestCase
{
    private $user;

    public function setUp()
    {
        parent::setUp();
        Artisan::call("migrate:refresh");
    }

    public function testLoginButton()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->assertSeeLink('Login')
                ->clickLink('Login')
                ->assertPathIs('/login');
        });
    }

    public function testLogin()
    {
        $this->user = factory(User::class)->create([
            'email' => 'taylor@laravel.com',
        ]);

        $this->createBrowsersFor(function ($browser) {
            $browser->visit('/login')
                ->type('email', $this->user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/cars')
                ->assertDontSeeLink('Login');
        });
    }
}
