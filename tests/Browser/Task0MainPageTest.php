<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class Task0MainPageTest extends DuskTestCase
{
    public function testSeeMainPage()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->assertSee('Best Car Hire Deals');
        });
    }
}
