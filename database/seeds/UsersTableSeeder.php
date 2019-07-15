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
        user::create([
            'name'      => 'Rafael',
            'email'     => 'rafazingano@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

        user::create([
            'name'      => 'Teste',
            'email'     => 'teste@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
    }
}
