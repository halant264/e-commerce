<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguagesController;
use App\Http\Controllers\Admin\MainCategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


define('PAGINATION_COUNT',10);
// Auth::routes();

Route::group(['namespace' => 'Admin', 'middleware' => ['auth:admin' , 'languages']], function () {
    Route::get('/', [DashboardController::class , 'index'])->name('admin.dashboard');
    Route::get('/ss', [DashboardController::class , 'index'])->name('admin.dashboard');


    ######################### Begin Languages Route ########################
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/',[LanguagesController::class , 'index']) -> name('admin.languages');
        Route::get('create',[LanguagesController::class , 'create']) -> name('admin.languages.create');
        Route::post('store',[LanguagesController::class , 'store']) -> name('admin.languages.store');
        Route::get('edit/{id}',[LanguagesController::class , 'edit']) -> name('admin.languages.edit');
        Route::post('update/{id}',[LanguagesController::class , 'update']) -> name('admin.languages.update');
        Route::delete('delete/{id}',[LanguagesController::class , 'destroy']) -> name('admin.languages.delete');
        });
    ######################### End Languages Route ########################


    ######################### Begin Main Categoris Routes ########################
    Route::group(['prefix' => 'main_categories'], function () {
        Route::get('/',[MainCategoriesController::class , 'index']) -> name('admin.maincategories');
        Route::get('create',[MainCategoriesController::class , 'create']) -> name('admin.maincategories.create');
        Route::post('store',[MainCategoriesController::class , 'store']) -> name('admin.maincategories.store');
        Route::get('edit/{id}',[MainCategoriesController::class , 'edit']) -> name('admin.maincategories.edit');
        Route::post('update/{id}',[MainCategoriesController::class , 'update']) -> name('admin.maincategories.update');
        Route::get('delete/{id}',[MainCategoriesController::class , 'destroy']) -> name('admin.maincategories.delete');
        Route::get('changeStatus/{id}',[MainCategoriesController::class , 'changeStatus']) -> name('admin.maincategories.status');

    });
    ######################### End  Main Categoris Routes  ########################


    ######################### Begin Sub Categoris Routes ########################
    Route::group(['prefix' => 'sub_categories'], function () {
        Route::get('/','SubCategoriesController@index') -> name('admin.subcategories');
        Route::get('create','SubCategoriesController@create') -> name('admin.subcategories.create');
        Route::post('store','SubCategoriesController@store') -> name('admin.subcategories.store');
        Route::get('edit/{id}','SubCategoriesController@edit') -> name('admin.subcategories.edit');
        Route::post('update/{id}','SubCategoriesController@update') -> name('admin.subcategories.update');
        Route::get('delete/{id}','SubCategoriesController@destroy') -> name('admin.subcategories.delete');
        Route::get('changeStatus/{id}','SubCategoriesController@changeStatus') -> name('admin.subcategories.status');

    });
    ######################### End  Sub Categoris Routes  ########################


    ######################### Begin vendors Routes ########################
    Route::group(['prefix' => 'vendors'], function () {
        Route::get('/','VendorsController@index') -> name('admin.vendors');
        Route::get('create','VendorsController@create') -> name('admin.vendors.create');
        Route::post('store','VendorsController@store') -> name('admin.vendors.store');
        Route::get('edit/{id}','VendorsController@edit') -> name('admin.vendors.edit');
        Route::post('update/{id}','VendorsController@update') -> name('admin.vendors.update');
        Route::get('delete/{id}','VendorsController@destroy') -> name('admin.vendors.delete');
    });
    ######################### End  vendors Routes  ########################



});


Route::group(['namespace' => 'Admin' , 'middleware' => 'guest:admin'], function () {
    Route::get('login', [LoginController::class , 'getLogin'])->name('get.admin.login');
    Route::post('login', [LoginController::class , 'login'])->name('admin.login');
});


 ########################### test part routes #####################

Route::get('subcateory',function (){

      $mainCategory = \App\Models\MainCategory::find(31);

   return       $mainCategory -> subCategories;
});

Route::get('maincategory',function (){

    $subcategory = \App\Models\SubCategory::find(1);

    return $subcategory -> mainCategory;


});
