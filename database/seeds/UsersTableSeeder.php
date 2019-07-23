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
        $user = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

        $user->roles()->sync(1,2);

        User::create([
            'name'      => 'diretoria',
            'email'     => 'diretoria@gmail.com',
            'password'  => bcrypt('123456'),
        ]);


        User::create([
            'name'      => 'financeiro',
            'email'     => 'financeiro@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

        User::create([
            'name'      => 'secretaria-suporte',
            'email'     => 'secretaria-suporte@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

        User::create([
            'name'      => 'franqueado',
            'email'     => 'franqueado@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

        User::create([
            'name'      => 'franqueador',
            'email'     => 'franqueador@gmail.com',
            'password'  => bcrypt('123456'),
        ]);


        User::create([
            'name'      => 'consultor',
            'email'     => 'consultor@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

        User::create([
            'name'      => 'investidor',
            'email'     => 'investidor@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

    }
}
