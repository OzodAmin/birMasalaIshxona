<?php

namespace App\Http\Controllers\Admin;

use Flash;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserStatusController extends Controller
{
    public function index()
    {
        $statuses = UserStatus::whereTranslation('locale', 'ru')->paginate(10);
        return view('admin.userStatuses.index',compact('statuses'));
    }

    public function edit($id)
    {
        $status = UserStatus::findOrFail($id);
        return view('admin.userStatuses.edit',compact('status'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [UserStatus::$rules]);

        $status = UserStatus::findOrFail($id);
        if (empty($status)) {
            Flash::error('Status not found');
            return redirect(route('user_statuses.index'));
        }

        $status->update($request->except(['_token', '_method'])); 

        Flash::success('Status updated successfully.');

        return redirect(route('user_statuses.index'));   
    }

    public function create(){}
    public function store(Request $request){}
    public function show($id){}
    public function destroy($id){}
}
