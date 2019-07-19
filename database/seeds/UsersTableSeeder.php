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
            'name'      => 'diretoria',
            'email'     => 'diretoria@gmail.com',
            'password'  => bcrypt('123456'),
        ]);


        user::create([
            'name'      => 'financeiro',
            'email'     => 'financeiro@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

        user::create([
            'name'      => 'secretaria-suporte',
            'email'     => 'secretaria-suporte@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

        user::create([
            'name'      => 'franqueado',
            'email'     => 'franqueado@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

        user::create([
            'name'      => 'franqueador',
            'email'     => 'franqueador@gmail.com',
            'password'  => bcrypt('123456'),
        ]);


        user::create([
            'name'      => 'consultor',
            'email'     => 'consultor@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

        user::create([
            'name'      => 'investidor',
            'email'     => 'investidor@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

    }
}
