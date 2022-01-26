<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Admin\ADAccountHolders;
use  App\Http\Controllers\Admin\ADContacts;
use App\Http\Controllers\Admin\ADCreditRequest;
use App\Http\Controllers\Admin\ADDeals;
use  App\Http\Controllers\Admin\ADListingManager;
use  App\Http\Controllers\Admin\ADTestimonials;
use  App\Http\Controllers\Admin\ADSettings;
use  App\Http\Controllers\PagesController;
use  App\Http\Controllers\OffersController;
use  App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CreditRequestController;
use  App\Http\Controllers\DealTrackingController;
use  App\Http\Controllers\ExchangeController;
use  App\Http\Controllers\ReviewsController;
use  App\Http\Controllers\TradingController;
use  App\Http\Controllers\UserDashboardController;
use  App\Http\Controllers\ListingController;
use  App\Http\Controllers\NotificationController;
use App\Http\Controllers\BannedController;
use App\Http\Controllers\WebSocketController;

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

Auth::routes();

/**
 * Website Pages
 */
Route::get('',[PagesController::class, 'home']);
Route::get('/', [PagesController::class, 'home'])->name('home');

Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact/post', [PagesController::class, 'contact_post']);

Route::get('/exchange', [ExchangeController::class, 'index'])->name('exchange');
Route::get('/exchange/{slug}', [ExchangeController::class, 'view']);

Route::get('/user/{username}', [UserDashboardController::class, 'user']);

/**
 * Legal Pages
 */
Route::get('/terms-conditions', [PagesController::class, 'termsConditions']);
Route::get('/terms-of-service', [PagesController::class, 'termsofService']);

/**
 * Reviews
 */
Route::get('/reviews/{user_id}', [ReviewsController::class, 'index']);
Route::get('/reviews_meta/{user_id}', [ReviewsController::class, 'review_meta']);

Route::get('banned',[BannedController::class,'banned']);

//Route::get('/users/{username}/offers', [PagesController::class, 'contact'])->name('contact');
//Route::get('/users/{username}/start-a-trade', [PagesController::class, 'contact'])->name('start-a-trade');

/**
 * Routes for Users
 */
Route::middleware(['auth', 'checkuserrole:user','checkbanned'])->group(function () {
    Route::get('/users/settings/account', [UserDashboardController::class, 'settings'])->name('user-settings');
    Route::post('/users/settings/account', [UserDashboardController::class, 'update_account']);
    Route::get('/users/settings/profile-photo', [UserDashboardController::class, 'profile_photo']);
    Route::post('/users/settings/profile-photo', [UserDashboardController::class, 'update_profile_photo']);

    Route::get('/users/listings', [ListingController::class, 'index']);

    Route::get('/users/settings/security', [UserDashboardController::class, 'security'])->name('user-security');
    
    Route::get('/users/{username}/dashboard', [UserDashboardController::class, 'index'])->name('user-dashboard');

    Route::post('/change/password', [UserDashboardController::class, 'change_password'])->name('change-password');

    
    Route::get('/my/listings', [ListingController::class, 'get_listing']);
    Route::get('/listings/add-listing', [ListingController::class, 'newView']);
    Route::post('/listings/add-listing', [ListingController::class, 'newPost']);
    Route::get('/listing/{slug}', [ListingController::class, 'single_list']);
    Route::post('/listing/cancel', [ListingController::class, 'cancel']);
    Route::get('/listing/edit/{id}', [ListingController::class, 'edit']);
    Route::post('/listing/update', [ListingController::class, 'update']);

    Route::get('/messages', [WebSocketController::class, 'index']);
    Route::post('/messages/get_by_user', [WebSocketController::class, 'get_by_user']);
    Route::post('/messages/get_users', [WebSocketController::class, 'get_users']);
    Route::get('/messages/count_new', [WebSocketController::class, 'count_new']);

    Route::post('/offer/post', [OffersController::class, 'store']);


    Route::get('/offers', [OffersController::class, 'index']);
    Route::post('/offers/status', [OffersController::class, 'get_by_status']);
    Route::get('/offers/{id}', [OffersController::class, 'get_offers']);
    

    Route::post('decline-offer',[OffersController::class,'decline_offer']);

    Route::get('/trading', [TradingController::class, 'index']);
    Route::get('/trading_by_user', [TradingController::class, 'get_by_user']);
    Route::post('/trading/status', [TradingController::class, 'get_by_status']);
    Route::post('/checkout', [CheckoutController::class,'checkout']);

    /**
     * Notification Controller
     */
    Route::get('notifications',[NotificationController::class,'get_notifications']);
    Route::get('notification/markasread/{id}',[NotificationController::class,'markNotificationAsRead']);
    Route::get('notification/markallasread',[NotificationController::class,'markAllNotificationAsRead']);

    Route::post('charge',[CheckoutController::class,'charge']);
    Route::get('thank-you',[CheckoutController::class,'thankYou']);
    Route::get('deal_tracking/{id}', [DealTrackingController::class, 'index']);

    Route::post('review',[ReviewsController::class,'store']);
    
    Route::post('withdraw',[CreditRequestController::class,'create']);
});

/**
 * Admin Routes
 */
Route::middleware(['auth', 'checkuserrole:admin'])->group(function () {
    #Prefix Starts
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard',[ADAccountHolders::class,'index'])->name('admin-dashboard');
        Route::put('/cancel-listing',[ListingController::class,'cancelbyAdmin']);
        /**
         * Users
         */
        Route::get('/users',[ADAccountHolders::class,'index']);
        Route::get('/users/{id}',[ADAccountHolders::class,'view']);
        Route::get('/users/delete/{id}',[ADAccountHolders::class,'delete'])->name('delete-user');
        Route::get('/users/undelete/{id}',[ADAccountHolders::class,'undelete'])->name('undelete-user');
    
        /**
         * Listing
         */
        Route::get('/listing',[ADListingManager::class,'index']);
    
        /**
         * Contacts
         */
        Route::get('/contacts',[ADContacts::class,'index']);
        Route::get('/contacts/delet/{id}',[ADContacts::class,'delete'])->name('contact_delete');
    
        /**
        * Settings
        */
        Route::get('/settings',[ADSettings::class,'index'])->name('admin-testimonials');
        Route::post('/settings/prices',[ADSettings::class,'update_prices']);
        Route::post('/settings/banner',[ADSettings::class,'update_banner']);

        /**
        * Testimonials
        */
        Route::get('/testimonials',[ADTestimonials::class,'index']);
        Route::get('/testimonials/add-new',[ADTestimonials::class,'postView'])->name('admin-testimonials-add');
        Route::post('/testimonials/add-new',[ADTestimonials::class,'store']);
        Route::get('/testimonials/{id}',[ADTestimonials::class,'singleView']);
        Route::post('/testimonials/update',[ADTestimonials::class,'update']);
        Route::get('/testimonials/delete/{id}',[ADTestimonials::class,'delete'])->name('testimonial-delete');
        
        /**
         * Deals & Tracking Data
         */
        Route::get('/deals',[ADDeals::class,'index']);
        Route::post('/deals/tracking/{id}',[ADDeals::class,'tracking']);
        Route::get('/deal/{id}',[ADDeals::class,'edit']);
        Route::put('/deals/{id}',[ADDeals::class,'update']);
        Route::delete('/deals/{id}',[ADDeals::class,'delete']);
        
        /**
         * Credit Requests
         */
        Route::get('credit-requests',[ADCreditRequest::class,'index']);
        Route::post('credit-requests/{id}',[ADCreditRequest::class,'withdraw']);
        Route::delete('credit-requests/{id}',[ADCreditRequest::class,'delete']);
        
        /**
         * Clear Funds
         */
        Route::get('clear-funds/{id}',[ADAccountHolders::class,'clearFunds']);
    });
    #End Prefix
    
});
