<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminSeeder extends Seeder
{
    
     
    public function run(): void
    {
        $users= [
            [
                'name' => 'Guru Waka',
                'email' => 'waka@example.com',
                'password' => bcrypt('wakaskt56'),
                'role' => 'admin'
            ],
            [
                  'name' => 'Guru Ketertipan',
                    'email' => 'ketertipan@example.com',
                    'password' => bcrypt('ketertipanskt56'),
                    'role' => 'admin'
            ]
        ];
            foreach ($users as $user) {
    User::firstOrCreate(
        ['email' => $user['email']], 
        $user 
    );
}
    }

}
