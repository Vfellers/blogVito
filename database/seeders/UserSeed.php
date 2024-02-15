<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Victor Feller",
            "email" => "victor.feller@gmail.com",
            "password" => bcrypt("123")              //bccrypt é pra encriptografar a senha
        ]);
    }
}
