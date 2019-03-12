<?php
namespace App\Http\Controllers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;
use App\Models\RequestModel;
use App\Models\Holidays;
use App\Models\Product;
use Carbon\Carbon;

class ProductFrontController extends AppBaseController
{
    private $locale;

    public function __construct()
    {
        $this->locale = LaravelLocalization::getCurrentLocale();
    }

    public function index(Request $request)
    {
        $products = Product::whereTranslation('locale', $this->locale)->
                    where('status', 3)->
                    where('expire_at', '>', Carbon::now())->
                    paginate(16);
        return view('product.index', compact(['products']));
    }

    public function show($slug)
    {
        $product = Product::whereTranslation('locale', $this->locale)
                            ->whereTranslation('slug', $slug)
                            ->where('expire_at', '>', Carbon::now())
                            ->first();

        return view('product.show', compact(['product']));
    }

    public function priceRequest($id)
    {
        if (auth()->id()) {
            $userId = auth()->id();
            $product = Product::where('id', $id)->first();
            $usersIds = Product::where('child_category_id', $product->child_category_id)
                                ->select('user_id')
                                ->get();
            $usersIds = $usersIds->toArray();

            foreach ($usersIds as $key => $value) { 
                $request = new RequestModel;
                $request->owner_id = $userId;
                $request->owner_product_id = $id;
                $request->user_id = $value['user_id'];

                $holidays = Holidays::where('holiday', '>', Carbon::now())->get();
                $holidays = $holidays->toArray();

                $MyDateCarbon = Carbon::now();
                $MyDateCarbon->addWeekdays(2);

                for ($i = 1; $i <= 2; $i++) {

                    if (in_array(Carbon::now()->addWeekdays($i)->toDateString(), $holidays)) {
                        $MyDateCarbon->addDay();
                    }
                }

                $request->expire_at = $MyDateCarbon;
                $request->save();
            }

            return redirect(url('/'))->with('success','Mehanizm success');
            
        }
        abort(403, 'Unauthorized action.');
    }

    public function showByCategory($id)
    {
        $products = Product::whereTranslation('locale', $this->locale)->
                    where('child_category_id', $id)->
                    where('status', 3)->
                    where('expire_at', '>', Carbon::now())->
                    paginate(16);
        return view('product.index', compact(['products']));
    }
}
