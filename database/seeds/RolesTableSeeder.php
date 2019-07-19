<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
        	[
        		'name' => 'admin',
        		'display_name' => 'Admin',
                'description' => 'Admin',
                'nivel' => 8
            ],
            [
        		'name' => 'diretoria',
        		'display_name' => 'Diretoria',
        		'description' => 'Diretoria',
                'nivel' => 7
            ],
            [
        		'name' => 'financeiro',
        		'display_name' => 'Financeiro',
        		'description' => 'Financeiro',
                'nivel' => 6
            ],
            [
        		'name' => 'secretaria-suporte',
        		'display_name' => 'Secretaria/suporte',
        		'description' => 'Secretaria/suporte',
                'nivel' => 5
            ],
            [
        		'name' => 'franqueado',
        		'display_name' => 'Franqueado',
        		'description' => 'Franqueado',
                'nivel' => 4
            ],
            [
        		'name' => 'franqueador',
        		'display_name' => 'Franqueador',
        		'description' => 'Franqueador',
                'nivel' => 3
            ],
            [
        		'name' => 'consultor',
        		'display_name' => 'Consultor',
        		'description' => 'Consultor',
                'nivel' => 2
            ],
            [
        		'name' => 'investidor',
        		'display_name' => 'Investidor',
        		'description' => 'Investidor',
                'nivel' => 1
            ]

        ];


        foreach ($roles as $key => $value) {
        	Role::create($value);
        }

        foreach (User::all() as $user) {
        	$user->roles()->sync(Role::all()->pluck('id'));
        }
    }
}
