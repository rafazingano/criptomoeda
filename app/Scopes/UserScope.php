<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class UserScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::user();
        if($user->hasRole('investidor')){
            $builder->where('user_id', $user->id);
        }
        if($user->hasRole('consultor')){
            $builder->where('user_id', $user->id)->orWhere('user_id', $user->user_id);
        }
        if($user->hasRole('franqueado')){
            $builder->where('user_id', $user->id)->orWhere('user_id', $user->user_id);
        }
        if($user->hasRole('franqueador')){
            $builder->where('user_id', $user->id)->orWhere('user_id', $user->user_id);
        }



    }
}
