<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class Financeiro extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'financeiro:now';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Financeiro change';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach(User::all() as $user){
            if($user->balance){
                $valor = $user->balance->amount;
                $valor = $valor + ((17/100)*$valor);
                $user->balance()->update(['amount' => $valor]);
            }
        }
    }
}
