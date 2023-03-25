<?php

namespace App\Actions\Install;


use Spatie\Permission\Models\Role;

class RolePermission
{
    public function execute()
    {
        if (!Role::where('name', 'admin')->exists()) {
            $admin = Role::create(['name' => 'admin']);
        }
        if (!Role::where('name', 'user')->exists()) {
            $user = Role::create(['name' => 'user']);
        }
    }
}