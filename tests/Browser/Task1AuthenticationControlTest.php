<?php

namespace Tests\Browser;

use App\Entity\User;
use Tests\DuskTestCase;
use Tests\MigrateWithData;

class Task1AuthenticationControlTest extends DuskTestCase
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

    public function testUnauthorizedDontSeePages()
    {
        $this->browse(function ($browser) {
            $browser->visit('/cars')->assertPathIs('/login');
            $browser->visit('/cars/1')->assertPathIs('/login');
        });
    }

    public function testAuthorizedSeePages()
    {
        $this->createUser();

        $this->browse(function ($browser) {
            $browser
                ->loginAs($this->user)
                ->visit('/cars')->assertPathIs('/cars');
            $browser->visit('/cars/1')->assertPathIs('/cars/1');
        });
    }
}
