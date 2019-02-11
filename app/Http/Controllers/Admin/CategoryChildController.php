<?php

namespace App\Http\Controllers\Admin;

use Flash;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Http\Requests\CategoryRequest;
use App\Repositories\ChildCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryChildController  extends Controller
{
    private $categoryRepository;

    public function __construct(ChildCategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    public function index(Request $request)
    {
        $categories = ChildCategory::whereTranslation('locale', 'ru')->paginate(10);

        return view('admin.categoryChild.index', compact(['categories']));
    }

    public function create()
    {
        $parentCategories = Category::whereTranslation('locale', 'ru')->get();
        $parentCategoriesArray = [];

        foreach($parentCategories as $parentCategory) {
            $parentCategoriesArray[$parentCategory->id] = $parentCategory->title;
        }

        return view('admin.categoryChild.create', compact(['parentCategoriesArray']));
    }

    public function store(Request $request)
    {
        $this->validate($request, ChildCategory::$rules);
        ChildCategory::create($request->all());
        Flash::success('Child Category saved successfully.');

        return redirect(route('childCategories.index'));
    }

    public function show($id){}

    public function edit($id)
    {
        $category = ChildCategory::find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('childCategories.index'));
        }

        $parentCategories = Category::whereTranslation('locale', 'ru')->get();
        $parentCategoriesArray = [];

        foreach($parentCategories as $parentCategory) {
            $parentCategoriesArray[$parentCategory->id] = $parentCategory->title;
        }

        return view('admin.categoryChild.edit', compact(['category', 'parentCategoriesArray']));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = ChildCategory::find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('childCategories.index'));
        }

        $category = $this->categoryRepository->update($request->all(), $id);

        Flash::success('Category updated successfully.');

        return redirect(route('childCategories.index'));
    }

    public function destroy($id)
    {
        $category = ChildCategory::find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('childCategories.index'));
        }

        $category->delete($id);

        Flash::success('Category deleted successfully.');

        return redirect(route('childCategories.index'));
    }
}
