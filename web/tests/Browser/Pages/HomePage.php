<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;
use Tests\Browser\Components\MenuComponent;
use App\Providers\RouteServiceProvider;

class HomePage extends Page
{
    public function url(): string
    {
        return RouteServiceProvider::HOME;
    }

    public function elements(): array
    {
        return [
            '@element' => '#selector',
        ];
    }

    public function sendLogout($browser)
    {
        $browser->within(new MenuComponent, fn ($browser) => $browser->selectMenu('Logout'))
            ->screenshot('can_logout')
            ->assertPathIs('/')
            ->assertGuest();
    }

    public function mustVerify($browser)
    {
        $browser->screenshot('can_login_must_verify')
            ->assertPathIs('/email/verify')
            ->assertSee('Verify Your Email Address');
    }
}
