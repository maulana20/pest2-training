<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class MenuComponent extends BaseComponent
{
    public function selector(): string
    {
        return '';
    }

    public function assert(Browser $browser): void
    {
        $browser->assertVisible($this->selector());
    }

    public function elements(): array
    {
        return [
            '@menu' => '#navbarDropdown',
        ];
    }

    public function selectMenu($browser, $label)
    {
        $browser->click('@menu')
            ->clickAtXPath("//a[contains(text(), '{$label}')]");
    }
}
