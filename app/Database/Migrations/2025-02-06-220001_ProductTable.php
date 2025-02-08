<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'product_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'price_per_unit' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'stock' => [
                'type' => 'INT',
                'constraint' => 11
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

        $this->forge->createTable('products');
    }

    public function down()
    {
        //drop table
        $this->forge->dropTable('products');
    }
}
