<?php

//test commit
    /** Auth **/

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\ImportedCommoditiesController;
use App\Models\User;

Route::group(['as' => 'auth.'], function () {

        Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
        Route::post('/', 'Auth\LoginController@login')->name('login');

        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
        Route::post('/signup','User\UserController@store')->name('signup');
        Route::get('/register','User\UserController@showForm')->name('signup.show_form');
//        Route::get('verifyTransaction', 'PaymentController@getTransaction')->name('verifyTransaction');
    });
    Route::post('/preRegistration','Admin\PreRegistrationController@storePreRegistration')->name('preRegistration');

	/** Dashboard **/
	Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status']], function () {
		/** HOME **/	
		// Route::get('/home', 'HomeController@index')->name('home');
		Route::get('/home', 'User\HomeController@index')->name('home');
		/** USER **/   
		Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
		Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
		Route::post('/user/logout/{slug}', 'UserController@logout')->name('user.logout');
		Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
		Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
		Route::resource('users', 'UserController');
		/** PROFILE **/
		Route::get('/profile', 'ProfileController@details')->name('profile.details');
		Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
		Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
		Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');
		/** MENU **/

        Route::resource('std/premix','PremixController',[
            'as' => 'std'
        ]);
        Route::resource('ImportedCommodities','User\ImportedCommoditiesController');

	});



    Route::post('admin/admins/update-status/{id}', [AdminsController::class, 'updateStatus'])
        ->name('admin.admins.update.status');

    Route::post('admin/users/update-status/{slug}', [UserController::class, 'updateStatus'])
        ->name('admin.users.update.status');

//    Route::get('/verify_email','User\UserController@verifyEmail')->name('dashboard.verify_email');
//	Route::get('/sendmail', 'User\UserController@sendEmailVerification');

	Route::group(['prefix'=>'admin', 'as' => 'admin.', 'middleware' => ['check.admin_route']], function () {
        Route::get('home', 'Admin\HomeController@index')->name('home');

		Route::resource('menus', 'Admin\MenuController');
		Route::resource('functions','Admin\FunctionController');
		Route::post('functions/add_resource','Admin\FunctionController@add_resource')->name('functions.add_resource');
		//Route::get('/', 'AdminController@index')->name('admin.dashboard');
		Route::resource('users','Admin\UserController');

//		Route::post('admins/update-status/{id}','Admin\AdminsController@updateStatus')->name('admins.update.status');
		Route::resource('admins','Admin\AdminsController');
		Route::get('/test', 'Admin\AdminsController@test')->name('admins.test');
//        Route::resource('/order_of_payments','Admin\OrderOfPaymentsController');


//        Route::resource('/sucrose','Admin\SucroseController');
        Route::resource('/preRegistration','Admin\PreRegistrationController');
        Route::post('/preRegistration/approved/{id}','Admin\PreRegistrationController@approved')->name('preRegistration.approved');



        Route::get('/application/attachments/{slug}/showApplicationFile',
            [ApplicationController::class, 'showApplicationFile']
        )->middleware('auth')->name('application.attachments.showApplicationFile');
        Route::post('application/{slug}/revokedUpdate','Admin\ApplicationController@revokedUpdate')->name('application.revokedUpdate');
        Route::post('/update-status', [ApplicationController::class, 'updateStatus'])->name('update.status');
        Route::resource('/application', 'Admin\ApplicationController');

        Route::get('ImportedCommodities/{slug}/printOrderOfPayment', 'Admin\ImportedCommoditiesController@printOrderOfPayment')->name('ImportedCommodities.printOrderOfPayment');
//        Route::get('ImportedCommodities/printOrderOfPayment', [\App\Http\Controllers\Admin\ImportedCommoditiesController::class, 'printOrderOfPayment'])
//            ->name('ImportedCommodities.printable.printOrderOfPayment');

        Route::post('/importedCommodities/{slug}/updateOrderPayment', 'Admin\ImportedCommoditiesController@updateOrderPayment')->name('importedCommodities.updateOrderPayment');
        Route::get('/importedCommodities/{slug}/orderOfPayment','Admin\ImportedCommoditiesController@orderPayment')->name('importedCommodities.orderOfPayment');
        Route::get('/importedCommodities/attachments/{slug}/showApplicationFile', 'Admin\ImportedCommoditiesController@showApplicationFile')->name('importedCommodities.attachments.showApplicationFile');
        Route::post('importedCommodities/{slug}/revokedUpdate','Admin\ImportedCommoditiesController@revokedUpdate')->name('importedCommodities.revokedUpdate');
        Route::post('/update-status','Admin\ImportedCommoditiesController@updateStatus')->name('update.status');
//        Route::post('/update-status', [ApplicationController::class, 'updateStatus'])->name('update.status');
        Route::get('/admin/importedCommodities/revoked', 'Admin\ImportedCommoditiesController@revoked')->name('importedCommodities.revoked');
        Route::get('/admin/importedCommodities/approved', 'Admin\ImportedCommoditiesController@approved')->name('importedCommodities.approved');


        Route::resource('/importedCommodities', 'Admin\ImportedCommoditiesController');

    });



//Route::get('/printTransactionIc/{slug}', 'User\ImportedCommoditiesController@printTransactionIc')->name('printTransactionIc');

    Route::post('/ImportedCommodities/attachment/','User\ImportedCommoditiesController@edit')->name('ImportedCommodities.attachment');
    Route::get('ImportedCommodities/attachment', 'User\ImportedCommoditiesController@attachment')->name('ImportedCommodities.attachment');
    Route::get('printTransactionIc', 'User\ImportedCommoditiesController@printTransactionIc')->name('printTransactionIc');

//Route::post('/ImportedCommodities/applicationForm','User\ImportedCommoditiesController@applicationForm')->name('applicationForm');

    Route::middleware(['auth:web'])->group(function () {
        Route::post('/ImportedCommodities/applicationFormUpdate',
            'User\ImportedCommoditiesController@applicationFormUpdate'
        )->name('applicationFormUpdate');
    });

//    Route::get('/get-file-paths/{slug}', [\App\Models\User\ImportedCommodities::class, 'getFilePaths']);

//Route::get('/api/get-file-paths/{slug}', 'User\HomeController@getFilePaths');


Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    Route::get('view_file/{tableName}/{slug}','Admin\HomeController@viewFile')->name('view_file');
    Route::get('view_file_custom/{tableName}/{slug}/{columnName}','Admin\HomeController@viewFileCustom')->name('view_file_custom');

//    Route::get('show_file_custom/{tableName}/{slug}/{columnName}','Admin\HomeController@showFileCustom')->name('show_file_custom');

    Route::get('show_file_custom/{tableName}/{slug}/{columnName}', 'Admin\HomeController@showFileCustom')->name('show_file_custom');
    Route::get('show_file_custom_user/{tableName}/{slug}/{columnName}', 'User\HomeController@showFileCustom')->name('show_file_custom');

Route::patch('/dashboard/ImportedCommodities/{slug}', [ImportedCommoditiesController::class, 'update'])
    ->name('dashboard.ImportedCommodities.update');



Route::get('/get_settings', function(){
    if(request()->ajax()){
        if(request()->has('lkgtc_multiplier')){
            $setting = \App\Models\Settings::where('setting','lkgtc_multiplier')->first();
            $multiplier = $setting->float_value;
            $service_charge = 10.00;
            return [
                'amount' => number_format((request()->get('lkgtc_multiplier') * $multiplier),2)
            ];
        };
    }
    abort(404);
})->name('dashboard.get_settings');
/** Testing **/
Route::get('/dashboard/test', function(){

	//return dd(Illuminate\Support\Str::random(16));

});

Route::get('/testing_page', function(){
    return view('dashboard.test');
});

Route::get('/receive', function(){
	return view('test.receive');
});

