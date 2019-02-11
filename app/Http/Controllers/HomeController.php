<?php
namespace App\Http\Controllers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;
use App\User;
use Hash;
use DB;

class HomeController extends AppBaseController
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function registeration(Request $request)
    {
        $this->validate($request, User::$rules);

        $request->merge([
            'status' => 1,
            'password' => str_random(8)
        ]);

        if ($request['role'] == 8) {
        	$request->merge(['username' => 'U'.$request['inn']]);
        }elseif ($request['role'] == 9) {
        	$request->merge(['username' => 'Z'.$request['inn']]);
        }
       
        $request['password'] = Hash::make($request['password']);
        $input = $request->except(['remember_token', 'role']);
        $user = User::create($input);
        
        $user->attachRole($request['role']);

        return back()->with('success','Registration success');
    }

    public function profile(){
        $user = User::find(auth()->id());

        if (empty($user)) {
            return abort(404);
        }

        return view('dashboard.profile.profileShow',compact('user')); 
    }

    public function profileEdit(){
        $user = User::find(auth()->id());

        if (empty($user)) {
            return abort(404);
        }

        return view('dashboard.profile.profileEdit',compact('user')); 
    }

    public function getCities(){
    	$locale = LaravelLocalization::getCurrentLocale();
    	$cities = DB::table('city_translations')
            ->select("city_id", "title")
            ->where("locale", $locale)
            ->get();
    	return response()->json($cities);
    }

    public function getDistricts(Request $request){
    	$locale = LaravelLocalization::getCurrentLocale();
    	$districts = DB::table('district_translations')
    		->join('district', 'district_translations.district_id', '=', 'district.id')
            ->select("district_translations.district_id", "district_translations.title")
            ->where("district_translations.locale", $locale)
            ->where("district.district_city_id", $request->city_id)
            ->get();
    	return response()->json($districts);
    }
}
