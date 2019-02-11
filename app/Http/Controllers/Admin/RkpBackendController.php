<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Models\RkpBanks;
use App\Models\RkpPayTypes;
use App\Models\UserStatus;
use App\Models\Currency;
use App\Models\Rkp;
use App\User;
use Flash;
use DB;

class RkpBackendController extends AppBaseController
{
    public function index(Request $request)
    {
        $rkps = Rkp::orderBy('status_id', 'asc')->
                    paginate(15);
        return view('admin.rkps.index',compact(['rkps']));
    }

    public function show($id){return redirect(route('rkpsAdmin.index'));}

    public function create(){return redirect(route('rkpsAdmin.index'));}

    public function edit($id)
    {
        $rkp = Rkp::where('id', $id)->first();

        if (empty($rkp)) {
            Flash::error('RKP Account not found');
            return redirect(route('rkpsAdmin.index'));
        }

        $userCurrency = DB::table('rkp')
                        ->select('currency_id')
                        ->where('user_id', $rkp->user_id)
                        ->get();
        $userCurrencyArray = [];
        foreach($userCurrency as $item) {$userCurrencyArray[] = $item->currency_id;}

        $diff = array_diff($userCurrencyArray, array($rkp->currency_id));

        $currency = Currency::whereNotIn('id', $diff)->get();
        $currencyArray = [];
        foreach($currency as $item) {$currencyArray[$item->id] = $item->code;}

        $statuses = UserStatus::whereTranslation('locale', 'ru')->get();
        $statusArray = [];
        foreach($statuses as $city) {$statusArray[$city->id] = $city->name;}

        $banks = RkpBanks::whereTranslation('locale', 'ru')->get();
        $banksArray = [];
        foreach($banks as $item) {$banksArray[$item->id] = $item->bank_name;}

        return view('admin.rkps.edit', compact(['rkp', 'currencyArray', 'statusArray', 'banksArray']));
    }

    public function update($id, Request $request)
    {
        $rkp = Rkp::where('id', $id)->first();

        if (empty($rkp)) {
            Flash::error('RKP Account not found');
            return redirect(route('rkpsAdmin.index'));
        }

        $rkp->fill($request->except(['featured_image']));

        $rkp->save();

        Flash::success('RKP updated successfully.');
        return redirect(route('rkpsAdmin.index'));
    }
}
