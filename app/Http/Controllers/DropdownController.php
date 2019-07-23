<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Country;
use App\State;
use App\City;

class DropdownController extends Controller
{
    
        public function index()
        {
            $countries = DB::table("countries")->pluck("name","id");
            return view('index',compact('countries'));
        }

        public function getStateList(Request $request)
        {
            $states = DB::table("states")
            ->where("country_id",$request->country_id)
            ->pluck("name","id");
            return response()->json($states);
        }

        public function getCityList(Request $request)
        {

            if((int) $request->all <= 0){
                $cities = auth()
                ->user()
                ->cities()
                ->where("state_id",$request->state_id)
                ->pluck('cities.name', 'cities.id');
            }else{
                $cities = City::where("state_id",$request->state_id)
                ->get()
                ->pluck('name', 'id');
            }

            /*
            $cities = DB::table("cities")
            ->where("state_id",$request->state_id)
            ->pluck("name","id");
            */
            return response()->json($cities);
        }
}