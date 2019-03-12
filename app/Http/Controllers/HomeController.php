<?php
namespace App\Http\Controllers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;
use App\Mail\RegisterMail;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use App\User;
use Hash;
use Mail;
use DB;

class HomeController extends AppBaseController
{
    private $locale;

    public function __construct()
    {
        $this->locale = LaravelLocalization::getCurrentLocale();
    }

    public function index(Request $request)
    {
        $products = Product::whereTranslation('locale', $this->locale)->
                    where('status', 3)->where('expire_at', '>', Carbon::now())->take(5)->get();

        $categories = Category::whereTranslation('locale', $this->locale)->get();
        return view('home.home', compact(['categories', 'products']));
    }

    public function categoryPage()
    {
        $categories = Category::whereTranslation('locale', $this->locale)->get();
        return view('home.categories', compact(['categories']));
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
       
        $password = $request['password'];
        $request['password'] = Hash::make($request['password']);
        $input = $request->except(['remember_token', 'role']);
        $user = User::create($input);
        
        $user->attachRole($request['role']);

        Mail::to($user->email)->send(new RegisterMail());

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
}
