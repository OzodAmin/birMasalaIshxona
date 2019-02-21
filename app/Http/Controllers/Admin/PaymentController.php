<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RkpPayment;
use App\Models\RkpPayTypes;
use App\Models\RkpBanks;
use App\Models\Currency;
use App\Models\Rkp;
use Flash;

class PaymentController extends Controller
{

    public function index(Request $request)
    {
        $payments = RkpPayment::orderBy('id','DESC')->paginate(10);

        return view('admin.payments.index',compact('payments'));
    }

    public function create(Request $request)
    {
        $rkp = null;

        if (isset($request->id)) {$rkp = Rkp::where('id', $request->id)->first();}

        $payType = RkpPayTypes::whereTranslation('locale', 'ru')->get();
        $payTypeArray = [];
        foreach($payType as $item) {$payTypeArray[$item->id] = $item->name;}

        $currency = Currency::whereTranslation('locale', 'ru')->get();
        $currencyArray = [];
        foreach($currency as $item) {$currencyArray[$item->id] = $item->code;}

        $rkpAccounts = RkpBanks::whereTranslation('locale', 'ru')->get();
        $rkpAccountsArray = [];
        foreach($rkpAccounts as $item) {$rkpAccountsArray[$item->id] = $item->bank_name;}

        return view('admin.payments.create',compact('payTypeArray', 'rkp', 'currencyArray', 'rkpAccountsArray'));
    }

    public function store(Request $request)
    {
        $request->merge(['user_id' => auth()->id()]);
        $this->validate($request, RkpPayment::$rules);

        $payment = new RkpPayment();
        $payment->fill($request->except(['sendClientName', 'sendClientBank', 'sendClientBankAccount', 'sendClientBankCode']));
        $payment->save();

        //Increase saldo of 'rkp_accounts' table
        $rkpBanks = RkpBanks::where('id', $request->rkp_accounts_id)->first();
        $rkpBanks->saldo = $request->summa;
        $rkpBanks->save();

        //Increase saldo of 'rkp' table
        $rkp = Rkp::where('id', $request->sendRkpAccount_ID)->first();
        $rkp->saldo += $request->summa;
        $rkp->save();

        Flash::success('Payment created successfully.');
        return redirect(route('payments.index'));
    }

    public function edit($id)
    {
        $payment = RkpPayment::where('id', $id)->first();

        if (empty($payment)) {
            Flash::error('Payment not found.');
            return redirect(route('payments.index'));
        }

        $payType = RkpPayTypes::whereTranslation('locale', 'ru')->get();
        $payTypeArray = [];
        foreach($payType as $item) {$payTypeArray[$item->id] = $item->name;}

        $currency = Currency::whereTranslation('locale', 'ru')->get();
        $currencyArray = [];
        foreach($currency as $item) {$currencyArray[$item->id] = $item->code;}

        $rkpAccounts = RkpBanks::whereTranslation('locale', 'ru')->get();
        $rkpAccountsArray = [];
        foreach($rkpAccounts as $item) {$rkpAccountsArray[$item->id] = $item->bank_name;}

        return view('admin.payments.edit',compact('payTypeArray', 'payment', 'currencyArray', 'rkpAccountsArray'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, RkpPayment::$rules);

        $payment = RkpPayment::where('id', $id)->first();
        $oldSumma = $payment->summa;
        $payment->fill($request->except(['sendClientName', 'sendClientBank', 'sendClientBankAccount', 'sendClientBankCode']));
        $payment->save();
     
        $rkp = Rkp::where('id', $payment->sendRkpAccount_ID)->first();
        $summa = $rkp->saldo - $oldSumma;
        $summa += $request->summa;
        $rkp->saldo = $summa;
        $rkp->save();

        $rkpBanks = RkpBanks::where('id', $payment->rkp_accounts_id)->first();
        $summa = $rkpBanks->saldo - $oldSumma;
        $summa += $request->summa;
        $rkpBanks->saldo = $summa;
        $rkpBanks->save();

        Flash::success('Payment updated successfully.');
        return redirect(route('payments.index'));
    }

    public function destroy($id)
    {
        $payment = RkpPayment::where('id', $id)->first();
        $payment->delete();

        $rkp = Rkp::where('id', $payment->sendRkpAccount_ID)->first();
        $rkp->saldo -= $payment->summa;
        $rkp->save();

        $rkpBanks = RkpBanks::where('id', $payment->rkp_accounts_id)->first();
        $rkpBanks->saldo -= $payment->summa;
        $rkpBanks->save();
        
        Flash::success('Payment deleted successfully.');
        return redirect(route('payments.index'));
    }
}
