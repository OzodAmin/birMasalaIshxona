<?php

namespace App\Http\Controllers\Admin;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BasisRepository;
use App\Http\Requests\BasisRequest;
use Illuminate\Http\Request;
use App\Models\Holidays;
use Response;
use Flash;

class HolidaysController extends AppBaseController
{
    public function index(Request $request)
    {
        $holidays = Holidays::orderBy('holiday','DESC')->paginate(10);

        return view('admin.holidays.index',compact('holidays'));
    }

    public function create()
    {
        return view('admin.holidays.create');
    }

    public function store(Request $request)
    {

        $holiday = new Holidays();
        $holiday->holiday = $request->input('holiday');
        $holiday->save();
        Flash::success('Holiday saved successfully.');

        return redirect(route('holidays.index'));
    }

    public function edit($id)
    {
        $holiday = Holidays::find($id);

        if (empty($holiday)) {
            Flash::error('Holiday not found');
            return redirect(route('holidays.index'));
        }

        return view('admin.holidays.edit')->with('holiday', $holiday);
    }

    public function update($id, Request $request)
    {
        $holiday = Holidays::find($id);

        if (empty($holiday)) {
            Flash::error('Holiday not found');
            return redirect(route('holidays.index'));
        }

        $holiday->holiday = $request->input('holiday');
        $holiday->save();

        Flash::success('Holiday updated successfully.');

        return redirect(route('holidays.index'));
    }

    public function destroy($id)
    {
        Holidays::destroy($id);
        Flash::success('Holiday deleted successfully.');
        return redirect(route('holidays.index'));
    }
}