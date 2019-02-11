<?php

namespace App\Http\Controllers\Admin;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CurrencyRepository;
use App\Http\Requests\CurrencyRequest;
use Illuminate\Http\Request;
use App\Models\Currency;
use Response;
use Flash;

class CurrencyController extends AppBaseController
{
    private $repository;

    public function __construct(CurrencyRepository $baseRepo)
    {
        $this->repository = $baseRepo;
    }

    public function index(Request $request)
    {
        $currencies = Currency::whereTranslation('locale', 'ru')->paginate(10);

        return view('admin.currency.index')->with('currencies', $currencies);
    }

    public function create()
    {
        return view('admin.currency.create');
    }

    public function store(CurrencyRequest $request)
    {

        $input = $request->all();

        $this->repository->create($input);

        Flash::success('Currency saved successfully.');

        return redirect(route('currencies.index'));
    }

    public function edit($id)
    {
        $currency = $this->repository->findWithoutFail($id);

        if (empty($currency)) {
            Flash::error('Currency not found');
            return redirect(route('currencies.index'));
        }

        return view('admin.currency.edit')->with('currency', $currency);
    }

    public function update($id, CurrencyRequest $request)
    {
        $currency = $this->repository->findWithoutFail($id);

        if (empty($currency)) {
            Flash::error('Currency not found');
            return redirect(route('currencies.index'));
        }

        $currency = $this->repository->update($request->all(), $id);

        Flash::success('Currency updated successfully.');

        return redirect(route('currencies.index'));
    }

    public function destroy($id)
    {
        $currency = $this->repository->findWithoutFail($id);

        if (empty($currency)) {
            Flash::error('Currency not found');
            return redirect(route('currencies.index'));
        }

        $this->repository->delete($id);

        Flash::success('Currency deleted successfully.');

        return redirect(route('currencies.index'));
    }
}