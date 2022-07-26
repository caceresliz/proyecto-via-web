<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Liz',
            'apellido' => 'Caceres',
            'ci' => 14471315,
            'email' => 'lizcaceres@gmail.com',
            'password' => Hash::make('12345678'),
            'rol' => 'GERENTE',
            'created_at' => date('Y-m-d H:s:i'),
            'updated_at' => date('Y-m-d H:s:i')
        ]);
        $user1->assignRole('GERENTE');
    }
}
