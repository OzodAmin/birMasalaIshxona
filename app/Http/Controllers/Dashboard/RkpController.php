<?php
namespace App\Http\Controllers\Dashboard;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AppBaseController;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Rkp;
use App\User;
use Flash;
use Auth;
use DB;


class RkpController extends AppBaseController
{
	private $locale;

	public function __construct()
    {
        $this->middleware('auth');
        $this->locale = LaravelLocalization::getCurrentLocale();
    }

	public function index(Request $request)
    {
    	$rkps = Rkp::where('user_id', auth()->id())->
    				orderBy('status_id', 'asc')->
    				paginate(15);
        return view('dashboard.rkps.index',compact(['rkps']));
    }

    public function create()
    {
        $userCurrency = DB::table('rkp')->select('currency_id')->where('user_id', auth()->id())->get();
        $userCurrencyArray = [];
        foreach($userCurrency as $item) {$userCurrencyArray[] = $item->currency_id;}

        $currency = Currency::whereNotIn('id', $userCurrencyArray)->get();
    	$currencyArray = [];
        foreach($currency as $item) {$currencyArray[$item->id] = $item->code;}

        return view('dashboard.rkps.create', compact(['currencyArray']));
    }

    public function store(Request $request)
    {
    	$this->validate($request, Rkp::$rules);
    	
    	$request->merge([
    		'user_id' => auth()->id(),
    		'status_id' => 1,
            'saldo' => 0,
    		'inp' => Auth::user()->inn,
        ]);
        
        $rkp = new Rkp();
        $rkp->fill($request->except(['_token']));

        if ($request->hasFile('featured_image')) {
            $rkp->featured_image = $this->uploadPhoto( $request->file('featured_image') );
        }

        $rkp->save();

        return redirect(route('rkps.index'))->
                    with('data', 'Rkp created successfully');
    }

    public function edit($id)
    {
        $rkp = Rkp::where('user_id', auth()->id())->
                    where('id', $id)->
                    first();

    	if (empty($rkp)) {
            return redirect(route('rkps.index'))->with('data', 'Rkp not found');
        }
    	
        $userCurrency = DB::table('rkp')->select('currency_id')->where('user_id', auth()->id())->get();
        $userCurrencyArray = [];
        foreach($userCurrency as $item) {$userCurrencyArray[] = $item->currency_id;}

        $diff = array_diff($userCurrencyArray, array($rkp->currency_id));

        $currency = Currency::whereNotIn('id', $diff)->get();
        $currencyArray = [];
        foreach($currency as $item) {$currencyArray[$item->id] = $item->code;}

        return view('dashboard.rkps.edit', compact(['rkp', 'currencyArray']));
    }

    public function update($id, Request $request)
    {
    	$this->validate($request, Rkp::$rules);

        $request->merge([
            'status_id' => 1,
        ]);

    	$rkp = Rkp::where('user_id', auth()->id())->
                    where('id', $id)->
                    first();

    	if (empty($rkp)) {
            return redirect(route('rkps.index'))->
            		with('data', 'Rkp not found');
        }

        $rkp->fill($request->except(['featured_image']));

        if ($request->hasFile('featured_image')) {
        	$this->removePhoto( $rkp->featured_image );
            $rkp->featured_image = $this->uploadPhoto( $request->file('featured_image') );
        }

        $rkp->save();

        return redirect(route('rkps.index'))->
            		with('data', 'Rkp updated successfully');
    }

    protected function uploadPhoto(UploadedFile $file) {

        $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $image_name = str_slug($base_name, '_').'_'.time().'.'.$file->getClientOriginalExtension();

        $file->move(public_path('uploads/rkp/'), $image_name);
        return $image_name;
    }

    protected function removePhoto( $image_name ) {

        if( !empty($image_name) ) {
            unlink( public_path('uploads/rkp/').$image_name );
        }
    }
}