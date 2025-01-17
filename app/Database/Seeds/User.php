<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $this->db->table('user')->insert([
            'username' => 'ikhsan',
            'password' => password_hash('ikhsan123', PASSWORD_DEFAULT),
            'nama' => 'ikhsan',
            'email' => 'ikhsanm181209@gmail.com',
            'role' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null,
        ]);
    }
}
