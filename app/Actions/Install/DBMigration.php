<?php

namespace App\Actions\Install;

use App\Utilities\Database;
use Illuminate\Support\Facades\Artisan;

class DBMigration
{
    public function execute()
    {
        if (Database::isDbValid(
            env('DB_HOST'),
            env('DB_PORT'),
            env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD')
        )) {
            return false;
        }
        $this->migrate();
        return true;
    }

    private function migrate()
    {
        Artisan::call('migrate', [
            '--force' => true,
        ]);
    }
}