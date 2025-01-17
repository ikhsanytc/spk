<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kriteria' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
                'null' => true,
            ],
            'kode_kriteria' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['Benefit', 'Cost'],
                'null' => false,
            ],
            'bobot' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'ada_pilihan' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_kriteria', true);
        $this->forge->createTable('kriteria');
    }

    public function down()
    {
        $this->forge->dropTable('kriteria');
    }
}
