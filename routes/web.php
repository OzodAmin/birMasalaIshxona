<?php
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localize', 'localizationRedirect' ]
],
function()
{
    Route::get('products', 'ProductFrontController@index');

    Route::get('/', 'HomeController@index');
    Route::get('categories', 'HomeController@categoryPage');
    Route::get('profile', 'HomeController@profile');
	Route::get('profileEdit', 'HomeController@profileEdit');
    Route::get('api/getCities','HomeController@getCities');
    Route::get('api/getDistricts','HomeController@getDistricts');
    Route::post('registeration', 'HomeController@registeration');
    Auth::routes(['verify' => true]);

    Route::get('product/{slug}', ['as'=> 'product.show', 'uses' => 'ProductFrontController@show']);
    Route::get('category/{id}', 'ProductFrontController@showByCategory');
    Route::get('price-request/{id}', 'ProductFrontController@priceRequest');

    Route::get('dashboard', 'Dashboard\DashboardController@index');
    Route::get('notification/{id}', 'Dashboard\DashboardController@notification');
    Route::resource('ownProducts','Dashboard\ProductController');
    Route::resource('rkps', 'Dashboard\RkpController');

    Route::get('api/getChildCategories','Dashboard\ProductController@getChildCategories');
    Route::get('api/getUserSaldo','Dashboard\ProductController@getUserSaldo');
});

Route::group(['prefix' => 'backend','middleware' => ['role:admin']], function() {

	Route::get('/', 'Admin\Backend');

    Route::resource('roles','Admin\RoleController');
    Route::resource('users','Admin\UserController');
    Route::resource('permissions','Admin\PermissionController');
    Route::resource('user_statuses', 'Admin\UserStatusController');

    Route::resource('rkpsAdmin', 'Admin\RkpBackendController');
    Route::resource('payments', 'Admin\PaymentController');
    Route::get('rkpsAdmin/topUp/{id}','Admin\RkpBackendController@topUp');

    Route::resource('cities', 'Admin\CityController');
    Route::resource('districts', 'Admin\DistrictController');

    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('childCategories', 'Admin\CategoryChildController');

    Route::resource('measures', 'Admin\MeasureController');
    Route::resource('currencies', 'Admin\CurrencyController');
    Route::resource('basises', 'Admin\BasisController');
    Route::resource('product_statuses', 'Admin\ProductStatusController');
    Route::resource('products', 'Admin\ProductController');

    Route::resource('holidays', 'Admin\HolidaysController');

    Route::get('api/getDistricts','Admin\UserController@getDistricts');
    Route::get('users/reset/{id}','Admin\UserController@reset');

});