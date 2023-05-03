<?php

it('function test', function () {
    $description = \App\Enums\Permission::SUPPORT->description();
    $this->assertEquals($description, 'Support Team');
});