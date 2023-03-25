<?php

namespace App\Actions\Install;
use Illuminate\Support\Facades\Artisan;
use Dotenv\Dotenv;

class SuperAdmin
{
    public function execute()
    {
        Dotenv::createImmutable(base_path())->load();
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