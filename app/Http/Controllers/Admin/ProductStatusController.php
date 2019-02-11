<?php

namespace App\Http\Controllers\Admin;

use Flash;
use App\Models\ProductStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductStatusController extends Controller
{
    public function index()
    {
        $statuses = ProductStatus::whereTranslation('locale', 'ru')->paginate(10);
        return view('admin.productStatuses.index',compact('statuses'));
    }

    public function edit($id)
    {
        $status = ProductStatus::findOrFail($id);
        return view('admin.productStatuses.edit',compact('status'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [ProductStatus::$rules]);

        $status = ProductStatus::findOrFail($id);
        if (empty($status)) {
            Flash::error('Status not found');
            return redirect(route('product_statuses.index'));
        }

        $status->update($request->except(['_token', '_method'])); 

        Flash::success('Status updated successfully.');

        return redirect(route('product_statuses.index'));   
    }

    public function create(){}
    public function store(Request $request){}
    public function show($id){}
    public function destroy($id){}
}
