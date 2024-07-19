<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\LanguageController;
use App\Livewire\Privacy;
use App\Livewire\Terms;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\CarController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\Backend\AlertController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Backend\ContactsController;
use App\Http\Controllers\Backend\VehiclestatusController;
use App\Http\Controllers\Backend\ReservationController;
use App\Http\Controllers\Backend\CustomercontactController;
use App\Http\Controllers\Backend\EnquiryController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\MoneySetupController;
use App\Http\Controllers\Frontend\TwintController;
use App\Http\Controllers\StripeWebhookController;

/*
*
* Auth Routes
*
* --------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
        // Backend routes//

// vehicle
Route::resource('admin/vehicle', VehicleController::class);
// vehiclestatus
Route::resource('admin/vehiclestatus', VehiclestatusController::class);
// alert
Route::resource('admin/alert', AlertController::class);
// contact
Route::resource('admin/contact', ContactsController::class);
// contact
Route::resource('admin/enquiry', EnquiryController::class);

// Reservation
Route::resource('admin/reservation', ReservationController::class);

// Customercontact
Route::resource('admin/customercontact', CustomercontactController::class);


// payment getwey
Route::get('stripe/checkout', [StripeWebhookController ::class, 'stripeCheckout'])->name('stripe-checkout');
Route::get('stripe/checkout/success', [StripeWebhookController::class, 'stripeCheckoutSuccess'])->name('stripe-checkout-success');
Route::get('stripe/checkout/cancel', [StripeWebhookController::class, 'stripeCheckoutCancel'])->name('stripe-checkout-cancel');

Route::get('twint/payment', [TwintController::class, 'showPaymentForm'])->name('twint.payment');
Route::post('twint/payment', [TwintController::class, 'processPayment'])->name('twint.process');
Route::get('twint/success', [TwintController::class, 'success'])->name('twint.success');
Route::get('twint/failure', [TwintController::class, 'failure'])->name('twint.failure');


//frontend routes

Route::get('reservation', [FrontendController::class, 'reservation'])->name('reservation');
Route::post('booking-checkout', [BookingController::class, 'bookingCheckout'])->name('booking-checkout');

// Route::post('reservation', [FrontendController::class, 'save'])->name('reservation.save');

// contact
Route::get('booking', [BookingController::class, 'booking'])->name('booking');

// contact
Route::post('contact', [ContactController::class, 'submit'])->name('contact.submit');
// home route
Route::get('home', [FrontendController::class, 'index'])->name('home');
// cars
Route::get('/cars', [FrontendController::class, 'cars'])->name('cars');
Route::post('/cars-post', [FrontendController::class, 'carsPost'])->name('cars-post');

// cardetails
Route::post('/carsdetails-post', [FrontendController::class, 'carsdetailsPost'])->name('carsdetails-post');
Route::get('carsdetails/{slug}', [FrontendController::class, 'cardetails'])->name('carsdetails');
// login
Route::get('/login', [FrontendController::class, 'login'])->name('login');
// Register
Route::get('/register', [FrontendController::class, 'register'])->name('register');
Route::get('contact', [FrontendController::class, 'contact'])->name('contact');

Route::view('/keybox', 'frontend.keybox');


// Language Switch
Route::get('language/{language}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('dashboard', 'App\Http\Controllers\Frontend\FrontendController@index')->name('dashboard');

// pages
Route::get('terms', Terms::class)->name('terms');
Route::get('privacy', Privacy::class)->name('privacy');

Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', 'FrontendController@index')->name('index');

    Route::group(['middleware' => ['auth']], function () {
        /*
        *
        *  Users Routes
        *
        * ---------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        Route::get('profile/edit', ['as' => "{$module_name}.profileEdit", 'uses' => "{$controller_name}@profileEdit"]);
        Route::patch('profile/edit', ['as' => "{$module_name}.profileUpdate", 'uses' => "{$controller_name}@profileUpdate"]);
        Route::get('profile/changePassword', ['as' => "{$module_name}.changePassword", 'uses' => "{$controller_name}@changePassword"]);
        Route::patch('profile/changePassword', ['as' => "{$module_name}.changePasswordUpdate", 'uses' => "{$controller_name}@changePasswordUpdate"]);
        Route::get('profile/{username?}', ['as' => "{$module_name}.profile", 'uses' => "{$controller_name}@profile"]);
        Route::get("{$module_name}/emailConfirmationResend", ['as' => "{$module_name}.emailConfirmationResend", 'uses' => "{$controller_name}@emailConfirmationResend"]);
        Route::delete("{$module_name}/userProviderDestroy", ['as' => "{$module_name}.userProviderDestroy", 'uses' => "{$controller_name}@userProviderDestroy"]);
    });
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {
    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['can:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';
        Route::get("{$module_name}", "{$controller_name}@index")->name("{$module_name}");
        Route::post("{$module_name}", "{$controller_name}@store")->name("{$module_name}.store");
    });

    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';
    Route::get("{$module_name}", ['as' => "{$module_name}.index", 'uses' => "{$controller_name}@index"]);
    Route::get("{$module_name}/markAllAsRead", ['as' => "{$module_name}.markAllAsRead", 'uses' => "{$controller_name}@markAllAsRead"]);
    Route::delete("{$module_name}/deleteAll", ['as' => "{$module_name}.deleteAll", 'uses' => "{$controller_name}@deleteAll"]);
    Route::get("{$module_name}/{id}", ['as' => "{$module_name}.show", 'uses' => "{$controller_name}@show"]);

    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("{$module_name}", ['as' => "{$module_name}.index", 'uses' => "{$controller_name}@index"]);
    Route::get("{$module_name}/create", ['as' => "{$module_name}.create", 'uses' => "{$controller_name}@create"]);
    Route::get("{$module_name}/download/{file_name}", ['as' => "{$module_name}.download", 'uses' => "{$controller_name}@download"]);
    Route::get("{$module_name}/delete/{file_name}", ['as' => "{$module_name}.delete", 'uses' => "{$controller_name}@delete"]);

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("{$module_name}", "{$controller_name}");

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("{$module_name}/emailConfirmationResend/{id}", ['as' => "{$module_name}.emailConfirmationResend", 'uses' => "{$controller_name}@emailConfirmationResend"]);
    Route::delete("{$module_name}/userProviderDestroy", ['as' => "{$module_name}.userProviderDestroy", 'uses' => "{$controller_name}@userProviderDestroy"]);
    Route::get("{$module_name}/changePassword/{id}", ['as' => "{$module_name}.changePassword", 'uses' => "{$controller_name}@changePassword"]);
    Route::patch("{$module_name}/changePassword/{id}", ['as' => "{$module_name}.changePasswordUpdate", 'uses' => "{$controller_name}@changePasswordUpdate"]);
    Route::get("{$module_name}/trashed", ['as' => "{$module_name}.trashed", 'uses' => "{$controller_name}@trashed"]);
    Route::patch("{$module_name}/trashed/{id}", ['as' => "{$module_name}.restore", 'uses' => "{$controller_name}@restore"]);
    Route::get("{$module_name}/index_data", ['as' => "{$module_name}.index_data", 'uses' => "{$controller_name}@index_data"]);
    Route::get("{$module_name}/index_list", ['as' => "{$module_name}.index_list", 'uses' => "{$controller_name}@index_list"]);
    Route::resource("{$module_name}", "{$controller_name}");
    Route::patch("{$module_name}/{id}/block", ['as' => "{$module_name}.block", 'uses' => "{$controller_name}@block", 'middleware' => ['can:block_users']]);
    Route::patch("{$module_name}/{id}/unblock", ['as' => "{$module_name}.unblock", 'uses' => "{$controller_name}@unblock", 'middleware' => ['can:block_users']]);
});
