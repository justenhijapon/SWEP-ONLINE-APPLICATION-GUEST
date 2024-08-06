<?php

//test commit
    /** Auth **/
    Route::group(['as' => 'auth.'], function () {

        Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
        Route::post('/', 'Auth\LoginController@login')->name('login');

        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
        Route::post('/signup','User\UserController@store')->name('signup');
        Route::get('/register','User\UserController@showForm')->name('signup.show_form');
        Route::get('verifyTransaction', 'PaymentController@getTransaction')->name('verifyTransaction');
    });
    Route::get('verifyTransaction', 'PaymentController@getTransaction')->name('verifyTransaction');
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
		Route::resource('menu', 'MenuController');
		//Route::resource('permits', 'User\PermitController');
		//Route::resource('shipping-permits', 'Shared\ShippingPermitController');
		Route::get('shipping-permits/my-shipping-permits', 'Shared\ShippingPermitController@userIndex')->name('shipping-permits.my-shipping-permits');
		Route::get('shipping-permits/apply', 'Shared\ShippingPermitController@userShowApply')->name('shipping-permits.apply');
        Route::post('payments/validate_form', 'PaymentController@validateForm')->name('payments.validate_form');
        Route::get('payments/groupSelected/{id}', 'PaymentController@groupSelected')->name('payments.groupSelected');
        Route::get('payments/getLabAnalysis', 'PaymentController@getLabAnalysis')->name('payments.getLabAnalysis');
        Route::get('payments/getLabAnalysisTypes/{id}', 'PaymentController@getLabAnalysisTypes')->name('payments.getLabAnalysisTypes');
        Route::get('payments/view_file', 'PaymentController@view_file')->name('payments.view_file');
		Route::post('payments/review', 'PaymentController@review')->name('payments.review');
        Route::post('OOP/{id}', 'PaymentController@orderOfPaymentsDetails')->name('OOP');
        Route::get('landBank/{id}', 'PaymentController@landBank')->name('landBank');
        Route::post('payments/payToLandbank', 'PaymentController@payToLandbank')->name('payments.payToLandbank');
        Route::resource('payments','PaymentController');
        Route::resource('std/premix','PremixController',[
            'as' => 'std'
        ]);
	});
	Route::get('/verify_email','User\UserController@verifyEmail')->name('dashboard.verify_email');
	Route::get('/sendmail', 'User\UserController@sendEmailVerification');

	Route::group(['prefix'=>'admin', 'as' => 'admin.', 'middleware' => ['check.admin_route']], function () {
        Route::get('home', 'Admin\HomeController@index')->name('home');

		Route::resource('menus', 'Admin\MenuController');
		Route::resource('functions','Admin\FunctionController');
		Route::post('functions/add_resource','Admin\FunctionController@add_resource')->name('functions.add_resource');
		//Route::get('/', 'AdminController@index')->name('admin.dashboard');
		Route::resource('users','Admin\UserController');
		Route::resource('admins','Admin\AdminsController');
		Route::get('/test', 'Admin\AdminsController@test')->name('admins.test');
        Route::resource('/order_of_payments','Admin\OrderOfPaymentsController');
		// Route::resource('shipping-permits', 'Shared\ShippingPermitController');
		//Route::get('admin/shipping-permits','Shared\ShippingPermitController@index');
		Route::get('shipping-permits', 'Shared\ShippingPermitController@index')->name('shipping-permits.index');

        Route::resource('/sucrose','Admin\SucroseController');
        Route::resource('/preRegistration','Admin\PreRegistrationController');
        Route::post('/preRegistration/approved/{id}','Admin\PreRegistrationController@approved')->name('preRegistration.approved');
        Route::resource('/labAnalysis', 'Admin\LabAnalysisController');
        Route::resource('/transactionType', 'Admin\TransactionTypeController');
        Route::get('labAnalysis/searchClient/{searchValue}', 'Admin\LabAnalysisController@searchClient')->name('labAnalysis.searchClient');
        Route::get('labAnalysis/getClient/{selectedRecord}', 'Admin\LabAnalysisController@getClient')->name('labAnalysis.getClient');
        Route::get('payments/view_file', 'Admin\OrderOfPaymentsController@view_file')->name('payments.view_file');
        Route::get('payments/pay/{id}', 'Admin\OrderOfPaymentsController@pay')->name('payments.pay');
        Route::post('/order_of_payments', 'Admin\OrderOfPaymentsController@paid')->name('payments.paid');
        Route::post('payments/approved/{id}','Admin\OrderOfPaymentsController@approved')->name('payments.approved');

        Route::resource('payments','Admin\OrderOfPaymentsController');
    });

	Route::get('printTransaction', 'PaymentController@printTransaction')->name('printTransaction');
    Route::get('printTransactionReport', 'PaymentController@printTransactionReport')->name('printTransactionReport');
    Route::get('printTransactionReportDaily', 'PaymentController@printTransactionReportDaily')->name('printTransactionReportDaily');
    Route::get('printTransactionReportClient', 'PaymentController@printTransactionReportClient')->name('printTransactionReportClient');

	Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

	// Route::group(['prefix' => 'shared', 'as' => 'shared.'], function(){
		
	// });

	// Route::prefix('admin')->as('admin.')->group(function(){

	// 	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('login');
	// 	Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit');

	// 	Route::get('/home', 'Admin\HomeController@index')->name('home');

	// 	Route::resource('menus', 'Admin\MenuController');

	// 	Route::resource('functions','Admin\FunctionController');
	// 	Route::post('functions/add_resource','Admin\FunctionController@add_resource')->name('functions.add_resource');
	// 	//Route::get('/', 'AdminController@index')->name('admin.dashboard');
	// 	Route::resource('users','Admin\UserController');
	// 	Route::resource('admins','Admin\AdminsController');
	// });


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

