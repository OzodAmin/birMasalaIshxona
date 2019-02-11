<?php

namespace App\Http\Controllers\Admin;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
use App\Models\UserStatus;
use App\User;
use App\Role;
use Flash;
use Hash;
use DB;

class UserController extends AppBaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepo){
        $this->userRepository = $userRepo;}

    public function index(Request $request)
    {
        $this->userRepository->pushCriteria(new RequestCriteria($request));

        $users = $this->userRepository->paginate(20);

        return view('admin.users.index')->with('users', $users);

    }

    public function create()
    {
        $statuses = UserStatus::whereTranslation('locale', 'ru')->get();

        $statusArray = [];

        foreach($statuses as $city) {
            $statusArray[$city->id] = $city->name;
        }


        return view('admin.users.create',compact('statusArray')); 
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'discount' => 'integer|required',
            'email' => 'required|email|max:255|unique:users',
            'sex' => 'required',
            'dob' => 'required',
            'companyName' => 'required', 
            'companyLegalName' => 'required',
            'mobile' => 'required',
            'phone' => 'required', 
            'cityId' => 'required', 
            'districtId' => 'required', 
            'address' => 'required'
        ]);

        $password = str_random(8);

        $request->merge([
            'password' => $password
        ]);

        $request['password'] = Hash::make($request['password']);
        $input = $request->only('name', 'email', 'password', 'sex', 'dob', 'companyName', 'mobile', 'phone', 'cityId', 'districtId', 'address', 'companyLegalName', 'discount');
        $user = User::create($input);
        
        $user->attachRole(5);

        $user->password = $password;

        Mail::to($user->email)->send(new DemoMail($user));

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    public function show($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        return view('admin.users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        $statuses = UserStatus::whereTranslation('locale', 'ru')->get();

        $statusArray = [];

        foreach($statuses as $city) {
            $statusArray[$city->id] = $city->name;
        }

        return view('admin.users.edit',compact('user','statusArray'));
    }

    public function update(Request $request, $id)
    {
        //$this->validate($request, [User::$rules]);

        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $input = $request->except(['_method', '_token']);

        if ($user->status == 1 && $request['status'] == 2) {

            $password = str_random(8);
            $user->password = $password;
            Mail::to($user->email)->send(new DemoMail($user));
            $request->merge([
                'password' => Hash::make($password)
            ]);

        }

        $input = $request->except(['_method', '_token']);
        $user->update($input); 

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        $user->status = 7;
        $user->update(); 

        Flash::success('Статус пользователя '.$user->name.': "Заблокирован сотрудником РКП".');

        return redirect(route('users.index'));
    }

    public function reset($id)
    {
        $user = User::find($id);
        $password = str_random(8);
        $hashPassword = array('password' => Hash::make($password));
        $user->update($hashPassword);
        $user->password = $password;
        Mail::to($user->email)->send(new DemoMail($user));

        Flash::success('Reset password send successfully.');

        return redirect(route('users.index'));
    }
}