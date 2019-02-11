<?php

namespace App\Http\Controllers\Admin;

use Flash;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    public function index(Request $request)
    {
        $categories = Category::whereTranslation('locale', 'ru')->paginate(10);

        return view('admin.category.index', compact(['categories']));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, Category::$rules);
        Category::create($request->all());
        Flash::success('Category saved successfully.');

        return redirect(route('categories.index'));
    }

    public function show($id){}

    public function edit($id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        return view('admin.category.edit', compact(['category']));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        $category = $this->categoryRepository->update($request->all(), $id);

        Flash::success('Category updated successfully.');

        return redirect(route('categories.index'));
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        $category->delete($id);

        Flash::success('Category deleted successfully.');

        return redirect(route('categories.index'));
    }
}
