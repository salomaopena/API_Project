<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ApiKeysSeeder extends Seeder
{
    public function run()
    {
        //
        $api_clients = [
            [
                'project_id'    => 0001,
                'api_key' => password_hash('4Oaz3Kc23c6$*GU!lB8ADA$!9Nkf7*1R', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'project_id'    => 0002,
                'api_key' => password_hash('2Kedc_Q1$*_t4Fz^Vy1$5D9Sv8-fg!55', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            // add more clients here...
        ];

        $this->db->table('api_keys')->insertBatch($api_clients);

        echo PHP_EOL . 'inseridos ' . count($api_clients) . ' registos' . PHP_EOL;
    }
}
