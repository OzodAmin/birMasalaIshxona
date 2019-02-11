<?php
namespace App\Http\Controllers\Dashboard;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\AppBaseController;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
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
	private $locale;

	public function __construct()
    {
        $this->middleware('auth');
        $this->locale = LaravelLocalization::getCurrentLocale();
    }

	public function index(Request $request)
    {
    	$products = Product::whereTranslation('locale', $this->locale)->
    				where('user_id', auth()->id())->
    				orderBy('status', 'asc')->
    				paginate(15);
        return view('dashboard.products.index',compact(['products']));
    }

    public function create()
    {
    	$categories = Category::whereTranslation('locale', $this->locale)->get();
    	$categoriesArray = [];
        foreach($categories as $item) {$categoriesArray[$item->id] = $item->title;}

        $measures = Measure::whereTranslation('locale', $this->locale)->get();
    	$measuresArray = [];
        foreach($measures as $item) {$measuresArray[$item->id] = $item->title;}

        $currency = Currency::get();
    	$currencyArray = [];
        foreach($currency as $item) {$currencyArray[$item->id] = $item->code;}

        $basis = Basis::get();
    	$basisArray = [];
        foreach($basis as $item) {$basisArray[$item->id] = $item->code;}

        $country = Country::whereTranslation('locale', $this->locale)->get();
    	$countryArray = [];
        foreach($country as $item) {$countryArray[$item->id] = $item->title;}

        return view('dashboard.products.create', compact(['categoriesArray', 'measuresArray', 'currencyArray', 'basisArray', 'countryArray']));
    }

    public function store(Request $request)
    {
    	$validation = Product::$rules + 
    		['featured_image' => 'required|image|max:2048|mimes:jpeg,png,jpg',
	    	'name' => 'required|string|min:1|max:255',
	        'description' => 'required|string|min:1|max:255'];
    	$this->validate($request, $validation);
    	
    	$request->merge([
    		'user_id' => auth()->id(),
    		'status' => 1,
    		'deposit' => 3,
    		'en' => [
    				'title' => $request['name'],
    				'description' => $request['description'],
    				'conditions' => $request['conditions']
    		],
    		'ru' => [
    				'title' => $request['name'],
    				'description' => $request['description'],
    				'conditions' => $request['conditions']
    		],
    		'uz' => [
    				'title' => $request['name'],
    				'description' => $request['description'],
    				'conditions' => $request['conditions']
    		]
        ]);
        
        $product = new Product();
        $product->fill($request->except(['_token', 'name', 'description', 'conditions']));

        if ($request->hasFile('featured_image')) {
            $product->featured_image = $this->uploadPhoto( $request->file('featured_image') );
        }

        $product->save();

        Flash::success('Product saved successfully.');

        return redirect(route('ownProducts.index'));
    }

    public function edit($id)
    {
    	$product = Product::whereTranslation('locale', $this->locale)->
    				where('user_id', auth()->id())->
    				where('id', $id)->
    				first();

    	if (empty($product)) {
            return redirect(route('ownProducts.index'))->with('data', 'Product not found');
        }

    	$categories = Category::whereTranslation('locale', $this->locale)->get();
    	$categoriesArray = [];
        foreach($categories as $item) {$categoriesArray[$item->id] = $item->title;}

        $measures = Measure::whereTranslation('locale', $this->locale)->get();
    	$measuresArray = [];
        foreach($measures as $item) {$measuresArray[$item->id] = $item->title;}

        $currency = Currency::get();
    	$currencyArray = [];
        foreach($currency as $item) {$currencyArray[$item->id] = $item->code;}

        $basis = Basis::get();
    	$basisArray = [];
        foreach($basis as $item) {$basisArray[$item->id] = $item->code;}

        $country = Country::whereTranslation('locale', $this->locale)->get();
    	$countryArray = [];
        foreach($country as $item) {$countryArray[$item->id] = $item->title;}

        return view('dashboard.products.edit', compact(['product','categoriesArray', 'measuresArray', 'currencyArray', 'basisArray', 'countryArray']));
    }

    public function update($id, Request $request)
    {
    	$this->validate($request, Product::$rules + 
    		['name' => 'required|string|min:1|max:255',
	        'description' => 'required|string|min:1|max:255']);
    	
    	$request->merge([
    		'status' => 1,
    		'en' => [
    				'title' => $request['name'],
    				'description' => $request['description'],
    				'conditions' => $request['conditions']
    		],
    		'ru' => [
    				'title' => $request['name'],
    				'description' => $request['description'],
    				'conditions' => $request['conditions']
    		],
    		'uz' => [
    				'title' => $request['name'],
    				'description' => $request['description'],
    				'conditions' => $request['conditions']
    		]
        ]);

    	$product = Product::where('user_id', auth()->id())->
    				where('id', $id)->
    				first();

    	if (empty($product)) {
            return redirect(route('ownProducts.index'))->
            		with('data', 'Product not found');
        }

        $product->fill($request->except(['featured_image']));

        if ($request->hasFile('featured_image')) {
        	$this->removePhoto( $product->featured_image );
            $product->featured_image = $this->uploadPhoto( $request->file('featured_image') );
        }

        $product->save();

        return redirect(route('ownProducts.index'))->
            		with('data', 'Product updated successfully');
    }

    public function getChildCategories(Request $request){
    	$categories = ChildCategory::
    					where('category_id', $request->category_id)->
    					whereTranslation('locale', $this->locale)->
    					get();
    	$categoriesArray = [];
        foreach($categories as $item) {$categoriesArray[$item->id] = $item->title;}

        return response()->json($categoriesArray);
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