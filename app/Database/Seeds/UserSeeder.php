<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Password;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username'     => 'admin',
                'email'    => 'admin@gmail.com',
                'password_hash' => Password::hash('12345678'),
                'active'=> '1'
                 
            ]
        ];
        $groups = [
            [
                'id'     => '1',
                'name'    => 'admin',
                'description' => 'admin'
            ],
            [
                'id'     => '2',
                'name'    => 'user',
                'description' => 'user'
            ],
        ];
        $groupUser = [
            [
                'group_id'     => '1',
                'user_id'    => '1',
                
            ]
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($users);
        $this->db->table('auth_groups')->insertBatch($groups);
        $this->db->table('auth_groups_users')->insertBatch($groupUser);
    
    }
}
