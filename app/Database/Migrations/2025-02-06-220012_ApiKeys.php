<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApiKeys extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11, 
                'auto_increment' => TRUE
            ],
            'project_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'api_key' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'active' => [
                'type' => 'INT',
                'constraint' => 1
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('api_keys');
    }

    public function down()
    {
        //
        $this->forge->dropTable('api_keys');
    }
}