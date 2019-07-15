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
        		'description' => 'Admin'
            ],
            [
        		'name' => 'diretoria',
        		'display_name' => 'Diretoria',
        		'description' => 'Diretoria'
            ],
            [
        		'name' => 'financeiro',
        		'display_name' => 'Financeiro',
        		'description' => 'Financeiro'
            ],
            [
        		'name' => 'secretaria-suporte',
        		'display_name' => 'Secretaria/suporte',
        		'description' => 'Secretaria/suporte'
            ],
            [
        		'name' => 'franqueado',
        		'display_name' => 'Franqueado',
        		'description' => 'Franqueado'
            ],
            [
        		'name' => 'franqueador',
        		'display_name' => 'Franqueador',
        		'description' => 'Franqueador'
            ],
            [
        		'name' => 'consultor',
        		'display_name' => 'Consultor',
        		'description' => 'Consultor'
            ],
            [
        		'name' => 'investidor',
        		'display_name' => 'Investidor',
        		'description' => 'Investidor'
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
