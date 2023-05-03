<?php

namespace App\Enums;

enum Permission: string
{
    case ADMIN   = 'admin';
    case SUPPORT = 'support';

    
    public function description(): string
    {
        return match ($this) {
            Permission::ADMIN   => "Administration",
            Permission::SUPPORT => "Support Team"
        };
    }
}