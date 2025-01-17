<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
                'null' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
                'null' => false,
            ],
            'password' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 70,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'role' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'null' => false,
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
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
