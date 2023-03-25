<?php

namespace App\Actions\Install;
use Illuminate\Support\Facades\Artisan;

class SuperAdmin
{
    public function execute()
    {
        $this->createSuperAdmin();
    }

    private function createSuperAdmin()
    {
        Artisan::call('create:superadmin', [
            'name' => 'Super Admin',
            'email' => env('SUPER_ADMIN_EMAIL'),
            'password' => env('SUPER_ADMIN_PASSWORD'),
        ]);
    }

}