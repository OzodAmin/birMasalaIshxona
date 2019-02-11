<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RkpPayment;

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
        
        if (isset($request->id)) {
            $rkp = Rkp::where('id', $id)->first();

            $payType = RkpPayTypes::whereTranslation('locale', 'ru')->get();
            $payTypeArray = [];
            foreach($payType as $item) {$payTypeArray[$item->id] = $item->name;}
        }

        $payType = RkpPayTypes::whereTranslation('locale', 'ru')->get();
        $payTypeArray = [];
        foreach($payType as $item) {$payTypeArray[$item->id] = $item->name;}

        return view('admin.permissions.create',compact('payTypeArray', 'rkp'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
        ]);
        //create the new role
        $role = new Permission();
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        return redirect()->route('permissions.index')
            ->with('success','Permission created successfully');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('admin.permissions.edit',compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'display_name' => 'required',
            'description' => 'required',
        ]);
        //Find the role and update its details
        $role = Permission::find($id);
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();
        return redirect()->route('permissions.index')
            ->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        //DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('permissions.index')
            ->with('success','Role deleted successfully');
    }
}
