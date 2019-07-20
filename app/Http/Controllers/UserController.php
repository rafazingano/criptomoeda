<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\City;
use DB;
use Hash;
use Auth;


class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name','id');
        $cities = City::all()->pluck('name', 'id');
        return view('users.create',compact('roles', 'cities'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $consultor = false;
        foreach ($request->input('roles') as $key => $value) {

            $user->attachRole($value);
            if(7 == $value){
                $consultor = true;
            }
        }

        if($input['cities']){
            $user->cities()->sync($input['cities']);
        }

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $nivel = (auth()->user()->roles()->count() > 0)? auth()->user()->roles()->first()->nivel : 1;
        //$roles = Role::where('nivel', '<=', $nivel)->pluck('display_name','id');
        $roles = Role::all()->pluck('display_name','id');
        $userRole = $user->roles->pluck('id','id')->toArray();
        $cities = City::all()->pluck('name', 'id');


        return view('users.edit',compact('user','roles','userRole', 'cities'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }


        $user = User::find($id);

        $user->update($input);
        DB::table('role_user')->where('user_id',$id)->delete();
        //DB::table('cities')->where('user_id',$id)->delete();

        $consultor = false;
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
            if(7 == $value){
                $consultor = true;
            }
        }

        if(isset($input['cities'])){
            $user->cities()->sync($input['cities']);
        }
/*
        if(isset($input['roles'])){
            $user->roles(true)->sync($input['roles']);
        }
*/

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
