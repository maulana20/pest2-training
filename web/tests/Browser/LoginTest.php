<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;
use Tests\Browser\Pages\HomePage;
use Tests\DuskTestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create()->first();
    }

    public function test_can_login(): void
    {
        $user = $this->user;
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new LoginPage)
                ->sendLogin($user);
        });
    }

    public function test_can_logout(): void
    {
        $user = $this->user;
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(new HomePage)
                ->sendLogout();
        });
    }

    public function test_can_login_must_verify(): void
    {
        $user = User::factory()->unverified()->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(new HomePage)
                ->mustVerify();
        });
    }
}
