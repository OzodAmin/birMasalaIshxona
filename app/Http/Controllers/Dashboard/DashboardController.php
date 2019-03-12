<?php
namespace App\Http\Controllers\Dashboard;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\RequestModel;
use App\User;
use Entrust;
use Hash;
use DB;

class DashboardController extends AppBaseController
{
	private $locale;

	public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->locale = LaravelLocalization::getCurrentLocale();
    }

	public function index(Request $request)
    {
        return view('dashboard.index');
    }

    public function notification($id)
    {
        if (Entrust::can('offer-price')) {
            $notification = RequestModel::where('id', $id)->first();
            return view('dashboard.notification', compact(['notification']));
        }
        abort(404, 'Unauthorized action.');        
    }
}