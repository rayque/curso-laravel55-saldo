<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'name'      => 'Rayque Oliveira',
          'email'     => 'rayque@rayque.com',
          'password'  => bcrypt('123456')
        ]);

        User::create([
          'name'      => 'Outro Usuário',
          'email'     => 'contato@rayque.com',
          'password'  => bcrypt('123456')
        ]);
    }
}
