<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DistrictRequest;
use App\Models\District;
use App\Models\City;
use App\Repositories\DistrictRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App;

class DistrictController extends AppBaseController
{

    private $districtRepository;

    public function __construct(DistrictRepository $districtRepo){
        $this->districtRepository = $districtRepo;
        $this->defaultLocale = 'ru';
        App::setLocale($this->defaultLocale);
    }

    public function index(Request $request)
    {
        $this->districtRepository->pushCriteria(new RequestCriteria($request));
        $districts = $this->districtRepository->paginate(20);
        return view('admin.district.index')->with('districts', $districts);
    }

    public function create()
    {
        $cities = City::withTranslation()->get();

        $citiesArray = [];

        foreach($cities as $city) {
            $citiesArray[$city->id] = $city->title;
        }

        return view('admin.district.create', compact(['citiesArray']));
    }

    public function store(DistrictRequest $request)
    {
        $district = new District();

        $district->fill($request->except(['_token']));

        $district->save();

        Flash::success('Город успешно сохранен.');

        return redirect(route('districts.index'));
    }

    public function show(){}

    public function edit($id)
    {
        $district = $this->districtRepository->findWithoutFail($id);

        $cities = City::withTranslation()->get();

        $citiesArray = [];

        foreach($cities as $city) {
            $citiesArray[$city->id] = $city->title;
        }

        if (empty($district)) {
            Flash::error('Город не найден');
            return redirect(route('districts.index'));
        }

        return view('admin.district.edit', compact(['district','citiesArray']));
    }

    public function update($id, DistrictRequest $request)
    {
        $district = $this->districtRepository->findWithoutFail($id);

        if (empty($district)) {
            Flash::error('Город не найден');
            return redirect(route('districts.index'));
        }

        $district->fill($request->except(['_token']));

        $district->save();

        Flash::success('Город успешно обновлен.');

        return redirect(route('districts.index'));
    }

    public function destroy($id)
    {
        $this->districtRepository->delete($id);

        Flash::success('Город успешно удален.');

        return redirect(route('districts.index'));
    }
}