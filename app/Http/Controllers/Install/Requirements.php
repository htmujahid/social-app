<?php

namespace App\Http\Controllers\Install;

use App\Actions\Install\DBMigration;
use App\Actions\Install\SuperAdmin;
use App\Actions\Install\RolePermission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Requirements extends Controller
{
    public function index(Request $request)
    {
        (new DBMigration)->execute();
        (new RolePermission)->execute();
        (new SuperAdmin)->execute();

        $this->finalTouches();

        return redirect()->route('login');
    }

    private function finalTouches(){
         // Update .env file
         $env = [
            'APP_INSTALLED' => 'true',
        ];

        static::updateEnv($env);
    }

    private static function updateEnv($data)
    {
        if (empty($data) || !is_array($data) || !is_file(base_path('.env'))) {
            return false;
        }

        $env = file_get_contents(base_path('.env'));

        $env = explode("\n", $env);

        foreach ($data as $data_key => $data_value) {
            $updated = false;

            foreach ($env as $env_key => $env_value) {
                $entry = explode('=', $env_value, 2);

                // Check if new or old key
                if ($entry[0] == $data_key) {
                    $env[$env_key] = $data_key . '=' . $data_value;
                    $updated = true;
                } else {
                    $env[$env_key] = $env_value;
                }
            }

            // Lets create if not available
            if (!$updated) {
                $env[] = $data_key . '=' . $data_value;
            }
        }

        $env = implode("\n", $env);

        file_put_contents(base_path('.env'), $env);

        return true;
    }
}
