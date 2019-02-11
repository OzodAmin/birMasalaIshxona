<?php

namespace App\Http\Controllers\Admin;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BasisRepository;
use App\Http\Requests\BasisRequest;
use Illuminate\Http\Request;
use App\Models\Basis;
use Response;
use Flash;

class BasisController extends AppBaseController
{
    private $repository;

    public function __construct(BasisRepository $baseRepo)
    {
        $this->repository = $baseRepo;
    }

    public function index(Request $request)
    {
        $basises = Basis::whereTranslation('locale', 'ru')->paginate(10);

        return view('admin.basis.index')->with('basises', $basises);
    }

    public function create()
    {
        return view('admin.basis.create');
    }

    public function store(BasisRequest $request)
    {

        $input = $request->all();

        $this->repository->create($input);

        Flash::success('Basis saved successfully.');

        return redirect(route('basises.index'));
    }

    public function edit($id)
    {
        $basis = $this->repository->findWithoutFail($id);

        if (empty($basis)) {
            Flash::error('Basis not found');
            return redirect(route('basises.index'));
        }

        return view('admin.basis.edit')->with('basis', $basis);
    }

    public function update($id, BasisRequest $request)
    {
        $basis = $this->repository->findWithoutFail($id);

        if (empty($basis)) {
            Flash::error('Basis not found');
            return redirect(route('basises.index'));
        }

        $basis = $this->repository->update($request->all(), $id);

        Flash::success('Basis updated successfully.');

        return redirect(route('basises.index'));
    }

    public function destroy($id)
    {
        $basis = $this->repository->findWithoutFail($id);

        if (empty($basis)) {
            Flash::error('Basis not found');
            return redirect(route('basises.index'));
        }

        $this->repository->delete($id);

        Flash::success('Basis deleted successfully.');

        return redirect(route('basises.index'));
    }
}