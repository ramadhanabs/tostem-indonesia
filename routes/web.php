<?php

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
// localization pilih bahasa

Route::get('/', function () {
    return redirect(app()->getLocale());
})->name('home');
Route::get('/admin/sign-in', function () {
    return redirect('admin/login');
})->name('home');
Route::get('/sitemap.xml','PublicController@siteMap');
Route::get('/robots.txt','PublicController@robot');
Route::get('/giesta-simulation', 'PublicController@giestaSimulation');
Route::get('/frame-giesta-simulation', 'PublicController@framegiestaSimulation');
Route::get('/frame-main-simulation', 'PublicController@maingiesta');

Route::get('locale/{locale}', function ($locale) {

    App::setLocale($locale);
    return redirect(app()->getLocale());
});

Route::prefix('{guard}')->name('guard.')->group(function () {
    Auth::routes(['verify' => true]);
    Route::get('/', 'ResourceController@home');
    Route::get('login/{provider}', 'Auth\SocialAuthController@redirectToProvider');
});



Route::group(['prefix' => '{locale}'], function () {
    Route::get('/', 'PublicController@home');

    Route::get('/brand', 'PublicController@brand');
    Route::get('/reference', 'PublicController@references');
    Route::get('/products', 'PublicController@products');
    Route::get('/product-type', 'PublicController@productsType');
    Route::get('/privacy-notice', 'PublicController@termandcondition');

    Route::get('/product-type/{operation}', 'PublicController@productsTypeOverview');
    
    Route::get('/project-solution', 'PublicController@projectSolution');
    Route::get('/products-overview/{product_type}', 'PublicController@productsOverview');
    Route::get('/product-detail/{product_id}/{product_name}', 'PublicController@productsDetail');
    Route::get('/faq', 'PublicController@faq');
    Route::get('/term-of-use', 'PublicController@tos');
    Route::get('/privacy-policy', 'PublicController@privacyPolicy');
    Route::get('/under-construction', 'PublicController@underConstruction');
    Route::get('/virtual-room', 'PublicController@virtualTour');
    Route::get('/virtual-show', 'PublicController@virtualShow');
    Route::get('/reference/{slug}', 'PublicController@referenceSingle')->name('referenceSingle');

    Route::get('/whats-on', 'PublicController@whatsOn');
    Route::get('/oem', 'PublicController@oem');
    Route::get('/whats-on/{idBLog}/{slug}', 'PublicController@whatsOnSingle')->name('whatsOnSingle');

    Route::get('/airflow-system-and-covid-19', 'PublicController@airFlow');

    Route::get('/career', 'PublicController@career');

    Route::get('/catalogue', 'PublicController@catalogue');
    Route::get('/contactus', 'PublicController@contactus');
});
Route::post('/contacts/tambahAct', 'PublicController@contactUsCreated');



Route::prefix('/customer')->name('customer.')->namespace('Customer')->group(function () {
    Route::get('account', 'CustomerController@account')->name('home');
    Route::post('sign-up', 'SignUpController@signUp')->name('sign_up');
    Route::post('sign-in', 'SignInController@signIn')->name('sign_in');
    Route::post('sign-out', 'SignInController@signOut')->name('sign_out');
    Route::get('wishlist', 'CustomerController@wishlist');
});
Route::get('customer/login', 'PublicController@authPage')->name('login');


Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {
    Route::get('product', 'ProductController@index')->name('product.index');
    Route::get('product/create', 'ProductController@create')->name('product.create');
    Route::post('product/store', 'ProductController@store')->name('product.store');

    Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('product/update/{id}', 'ProductController@update')->name('product.update');
    Route::post('product/delete/{id}', 'ProductController@delete')->name('product.delete');



    Route::get('/project', 'ProjectController@index')->name('project.index');

    Route::get('project/add', 'ProjectController@create')->name('project.create');
    Route::get('project/edit/{id}', 'ProjectController@edit')->name('project.edit');
    Route::post('project/update/{id}', 'ProjectController@update')->name('project.update');
    Route::post('project/store', 'ProjectController@store')->name('project.store');
    Route::post('project/uploadimage', 'ProjectController@uploadimage')->name('project.uploadimage');
    Route::post('project/deleteimage', 'ProjectController@deleteimage')->name('project.deleteimage');
    Route::post('project/delete/{id}', 'ProjectController@delete')->name('project.delete');



    Route::get('/blog', 'BlogController@index')->name('blog.index');

    Route::get('blog/create', 'BlogController@create')->name('blog.create');

    Route::post('blog/store', 'BlogController@store')->name('blog.store');
    Route::post('blog/delete/{id}', 'BlogController@delete')->name('blog.delete');
    Route::get('blog/edit/{id}', 'BlogController@edit')->name('blog.edit');
    Route::post('blog/update/{id}', 'BlogController@update')->name('blog.update');

    Route::get('/references', 'ReferencesController@index')->name('references.index');

    Route::get('references/create', 'ReferencesController@create')->name('references.create');

    Route::post('references/store', 'ReferencesController@store')->name('references.store');
    Route::post('references/delete/{id}', 'ReferencesController@delete')->name('references.delete');
    Route::get('references/edit/{id}', 'ReferencesController@edit')->name('references.edit');
    Route::post('references/update/{id}', 'ReferencesController@update')->name('references.update');


    Route::get('/customer', 'CustomerController@index')->name('customer.index');
});



Route::get('customer/sign-in', 'PublicController@authPage');
Route::get('customer/sign-up', 'PublicController@authSignUp');