<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;
use App\Providers\RouteServiceProvider;

class LoginPage extends Page
{
    public function url(): string
    {
        return '/login';
    }

    public function assert(Browser $browser): void
    {
        $browser->assertPathIs($this->url());
    }

    public function elements(): array
    {
        return [
            '@element' => '#selector',
        ];
    }

    public function sendLogin($browser, $user)
    {
        $browser->type('email', $user->email)
            ->type('password', 'password')
            ->press('Login')
            ->screenshot('can_login')
            ->assertPathIs(RouteServiceProvider::HOME)
            ->assertSee('Dashboard');
    }
}
