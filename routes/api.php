<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/coinbase', array('as' => 'coinbase', 'uses' => 'Api\CountryController@coinbase'));

Route::post('register', 'API\RegisterController@register');


	Route::middleware('auth:api')->group(  function () {
 
	 
	Route::post('/user_login_details', array('as' => 'user_login_details', 'uses' => 'Api\UsersController@user_login_details'));
	  
		Route::post('details', 'Api\UsersController@details');
		
	
});



 
 
//================================================ Goteso Ecommerce Routes Starts ================================================================//
//================================================================================================================================================//
 
Route::group(array('namespace'=>'Test'    ), function()
{

 Route::post('/v1/login/', array('uses' => 'UserController@login')); 

 Route::get('/testroutes/', array('uses' => 'testController@testroute'));//Route-1.1

	//================================================ Items Starts ==================================================================================//
  Route::post('/v1/items/', array('uses' => 'ItemsController@store'));//Route-1.1
	Route::get('/v1/items/{id}', array('uses' => 'ItemsController@show'));//Route-1.2
	Route::get('/v1/items/', array('uses' => 'ItemsController@get_list'));//Route-1.3
  Route::put('/v1/items/{id}/', array('uses' => 'ItemsController@update'));//Route-1.4
  Route::delete('/v1/items/{id}/', array('uses' => 'ItemsController@destroy'));//Route-1.5
  Route::put('/v1/items/item-active-status/update/{id}', array('uses' => 'ItemsController@item_active_status_update'));//Route-1.6

  Route::post('/v1/items-images/', array('uses' => 'ItemsImagesController@store'));//Route-1.7
  Route::get('/v1/items-images/{item_id}/', array('uses' => 'ItemsImagesController@get_list'));//Route-1.8
  Route::delete('/v1/items-images/{items_image_id}/', array('uses' => 'ItemsImagesController@destroy'));//Route-1.9

 	//================================================ Items Ends ====================================================================================//
     //================================================ item Forms starts ===========================================================================//
    Route::post('/v1/form/item', array('uses' => 'ItemsController@submit_add_form'));//Route-1.7
    Route::put('/v1/form/item/{id}', array('uses' => 'ItemsController@submit_edit_form'));//Route-1.8
  //================================================ Item Forms Ends ===============================================================================//


	 
	//================================================ Categories Starts =============================================================================//
  Route::post('/v1/category', array('uses' => 'SettingCategoriesController@store'));//Route-2.1
	Route::get('/v1/category/', array('uses' => 'SettingCategoriesController@get_list'));//Route-2.2
  Route::put('/v1/category/{id}', array('uses' => 'SettingCategoriesController@update'));//Route-2.3
  Route::delete('/v1/category/{id}', array('uses' => 'SettingCategoriesController@destroy'));//Route-2.4
  Route::put('/v1/category/update-status/{id}/', array('uses' => 'SettingCategoriesController@update_status')); // Route-2.5
	//================================================ Categories Ends ===============================================================================//
	
	 

  //================================================ tags Starts ====================================================================================//
  Route::post('/v1/tag/', array('uses' => 'SettingTagsController@store'));//Route-3.1
	Route::get('/v1/tag/', array('uses' => 'SettingTagsController@get_list'));//Route-3.2
  Route::put('/v1/tag/{id}', array('uses' => 'SettingTagsController@update'));//Route-3.3
  Route::delete('/v1/tag/{id}', array('uses' => 'SettingTagsController@destroy'));//Route-3.4
  Route::put('/v1/tag/update-status/{id}/', array('uses' => 'SettingTagsController@update_status'));//Route-3.5
	//================================================ Tags Ends ======================================================================================//
 


	//================================================ Item Variant Starts ===========================================================================//
  Route::post('/v1/items-variants', array('uses' => 'ItemVariantsController@store'));//Route-4.1
	Route::get('/v1/items-variants', array('uses' => 'ItemVariantsController@get_list'));//Route-4.2
  Route::put('/v1/items-variants/{id}', array('uses' => 'ItemVariantsController@update'));//Route-4.3
  Route::delete('/v1/items-variants/{id}', array('uses' => 'ItemVariantsController@destroy'));//Route-4.4
	//================================================ Item variant Ends ===============================================================================//






   //================================================ Coupons Starts ==================================================================================//
  Route::post('/v1/coupons/', array('uses' => 'CouponsController@store'));//Route-5.1
	Route::get('/v1/coupons/{id}', array('uses' => 'CouponsController@show'));//Route-5.2
	Route::get('/v1/coupons/', array('uses' => 'CouponsController@get_list'));//Route-5.3
  Route::put('/v1/coupons/{id}/', array('uses' => 'CouponsController@update'));//Route-5.4
  Route::post('/v1/coupons-apply/', array('uses' => 'CouponsController@apply'));//Route-5.5
  Route::delete('/v1/coupons/{id}/', array('uses' => 'CouponsController@destroy'));//Route-5.6
	//================================================ Coupons Ends ====================================================================================//
	
 

	//================================================ Locations Starts ==================================================================================//
  Route::post('/v1/locations/', array('uses' => 'LocationsController@store'));//Route-6.1
	Route::get('/v1/locations/', array('uses' => 'LocationsController@get_list'));//Route-6.2
  Route::put('/v1/locations/{id}/', array('uses' => 'LocationsController@update'));//Route-6.3
  Route::delete('/v1/locations/{id}/', array('uses' => 'LocationsController@destroy'));//Route-6.4
    //================================================ Locations Ends ====================================================================================//



  //================================================ Faqs Starts ==================================================================================//
  Route::post('/v1/faqs/', array('uses' => 'FaqsController@store'));//Route-7.1
  Route::get('/v1/faqs/', array('uses' => 'FaqsController@get_list'));//Route-7.2
  Route::put('/v1/faqs/{id}/', array('uses' => 'FaqsController@update'));//Route-7.3
  Route::delete('/v1/faqs/{id}/', array('uses' => 'FaqsController@destroy'));//Route-7.4
  //================================================ Faqs Ends ====================================================================================//



	//================================================ Areas Starts ==================================================================================//
    Route::post('/v1/areas/', array('uses' => 'AreasController@store'));//Route-29
	Route::get('/v1/areas/', array('uses' => 'AreasController@get_list'));//Route-30
    Route::put('/v1/areas/{id}/', array('uses' => 'AreasController@update'));//Route-31
    Route::delete('/v1/areas/{id}/', array('uses' => 'AreasController@destroy'));//Route-32
    Route::get('/v1/areas-nearby/', array('uses' => 'AreasController@get_list_nearby'));//Route-33
	//================================================ Areas Ends ====================================================================================//
	


	//================================================ Timeslots Starts ==================================================================================//
    Route::post('/v1/timeslots/', array('uses' => 'TimeSlotsController@store'));//Route-34
	  Route::get('/v1/timeslots/', array('uses' => 'TimeSlotsController@get_list'));//Route-35
    Route::put('/v1/timeslots/{id}/', array('uses' => 'TimeSlotsController@update'));//Route-36
    Route::delete('/v1/timeslots/{id}/', array('uses' => 'TimeSlotsController@destroy'));//Route-37
    Route::get('/v1/timeslots_settings/', array('uses' => 'TimeSlotsController@get_list_settings'));//Route-63

    Route::get('/v1/timeslots/form/', array('uses' => 'TimeSlotsController@get_edit_form'));// 

   	//================================================ Timeslots Ends ====================================================================================//



   	//================================================ Addresses Starts ==================================================================================//
    Route::post('/v1/address/', array('uses' => 'AddressController@store'));//Route-38
	Route::get('/v1/address/', array('uses' => 'AddressController@get_list'));//Route-39
    Route::put('/v1/address/{id}/', array('uses' => 'AddressController@update'));//Route-40
    Route::delete('/v1/address/{id}/', array('uses' => 'AddressController@destroy'));//Route-41
   	//================================================ Addresses Ends ====================================================================================//
	

 
   	//================================================ Users Starts =====================================================================================//
    Route::post('/v1/users/', array('uses' => 'UserController@store'));//Route-11.1
  	Route::get('/v1/users/', array('uses' => 'UserController@get_list'));//Route-11.2
	  Route::get('/v1/users/{id}', array('uses' => 'UserController@show'));//Route-11.3
    Route::put('/v1/users/{id}/', array('uses' => 'UserController@update'));//Route-11.4
    Route::delete('/v1/users/{id}/', array('uses' => 'UserController@destroy'));//Route-11.5
    Route::put('/v1/users/update-password/{user_id}', array('uses' => 'UserController@update_password'));//Route-11.6
   	//================================================ Users Ends ======================================================================================//
    //================================================ user Forms starts ===============================================================================//
    Route::post('/v1/form/user', array('uses' => 'UserController@submit_add_form')); //Route-11.6
    Route::put('/v1/form/user/{id}', array('uses' => 'UserController@submit_edit_form')); //Route-11.7
	  //================================================ User Forms Ends =================================================================================//
 
 
   	//================================================ Users Starts ==================================================================================//
    Route::post('/v1/users/', array('uses' => 'UserController@store'));//Route-51
	Route::get('/v1/users/', array('uses' => 'UserController@get_list'));//Route-52
	Route::get('/v1/users/{id}', array('uses' => 'UserController@show'));//Route-53
    Route::put('/v1/users/{id}/', array('uses' => 'UserController@update'));//Route-54
    Route::delete('/v1/users/{id}/', array('uses' => 'UserController@destroy'));//
 
   	//================================================ Users Ends ====================================================================================//


	 //================================================ user Forms starts ===========================================================================//
    Route::post('/v1/form/user', array('uses' => 'UserController@submit_add_form')); 
    Route::put('/v1/form/user/{id}', array('uses' => 'UserController@submit_edit_form')); 
	//================================================ User Forms Ends ===============================================================================//


   	//================================================ Stores Starts ==================================================================================//
    Route::post('/v1/stores/', array('uses' => 'StoreController@store'));//Route-55
	Route::get('/v1/stores/', array('uses' => 'StoreController@get_list'));//Route-56
	Route::get('/v1/stores/{id}', array('uses' => 'StoreController@show'));//Route-57
    Route::put('/v1/stores/{id}/', array('uses' => 'StoreController@update'));//Route-58
    Route::delete('/v1/stores/{id}/', array('uses' => 'StoreController@destroy'));// 


    Route::put('/v1/stores/update-featured/{id}/', array('uses' => 'StoreController@update_featured'));

     Route::get('/v1/stores/{id}/form/meta', array('uses' => 'StoreController@get_store_meta_form'));//
     Route::post('/v1/stores/{id}/form/meta', array('uses' => 'StoreController@submit_store_meta_form'));//

     Route::post('/v1/stores/{id}/submit_store_edit_forms', array('uses' => 'StoreController@submit_store_edit_forms'));//

 

 

     Route::get('/v1/stores/log-update-request/list', array('uses' => 'StoreController@log_update_request_list'));//
     Route::put('/v1/stores/approve-log-update-request/{id}', array('uses' => 'StoreController@approve_log_update_request'));//

     Route::put('/v1/stores/reject-log-update-request/{id}', array('uses' => 'StoreController@reject_log_update_request'));//
 //================================================ Stores Ends ====================================================================================//



//================================================= Sorted Stores Started ================================================================
     Route::get('/v1/stores-sorted', array('uses' => 'StoreSortedController@get_list'));//
     Route::put('/v1/stores-sorted', array('uses' => 'StoreSortedController@sort_stores'));//
//================================================= Sorted Stores Ends ================================================================






   	//================================================ Orders Starts ==================================================================================//
    Route::post('/v1/orders/', array('uses' => 'OrderController@store'));//Route-59
	Route::get('/v1/orders/', array('uses' => 'OrderController@get_list'));//Route-60
	Route::get('/v1/orders/{id}', array('uses' => 'OrderController@show'));//Route-61
    Route::put('/v1/orders/{id}/', array('uses' => 'OrderController@update'));//Route-62
    Route::post('/v1/orders/calculate', array('uses' => 'OrderController@order_calculate'));//Route-63
    Route::put('/v1/orders/{id}/status-update', array('uses' => 'OrderController@status_update'));// 

    Route::get('/v1/orders/get-reorder-data/{id}', array('uses' => 'OrderController@get_reorder_data'));// 

         Route::get('/v1/driver-location/order/{id}', array('uses' => 'OrderController@driver_location_by_order'));//Route-
    //================================================ Orders Ends ====================================================================================//

    //================================================ Orders Forms Starts ==================================================================================//
    Route::get('/v1/orders/add/form/', array('uses' => 'OrderFormsController@get_add_form'));//Route-64




	

	//============================================= Favourite Items Starts =================================================

    Route::post('/v1/favourite-item/', array('uses' => 'FavouriteItemController@store'));//Route-66
	  Route::get('/v1/favourite-item/', array('uses' => 'FavouriteItemController@get_list'));//Route-67
	  Route::delete('/v1/favourite-item/{id}', array('uses' => 'FavouriteItemController@destroy'));//Route-68

 	//============================================= Favourite Items Ends =================================================




 		//============================================= Favourite Stores Starts =================================================

    Route::post('/v1/favourite-store/', array('uses' => 'FavouriteStoreController@store'));//Route-69
	Route::get('/v1/favourite-store/', array('uses' => 'FavouriteStoreController@get_list'));//Route-70
	Route::delete('/v1/favourite-store/{id}', array('uses' => 'FavouriteStoreController@destroy'));//Route-71

 	//============================================= Favourite Stores Ends =================================================





   	//============================================= Order Review =====================================================
    Route::post('/v1/order-review/', array('uses' => 'OrderReviewController@store'));//Route-72
  	Route::get('/v1/order-review/', array('uses' => 'OrderReviewController@get_list'));//Route-73
    Route::delete('/v1/order-review/{id}', array('uses' => 'OrderReviewController@destroy'));// 
  	//============================================= Order Review Ends =================================================

     //============================================= Order Review =====================================================
    Route::post('/v1/order-cancel-reasons/', array('uses' => 'OrderCancelReasonsController@store')); 
    Route::get('/v1/order-cancel-reasons/', array('uses' => 'OrderCancelReasonsController@get_list')); 
    Route::delete('/v1/order-cancel-reasons/{id}', array('uses' => 'OrderCancelReasonsController@destroy'));// 
    Route::put('/v1/order-cancel-reasons/{id}', array('uses' => 'OrderCancelReasonsController@update'));// 
    //============================================= Order Review Ends =================================================




	  //================================================ Task Starts ==================================================================================//
    Route::post('/v1/task/', array('uses' => 'TaskController@store'));//Route-
	  Route::get('/v1/task/', array('uses' => 'TaskController@get_list'));//Route-
    Route::put('/v1/task/{id}/', array('uses' => 'TaskController@update'));//Route-
    Route::delete('/v1/task/{id}/', array('uses' => 'TaskController@destroy'));//Route-   //====================pending
    Route::put('/v1/task/assign-driver/{id}', array('uses' => 'TaskController@assign_driver'));//Route-
    Route::put('/v1/task/update-status/{id}', array('uses' => 'TaskController@update_status'));//Route-
    //================================================ Task Ends ====================================================================================//


   //================================================= Multi Search Api ==============================================================================//

    Route::get('/v1/multisearch', array('uses' => 'MultiSearchController@search'));//Route-
   //================================================ Multi Search Api Ends =========================================================================//





   //================================================= Notification Settings Api ==============================================================================//
    Route::get('/v1/notification-settings/{user_id}', array('uses' => 'NotificationSettingsController@get_list'));//Route-
    Route::put('/v1/notification-settings/{user_id}', array('uses' => 'NotificationSettingsController@update'));//Route-
   //================================================ Multi Search Api Ends ==================================================================================//



     //================================================= Users Locations Api ==============================================================================//
    Route::get('/v1/user-location/{user_id}', array('uses' => 'UserLocationController@get_location'));//Route-
    Route::put('/v1/user-location/{user_id}', array('uses' => 'UserLocationController@update'));//Route-

   //================================================ Users Locations Api Ends ==================================================================================//



 




     //================================================= Get Settings  Api ==============================================================================//
    Route::get('/v1/setting', array('uses' => 'SettingController@get_list'));//Route-
     Route::put('/v1/setting/{id}', array('uses' => 'SettingController@update'));//Route-
    //================================================ Get Settings Api Ends ============================================================================//


    //================================================= Send Notifications to ALL (from admin panel)===================================================================//
    Route::post('/v1/offer-push-notification/push-to-customers', array('uses' => 'SendOfferPushNotificationController@push_to_customers'));//Route-
    Route::post('/v1/offer-push-notification/email-to-customers', array('uses' => 'SendOfferPushNotificationController@email_to_customers'));//Route-
    Route::post('/v1/offer-push-notification/email-to-stores', array('uses' => 'SendOfferPushNotificationController@email_to_stores'));//Route-
    //================================================ Send Notifications to ALL Api Ends ============================================================================//





    //================================================= Reports Starts ===================================================================//
 
    Route::get('/v1/reports', array('uses' => 'ReportsController@get_list'));//Route-

    Route::get('/v1/reports/orders', array('uses' => 'ReportsController@reports_orders'));//Route-
    Route::get('/v1/reports/cancelled_orders', array('uses' => 'ReportsController@reports_cancelled_orders'));//Route-
    
    Route::get('/v1/reports/customers', array('uses' => 'ReportsController@reports_customers'));//Route-
    Route::get('/v1/reports/customers_most_sales', array('uses' => 'ReportsController@reports_customers_most_sales'));//Route-
    Route::get('/v1/reports/tasks', array('uses' => 'ReportsController@reports_tasks'));//Route-
    Route::get('/v1/reports/items', array('uses' => 'ReportsController@reports_items'));//Route-
 
    Route::get('/v1/reports', array('uses' => 'ReportsController@get_list'));//Route-23.1
    Route::get('/v1/reports/orders', array('uses' => 'ReportsController@reports_orders'));//Route-23.2
    Route::get('/v1/reports/cancelled_orders', array('uses' => 'ReportsController@reports_cancelled_orders'));//Route-23.3
    Route::get('/v1/reports/customers', array('uses' => 'ReportsController@reports_customers'));//Route-23.4
 
    Route::get('/v1/reports/tasks', array('uses' => 'ReportsController@reports_tasks'));//Route-23.5
    Route::get('/v1/reports/items', array('uses' => 'ReportsController@reports_items'));//Route-23.6

    Route::get('/v1/reports/coupons', array('uses' => 'ReportsController@reports_coupons'));//Route-23.7
    Route::get('/v1/reports/reviews', array('uses' => 'ReportsController@reports_reviews'));//Route-23.8
    Route::get('/v1/reports/loyalty_points', array('uses' => 'ReportsController@reports_loyalty_points'));//Route-23.9
     
 
    //================================================ Reports Ends ============================================================================//





     //================================================ OTP controller starts ==================================================================================//
    Route::post('/v1/otp-store', array('uses' => 'OtpController@store'));//Route-24.1
    Route::post('/v1/otp-verify', array('uses' => 'OtpController@verify_otp'));//Route-24.2
   //================================================ store-filter-options Ends ====================================================================================//



 //================================================= Mobile App Users Routes ===================================================================//

    Route::post('/v1/users/register', array('uses' => 'UsersApiController@register'));//Route-
    Route::post('/v1/users/login', array('uses' => 'UsersApiController@login'));//Route-

    Route::post('/v1/users/logout', array('uses' => 'UsersApiController@logout'));//Route-

    Route::post('/v1/users/forgot-password-email', array('as' => 'forgot_password', 'uses' => 'UsersApiController@forgotPasswordEmail'));
    Route::post('/v1/users/forgot-password-verify-otp', array('as' => 'verify_otp', 'uses' => 'UsersApiController@verify_otp'));
    Route::post('/v1/users/forgot-password-change-password', array('as' => 'forgot_password_change', 'uses' => 'UsersApiController@forgotPasswordChange'));
    Route::post('/v1/users/change-password', array('as' => 'forgot_password_change', 'uses' => 'UsersApiController@newPassword'));
 
 //================================================= Mobile App Users Routes Ends ===================================================================//

 

  //================================================= Upload Images Api Starts ===================================================================//
   Route::post('/v1/users/upload-profile-image', array(  'uses' => 'UploadImagesController@upload_image'));
  //================================================= Upload Images Api Ends ===================================================================//
 	



   //================================================= Users Locations Api ==============================================================================//
    Route::get('/v1/tax', array('uses' => 'TaxController@get_list'));//Route-
    Route::put('/v1/tax/{id}', array('uses' => 'TaxController@update'));//Route-
   //================================================ Users Locations Api Ends =============================================================================//





   //================================================= Fresh desk Starts ==============================================================================//
    Route::post('/v1/freshdesk/ticket', array('uses' => 'FreshDeskController@store'));//Route-
    Route::get('/v1/freshdesk', array('uses' => 'FreshDeskController@get_list'));//Route-
   //================================================ Fresh Desk Ends ==================================================================================//

   //================================================= Loyalty Points starts ==============================================================================//
    Route::post('/v1/loyalty-points', array('uses' => 'LoyaltyPointsController@store'));//Route-
    Route::get('/v1/loyalty-points', array('uses' => 'LoyaltyPointsController@get_list'));//Route-
   //================================================ Loyalty Points  Ends ==================================================================================//

  //================================================ Banners Starts ==================================================================================//
    Route::post('/v1/banners/', array('uses' => 'BannersController@store'));//Route-
    Route::get('/v1/banners/', array('uses' => 'BannersController@get_list'));//Route-
    Route::put('/v1/banners/{id}/', array('uses' => 'BannersController@update'));//Route-
    Route::delete('/v1/banners/{id}/', array('uses' => 'BannersController@destroy'));//Route-
    //================================================ Banners Ends ====================================================================================//




    //================================================ Newsletters Starts ==================================================================================//
    Route::post('/v1/newsletters/', array('uses' => 'NewslettersController@store'));//Route-
    Route::get('/v1/newsletters/', array('uses' => 'NewslettersController@get_list'));//Route-
    Route::delete('/v1/newsletters/{id}/', array('uses' => 'NewslettersController@destroy'));//Route-
    Route::post('/v1/newsletters/send-emails/', array('uses' => 'NewslettersController@send_newsletters'));//Route-
    //================================================ Newsletters Ends ====================================================================================//



     //================================================ store-filter-options Starts ==================================================================================//
    Route::post('/v1/store-filter-options/', array('uses' => 'FilterOptionsController@store'));//Route-
    Route::get('/v1/store-filter-options/', array('uses' => 'FilterOptionsController@get_list'));//Route-
    Route::delete('/v1/store-filter-options/{id}/', array('uses' => 'FilterOptionsController@destroy'));//Route-
    Route::put('/v1/store-filter-options/{id}/', array('uses' => 'FilterOptionsController@update'));//Route-
    Route::get('/v1/get-filters', array('uses' => 'FilterOptionsController@get_filters'));//Route-
     //================================================ store-filter-options Ends ====================================================================================//






     //================================================ store-filter-options Starts ==================================================================================//
    Route::put('/v1/make-store-busy/{store_id}', array('uses' => 'StoreBusyLogController@make_store_busy'));//Route-
    Route::put('/v1/make-store-unbusy/{store_id}', array('uses' => 'StoreBusyLogController@make_store_unbusy'));//Route-
    Route::get('/v1/store-busy-log', array('uses' => 'StoreBusyLogController@get_list'));//Route-
 
     //================================================ store-filter-options Ends ====================================================================================//





  

 

});







































Route::post('/authWithFacebook', array('as' => 'authWithFacebook', 'uses' => 'SocialUserResolver@authWithFacebook'));
Route::group(array('namespace'=>'Api'    ), function()
{
	
	 
    Route::post('/signup', array('as' => 'signup', 'uses' => 'UsersController@register'));
    Route::post('/login', array('as' => 'login', 'uses' => 'UsersController@login'));
	Route::post('/facebook_signup_login', array('as' => 'facebook_signup_login', 'uses' => 'UsersController@register'));
	Route::post('/login_fb', array('as' => 'login_fb', 'uses' => 'UsersController@login_fb'));
	Route::post('/login_google', array('as' => 'login_google', 'uses' => 'UsersController@login_google'));
	Route::post('/forgot_password', array('as' => 'forgot_password', 'uses' => 'UsersController@forgotPasswordEmail'));
	Route::post('/verify_otp', array('as' => 'verify_otp', 'uses' => 'UsersController@verify_otp'));
	Route::post('/forgot_password_change', array('as' => 'forgot_password_change', 'uses' => 'UsersController@forgotPasswordChange'));
	
    Route::post('/upload_verify_images', array('as' => 'upload_verify_images', 'uses' => 'UsersController@upload_verify_images'));
    Route::post('/upload_profile_image', array('as' => 'upload_profile_image', 'uses' => 'UsersController@upload_profile_image'));
	Route::post('/upload_user_card', array('as' => 'upload_user_card', 'uses' => 'AppDataController@upload_user_card'));
	 
	Route::post('/add_post', array('as' => 'add_post', 'uses' => 'PostsController@add_post'));
	Route::post('/check_facebook_id_existence', array('as' => 'check_facebook_id_existence', 'uses' => 'UsersController@check_facebook_id_existence'));

Route::post('/coinbase_notification', array('as' => 'coinbase_notification', 'uses' => 'CountryController@coinbase_notification'));
	
	
});





// route to show the login form for api section
 Route::group(array('namespace'=>'Api' , 'middleware'=>'auth:api'), function()
//Route::group(array('namespace'=>'Api' ), function()
{
 
    Route::post('/traits', array('as' => 'traits', 'uses' => 'UsersController@traits'));
    Route::get('/get_countries', array('as' => 'get_country', 'uses' => 'CountryController@get_countries'));
	Route::get('/get_currency_codes', array('as' => 'get_currency_codes', 'uses' => 'CountryController@get_currency_codes')); // NEW API
	Route::post('/currency_bitcoin_price', array('as' => 'currency_bitcoin_price', 'uses' => 'BitcoinController@currency_bitcoin_price')); // NEW API
	Route::post('/currency_amount_bitcoin_price', array('as' => 'currency_amount_bitcoin_price', 'uses' => 'BitcoinController@currency_amount_bitcoin_price')); // NEW API
	Route::post('/update_order_status', array('as' => 'update_order_status', 'uses' => 'PostsController@update_order_status')); // NEW API
	
	Route::post('/update_trade_order_status', array('as' => 'update_trade_order_status', 'uses' => 'WalletController@update_trade_order_status')); // NEW API
	
	
	Route::post('/search_posts', array('as' => 'search_posts', 'uses' => 'PostsController@search_posts')); // NEW API
	Route::post('/add_orders_feedback', array('as' => 'add_orders_feedback', 'uses' => 'PostsController@add_orders_feedback')); // NEW API
	Route::post('/add_trades_feedback', array('as' => 'add_trades_feedback', 'uses' => 'WalletController@add_trades_feedback')); // NEW API
	
	
	
    Route::post('/get_init_data', array('as' => 'get_init_data', 'uses' => 'AppDataController@get_init_data'));
    Route::get('/notification', array('as' => 'notification', 'uses' => 'CustomController@sendNotificationToDevice'));
 
 
 
	//services on 21 april
    Route::post('/check_pgp_key_exist', array('as' => 'check_pgp_key_exist', 'uses' => 'UsersController@check_pgp_key_exist'));	
	Route::post('/get_2fa_otp_message', array('as' => 'get_2fa_otp_message', 'uses' => 'UsersController@get_2fa_otp_message'));
	Route::post('/update_two_fa_status', array('as' => 'update_two_fa_status', 'uses' => 'UsersController@update_two_fa_status'));
	Route::post('/gpg_encryption_decryption', array('as' => 'gpg_encryption_decryption', 'uses' => 'BitcoinController@gpg_encryption_decryption'));
	Route::post('/two_fa_login', array('as' => 'two_fa_login', 'uses' => 'UsersController@two_fa_login'));
	
	
   
    //Users  basic api's
 
    Route::post('/update_pgp_key', array('as' => 'update_pgp_key', 'uses' => 'UsersController@update_pgp_key'));
 
	Route::post('/update_wallet_address', array('as' => 'update_wallet_address', 'uses' => 'UsersController@update_wallet_address'));
	Route::post('/update_wallet_pin', array('as' => 'update_wallet_pin', 'uses' => 'UsersController@update_wallet_pin'));
	
	
	//Posts  basic api's

	Route::post('/edit_post', array('as' => 'edit_post', 'uses' => 'PostsController@edit_post'));
	Route::post('/delete_post', array('as' => 'add_post', 'uses' => 'PostsController@delete_post'));
	Route::post('/get_posts', array('as' => 'get_posts', 'uses' => 'PostsController@get_posts'));
	
	
	Route::post('/write_post_comment', array('as' => 'write_post_comment', 'uses' => 'PostsController@write_post_comment'));
	Route::post('/get_post_comment', array('as' => 'get_post_comment', 'uses' => 'PostsController@get_post_comment'));
	
	Route::post('/write_users_reviews', array('as' => 'write_users_reviews', 'uses' => 'PostsController@write_users_reviews'));
	Route::post('/get_users_reviews', array('as' => 'get_users_reviews', 'uses' => 'PostsController@get_users_reviews'));
	
	//manage listings Api's starts
	
	Route::post('/my_listings', array('as' => 'my_listings', 'uses' => 'PostsController@my_listings'));
Route::post('/delete_posts', array('as' => 'delete_posts', 'uses' => 'PostsController@delete_posts'));




	Route::post('/my_buyings', array('as' => 'my_buyings', 'uses' => 'PostsController@my_buyings'));
	Route::post('/my_sellings', array('as' => 'my_sellings', 'uses' => 'PostsController@my_sellings'));
	
	Route::post('/order_details', array('as' => 'order_details', 'uses' => 'PostsController@order_details'));
		
	Route::post('/like_post', array('as' => 'like_post', 'uses' => 'PostsController@like_post'));
	Route::post('/unlike_post', array('as' => 'unlike_post', 'uses' => 'PostsController@unlike_post'));
	Route::post('/get_post_detail', array('as' => 'get_post_detail', 'uses' => 'PostsController@get_post_detail'));
	Route::post('/buy_post', array('as' => 'buy_post', 'uses' => 'PostsController@buy_post'));
	 
	
	
	
	//trades & bitcoins apis
	Route::post('/withdraw_bitcoins', array('as' => 'withdraw_bitcoins', 'uses' => 'WalletController@withdraw_bitcoins'));
	Route::post('/onetime_payment', array('as' => 'onetime_payment', 'uses' => 'WalletController@onetime_payment'));
	Route::post('/add_trade', array('as' => 'add_trade', 'uses' => 'WalletController@add_trade'));
	Route::post('/edit_trade', array('as' => 'edit_trade', 'uses' => 'WalletController@edit_trade'));
	Route::post('/delete_trade', array('as' => 'delete_trade', 'uses' => 'WalletController@delete_trade'));
	Route::post('/trade_details', array('as' => 'trade_details', 'uses' => 'WalletController@trade_details'));
	Route::post('/trade_post_details', array('as' => 'trade_post_details', 'uses' => 'WalletController@trade_post_details'));
		
		
	Route::post('/buy_bitcoins', array('as' => 'buy_bitcoins', 'uses' => 'WalletController@buy_bitcoins'));
	Route::post('/sell_bitcoins', array('as' => 'sell_bitcoins', 'uses' => 'WalletController@sell_bitcoins'));
	
	
	
	Route::post('/get_sell_trades_posts', array('as' => 'get_sell_trades_posts', 'uses' => 'WalletController@get_sell_trades_posts'));
	Route::post('/get_buy_trades_posts', array('as' => 'get_buy_trades_posts', 'uses' => 'WalletController@get_buy_trades_posts'));
	
	Route::post('/get_sell_my_trades_posts', array('as' => 'get_sell_my_trades_posts', 'uses' => 'WalletController@get_sell_my_trades_posts'));
	Route::post('/get_buy_my_trades_posts', array('as' => 'get_buy_my_trades_posts', 'uses' => 'WalletController@get_buy_my_trades_posts'));
	Route::post('/get_user_bitcoin_balance', array('as' => 'get_user_bitcoin_balance', 'uses' => 'WalletController@get_user_bitcoin_balance'));
	Route::post('/my_transaction_history', array('as' => 'my_transaction_history', 'uses' => 'WalletController@my_transaction_history'));
	Route::post('/delete_transaction_history', array('as' => 'delete_transaction_history', 'uses' => 'WalletController@delete_transaction_history'));
	
	Route::post('/send_messages', array('as' => 'send_messages', 'uses' => 'WalletController@send_messages'));
	Route::post('/get_messages', array('as' => 'get_messages', 'uses' => 'WalletController@get_messages'));
	Route::post('/get_chats_lists', array('as' => 'get_chats_lists', 'uses' => 'WalletController@get_chats_lists'));
	
	
	
	Route::post('/trade_list', array('as' => 'trade_list', 'uses' => 'WalletController@trade_list'));
	
 
 
	 
	
 

	
	
	
		Route::post('/get_offers', array('as' => 'get_offers', 'uses' => 'PostsController@get_offers'));
		Route::post('/get_offers_details', array('as' => 'get_offers', 'uses' => 'PostsController@get_offers_details'));
		Route::post('/get_notifications', array('as' => 'get_notifications', 'uses' => 'UsersController@get_notification'));
		Route::post('/get_facebook_friends', array('as' => 'get_facebook_friends', 'uses' => 'UsersController@get_facebook_friends'));

		
		
		Route::post('/like_offer', array('as' => 'like_offer', 'uses' => 'PostsController@like_offer'));
		Route::post('/unlike_offer', array('as' => 'unlike_offer', 'uses' => 'PostsController@unlike_offer'));
		Route::post('/get_active_loyaty', array('as' => 'get_active_loyaty', 'uses' => 'PostsController@get_active_loyaty'));
		
		
		Route::post('/follow_user', array('as' => 'follow_user', 'uses' => 'UsersController@follow_user'));
		Route::post('/unfollow_user', array('as' => 'unfollow_user', 'uses' => 'UsersController@unfollow_user'));
		
		
		Route::post('/follow_store', array('as' => 'follow_store', 'uses' => 'UsersController@follow_store'));
		Route::post('/unfollow_store', array('as' => 'unfollow_store', 'uses' => 'UsersController@unfollow_store'));
		
		
		
		Route::post('/get_notification', array('as' => 'get_notification', 'uses' => 'UsersController@get_notification'));
		
		Route::post('/get_membership_list', array('as' => 'get_membership_list', 'uses' => 'UsersController@get_membership_list'));
		Route::post('/update_membership_list', array('as' => 'update_membership_list', 'uses' => 'UsersController@update_membership_list'));
		Route::post('/delete_membership_list', array('as' => 'delete_membership_list', 'uses' => 'UsersController@delete_membership_list'));
		
		Route::post('/search_store', array('as' => 'search_store', 'uses' => 'UsersController@search_store'));
		
 
		

	Route::post('/change_password', array('as' => 'change_password', 'uses' => 'UsersController@newPassword'));
	
	
    Route::post('/get_user_profile', array('as' => 'get_user_profile', 'uses' => 'UsersController@get_user_profile'));
	Route::post('/get_other_user_profile', array('as' => 'get_other_user_profile', 'uses' => 'UsersController@get_other_user_profile'));
	Route::post('/get_other_user_sales_posts', array('as' => 'get_other_user_sales_posts', 'uses' => 'UsersController@get_other_user_sales_posts'));
	
	
	
	Route::post('/update_profile', array('as' => 'update_profile', 'uses' => 'UsersController@update_profile'));
	Route::post('/get_social_links', array('as' => 'get_social_links', 'uses' => 'UserSocialLinksController@get_social_links'));
	Route::post('/update_social_links', array('as' => 'update_social_links', 'uses' => 'UserSocialLinksController@update_social_links'));
	Route::post('/get_push_notification_status', array('as' => 'get_push_notification_status', 'uses' => 'UsersController@get_push_notification_status'));
	Route::post('/update_push_notification_status', array('as' => 'update_push_notification_status', 'uses' => 'UsersController@update_push_notification_status'));
 
	Route::post('/search_users', array('as' => 'search_users', 'uses' => 'UsersController@search_users'));
	
	
 
	 
	
	 Route::post('/store_user_cards', array('as' => 'store_user_cards', 'uses' => 'UsersController@store_user_cards'));
	 
	 
	 Route::post('/get_followers', array('as' => 'get_followers', 'uses' => 'UsersController@get_followers'));
	 Route::post('/get_followings', array('as' => 'get_followings', 'uses' => 'UsersController@get_followings'));
	 Route::post('/get_follow_requests', array('as' => 'get_follow_requests', 'uses' => 'UsersController@get_follow_requests'));
	 Route::post('/accept_reject_follow_request', array('as' => 'accept_reject_follow_request', 'uses' => 'UsersController@accept_reject_follow_request'));
	 
	 Route::post('/report_user', array('as' => 'report_user', 'uses' => 'UsersController@report_user'));
	 Route::post('/report_post', array('as' => 'report_post', 'uses' => 'UsersController@report_post'));
 
     Route::post('/logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));
	 Route::post('/like_dislike', array('as' => 'like_dislike', 'uses' => 'UsersController@like_dislike'));
	 Route::post('/undo_like_dislike', array('as' => 'undo_like_dislike', 'uses' => 'UsersController@undo_like_dislike'));
	 Route::post('/rate_user', array('as' => 'rate_user', 'uses' => 'UsersController@rate_user'));
	 Route::post('/search', array('as' => 'search', 'uses' => 'UsersController@search'));
 
 
 
 
 
    //terms_conditions
    Route::post('/get_terms_conditions', array('as' => 'get_terms_conditions', 'uses' => 'TermsConditionsController@get_terms_conditions'));
	
	//App Data
	Route::post('/get_app_data', array('as' => 'get_app_data', 'uses' => 'AppDataController@get_app_data'));

  //terms_conditions
    Route::post('/cron_check_auction_expiry', array('as' => 'cron_check_auction_expiry', 'uses' => 'AuctionController@cron_check_auction_expiry'));


//facebook login
Route::post('/facebook_login', array('as' => 'facebook_login', 'uses' => 'UsersController@facebook_login'));

  //routes regarding scheduled jobs
    Route::post('/add_job', array('as' => 'add_job', 'uses' => 'ScheduledJobsController@add_job'));
    Route::post('/delete_job', array('as' => 'delete_job', 'uses' => 'ScheduledJobsController@delete_job'));
    Route::post('/edit_job', array('as' => 'edit_job', 'uses' => 'ScheduledJobsController@edit_job'));

Route::post('/check_auction_expiry', array('as' => 'check_auction_expiry', 'uses' => 'ScheduledJobsController@check_auction_expiry'));
  

 




Route::post('update_private_status', array('as' => 'update_private_status', 'uses' => 'UsersController@update_private_status'));
Route::post('get_private_status', array('as' => 'get_private_status', 'uses' => 'UsersController@get_private_status'));
Route::post('get_2fa_status', array('as' => 'get_2fa_status', 'uses' => 'UsersController@get_2fa_status'));
Route::post('get_pgp_key', array('as' => 'get_pgp_key', 'uses' => 'UsersController@get_pgp_key'));


Route::post('update_preferred_currency', array('as' => 'update_preferred_currency', 'uses' => 'UsersController@update_preferred_currency'));
Route::post('get_preferred_currency', array('as' => 'get_preferred_currency', 'uses' => 'UsersController@get_preferred_currency'));

Route::post('send_pgp_message', array('as' => 'send_pgp_message', 'uses' => 'UsersController@send_pgp_message'));
Route::post('get_pgp_message', array('as' => 'get_pgp_message', 'uses' => 'UsersController@get_pgp_message'));
Route::post('delete_pgp_message', array('as' => 'delete_pgp_message', 'uses' => 'UsersController@delete_pgp_message'));
 
 
 
 
});