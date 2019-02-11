<?php
namespace App\Http\Controllers\Dashboard;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\User;
use Hash;
use DB;

class DashboardController extends AppBaseController
{
	public function index(Request $request)
    {
        return view('dashboard.index');
    }
}