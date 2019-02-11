<?php

namespace App\Http\Controllers\Admin;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AppBaseController;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use App\Models\ProductStatus;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Country;
use App\Models\Measure;
use App\Models\Basis;
use App\User;
use Flash;
use DB;

class ProductController extends AppBaseController
{
    public function index(Request $request)
    {
        $products = Product::whereTranslation('locale', 'ru')->
                    orderBy('status', 'asc')->
                    paginate(15);
        return view('admin.products.index',compact(['products']));
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();

        if (empty($product)) {
            return redirect(route('products.index'))->with('data', 'Product not found');
        }

        $categories = Category::whereTranslation('locale', 'ru')->get();
        $categoriesArray = [];
        foreach($categories as $item) {$categoriesArray[$item->id] = $item->title;}

        $categoriesChild = ChildCategory::whereTranslation('locale', 'ru')->
                                            where('category_id', $product->parent_category_id)->
                                            get();
        $categoriesChildArray = [];
        foreach($categoriesChild as $item) {$categoriesChildArray[$item->id] = $item->title;}

        $measures = Measure::whereTranslation('locale', 'ru')->get();
        $measuresArray = [];
        foreach($measures as $item) {$measuresArray[$item->id] = $item->title;}

        $currency = Currency::get();
        $currencyArray = [];
        foreach($currency as $item) {$currencyArray[$item->id] = $item->code;}

        $basis = Basis::get();
        $basisArray = [];
        foreach($basis as $item) {$basisArray[$item->id] = $item->code;}

        $country = Country::whereTranslation('locale', 'ru')->get();
        $countryArray = [];
        foreach($country as $item) {$countryArray[$item->id] = $item->title;}

        $statuses = ProductStatus::whereTranslation('locale', 'ru')->get();
        $statusesArray = [];
        foreach($statuses as $item) {$statusesArray[$item->id] = $item->name;}

        return view('admin.products.edit', compact(['product','categoriesArray', 'measuresArray', 'currencyArray', 'basisArray', 'countryArray', 'statusesArray', 'categoriesChildArray']));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, Product::$rules);

        $product = Product::where('id', $id)->first();

        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }

        $product->fill($request->except(['featured_image']));

        if ($request->hasFile('featured_image')) {
            $this->removePhoto( $product->featured_image );
            $product->featured_image = $this->uploadPhoto( $request->file('featured_image') );
        }

        $product->save();

        Flash::success('Product updated successfully.');
        return redirect(route('products.index'));
    }


    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();

        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }

         $this->removePhoto( $product->featured_image );

        $product->delete();

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }

    protected function uploadPhoto(UploadedFile $file) {

        $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $image_name = str_slug($base_name, '_').'_'.time().'.'.$file->getClientOriginalExtension();

        $file->move(public_path('uploads/product/'), $image_name);

        Image::make(public_path('uploads/product/').$image_name)
            ->fit(100)
            ->save(public_path('uploads/product/').'admin_'.$image_name);

        Image::make(public_path('uploads/product/').$image_name)
            ->fit(720, 960)
            ->save(public_path('uploads/product/').'thumb_'.$image_name);

        Image::make(public_path('uploads/product/').$image_name)
            ->fit(1200, 1600)
            ->save(public_path('uploads/product/').'icon_'.$image_name);

        return $image_name;
    }

    protected function removePhoto( $image_name ) {

        if( !empty($image_name) ) {
            unlink( public_path('uploads/product/').$image_name );
            unlink( public_path('uploads/product/admin_').$image_name );
            unlink( public_path('uploads/product/thumb_').$image_name );
            unlink( public_path('uploads/product/icon_').$image_name );
        }
    }
}
