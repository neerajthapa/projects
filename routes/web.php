<?php

use App\Http\Requests;
use Illuminate\Http\Request;

/*

|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/index', function () {
    return view('index');
});
Route::get('/cache', function () {
    return Cache::get('key');
});


Route::get('/admin_login', function () {
    return view('admin.login.index')->name('admin-login');
});



Route::get('email-test', function(){
   $details['email'] = 'harvindersingh@goteso.com';
   $details['email_body'] = 'tested body from route';
   $d = dispatch(new App\Jobs\SendEmailTest($details));
  dd($d);
});

/**
// socialite starts
Route::get('facebook', function () {
    return view('facebook');
});
Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');
**/

 
Route::get('logouts', '\App\Http\Controllers\Admin\LoginController@logout');

 
 
Route::get('/admin/dashboard-grocery', array('uses' => 'AppSwitchController@index_grocery')); 
Route::get('/admin/dashboard-laundry', array('uses' => 'AppSwitchController@index_laundry')); 
Route::get('/admin/dashboard-mechanic', array('uses' => 'AppSwitchController@index_mechanic'));
Route::get('/admin/dashboard-courier', array('uses' => 'AppSwitchController@index_courier')); 

 

 
Route::get('/v1/dashboard_data-grocery', function () { return view('admin-grocery.dashboard.index'); })->middleware('checkauth'); 

Route::get('/v1/dashboard_data-laundry', function (\Request $request) { return view('admin-laundry.dashboard.index'); 

})->middleware('checkauth'); 



Route::get('/v1/dashboard_data-mechanic', function () { return view('admin-mechanic.dashboard.index'); })->middleware('checkauth'); 
Route::get('/v1/dashboard_data-courier', function () { return view('admin-courier.dashboard.index'); })->middleware('checkauth'); 


Route::get('/v1/store-requests-laundry', function () {
    return view('admin-laundry.requests.store-request');
})->middleware('checkauth');

Route::get('/v1/store-requests-grocery', function () {
    return view('admin-grocery.requests.store-request');
})->middleware('checkauth');

Route::get('/v1/store-requests-mechanic', function () {
    return view('admin-mechanic.requests.store-request');
})->middleware('checkauth');

Route::get('/v1/store-requests-courier', function () {
    return view('admin-courier.requests.store-request');
})->middleware('checkauth');







Route::get('/settings-grocery', function () {
    return view('admin-grocery.settings.index');
})->middleware('checkauth');

Route::get('/settings-laundry', function () {
    return view('admin-laundry.settings.index');
})->middleware('checkauth');

Route::get('/settings-mechanic', function () {
    return view('admin-mechanic.settings.index');
})->middleware('checkauth');

Route::get('/settings-courier', function () {
    return view('admin-courier.settings.index');
})->middleware('checkauth');


 
 
Route::get('/v1/account-laundry', function () { return view('admin-laundry.settings.account'); }); 
Route::get('/v1/account-grocery', function () { return view('admin-grocery.settings.account'); }); 
Route::get('/v1/account-mechanic', function () { return view('admin-mechanic.settings.account'); }); 
Route::get('/v1/account-courier', function () { return view('admin-courier.settings.account'); }); 
 


Route::get('/v1/faqs-laundry', function () { return view('admin-laundry.settings.faqs'); }); 
Route::get('/v1/faqs-grocery', function () { return view('admin-grocery.settings.faqs'); }); 
Route::get('/v1/faqs-mechanic', function () { return view('admin-mechanic.settings.faqs'); }); 
Route::get('/v1/faqs-courier', function () { return view('admin-courier.settings.faqs'); }); 
 


   Route::get('/v1/business-logo-laundry', function () { return view('admin-laundry.settings.logo'); });
   Route::get('/v1/business-logo-grocery', function () { return view('admin-grocery.settings.logo'); });
   Route::get('/v1/business-logo-mechanic', function () { return view('admin-mechanic.settings.logo'); });
   Route::get('/v1/business-logo-courier', function () { return view('admin-courier.settings.logo'); });
   


   Route::get('/v1/web-banners-laundry', function () { return view('admin-laundry.settings.banner_website'); });  
   Route::get('/v1/web-banners-grocery', function () { return view('admin-grocery.settings.banner_website'); });  
   Route::get('/v1/web-banners-mechanic', function () { return view('admin-mechanic.settings.banner_website'); });  
   Route::get('/v1/web-banners-courier', function () { return view('admin-courier.settings.banner_website'); });  




  Route::get('/v1/store-banners-laundry', function () { return view('admin-laundry.settings.banner_stores'); }); 
  Route::get('/v1/store-banners-grocery', function () { return view('admin-grocery.settings.banner_stores'); }); 
  Route::get('/v1/store-banners-mechanic', function () { return view('admin-mechanic.settings.banner_stores'); }); 
  Route::get('/v1/store-banners-courier', function () { return view('admin-courier.settings.banner_stores'); }); 


  Route::get('/v1/cuisine-filters-laundry', function () { return view('admin-laundry.settings.cuisines_filters'); });
  Route::get('/v1/cuisine-filters-grocery', function () { return view('admin-grocery.settings.cuisines_filters'); });
  Route::get('/v1/cuisine-filters-mechanic', function () { return view('admin-mechanic.settings.cuisines_filters'); });
  Route::get('/v1/cuisine-filters-courier', function () { return view('admin-courier.settings.cuisines_filters'); });

  
Route::get('/v1/update_store-laundry', function () { return view('admin-laundry.settings.update_store'); }); 
Route::get('/v1/update_store-grocery', function () { return view('admin-grocery.settings.update_store'); }); 
Route::get('/v1/update_store-mechanic', function () { return view('admin-mechanic.settings.update_store'); }); 
Route::get('/v1/update_store-courier', function () { return view('admin-courier.settings.update_store'); }); 


Route::get('/v1/terms-laundry', function () { return view('admin-laundry.settings.terms-and-conditions'); }); 
Route::get('/v1/terms-grocery', function () { return view('admin-grocery.settings.terms-and-conditions'); }); 
Route::get('/v1/terms-mechanic', function () { return view('admin-mechanic.settings.terms-and-conditions'); }); 
Route::get('/v1/terms-courier', function () { return view('admin-courier.settings.terms-and-conditions'); }); 

Route::get('/v1/privacy-policy-laundry', function () { return view('admin-laundry.settings.privacy-policy'); }); 
Route::get('/v1/privacy-policy-grocery', function () { return view('admin-grocery.settings.privacy-policy'); }); 
Route::get('/v1/privacy-policy-mechanic', function () { return view('admin-mechanic.settings.privacy-policy'); }); 
Route::get('/v1/privacy-policy-courier', function () { return view('admin-courier.settings.privacy-policy'); }); 

 
Route::get('/v1/timeslots-laundry', function () { return view('admin-laundry.settings.timeslots'); })->middleware('checkauth');
Route::get('/v1/timeslots-grocery', function () { return view('admin-grocery.settings.timeslots'); })->middleware('checkauth');
Route::get('/v1/timeslots-mechanic', function () { return view('admin-mechanic.settings.timeslots'); })->middleware('checkauth');
Route::get('/v1/timeslots-courier', function () { return view('admin-courier.settings.timeslots'); })->middleware('checkauth');

Route::get('/v1/tax-laundry', function () { return view('admin-laundry.settings.tax'); })->middleware('checkauth');
Route::get('/v1/tax-grocery', function () { return view('admin-grocery.settings.tax'); })->middleware('checkauth');
Route::get('/v1/tax-mechanic', function () { return view('admin-mechanic.settings.tax'); })->middleware('checkauth');
Route::get('/v1/tax-courier', function () { return view('admin-courier.settings.tax'); })->middleware('checkauth');


Route::get('/v1/stores-laundry/sort', function () { return view('admin-laundry.settings.sortStores'); })->middleware('checkauth');
Route::get('/v1/stores-grocery/sort', function () { return view('admin-grocery.settings.sortStores'); })->middleware('checkauth');
Route::get('/v1/stores-mechanic/sort', function () { return view('admin-mechanic.settings.sortStores'); })->middleware('checkauth');
Route::get('/v1/stores-courier/sort', function () { return view('admin-courier.settings.sortStores'); })->middleware('checkauth');


Route::get('/v1/locations-laundry', function () { return view('admin-laundry.settings.locations'); })->middleware('checkauth'); 
Route::get('/v1/locations-grocery', function () { return view('admin-grocery.settings.locations'); })->middleware('checkauth'); 
Route::get('/v1/locations-mechanic', function () { return view('admin-mechanic.settings.locations'); })->middleware('checkauth'); 
Route::get('/v1/locations-courier', function () { return view('admin-courier.settings.locations'); })->middleware('checkauth'); 

Route::get('/v1/areas-laundry', function () { return view('admin-laundry.settings.areas'); })->middleware('checkauth');
Route::get('/v1/areas-grocery', function () { return view('admin-grocery.settings.areas'); })->middleware('checkauth');
Route::get('/v1/areas-mechanic', function () { return view('admin-mechanic.settings.areas'); })->middleware('checkauth');
Route::get('/v1/areas-courier', function () { return view('admin-courier.settings.areas'); })->middleware('checkauth');


Route::get('/v1/plugins-laundry', function () { return view('admin-laundry.settings.plugins'); })->middleware('checkauth');
Route::get('/v1/plugins-grocery', function () { return view('admin-grocery.settings.plugins'); })->middleware('checkauth');
Route::get('/v1/plugins-mechanic', function () { return view('admin-mechanic.settings.plugins'); })->middleware('checkauth');
Route::get('/v1/plugins-courier', function () { return view('admin-courier.settings.plugins'); })->middleware('checkauth');

 
Route::get('/v1/categories-laundry', function () {  return view('admin-laundry.settings.categories'); })->middleware('checkauth'); 
Route::get('/v1/categories-grocery', function () {  return view('admin-grocery.settings.categories'); })->middleware('checkauth'); 
Route::get('/v1/categories-mechanic', function () {  return view('admin-mechanic.settings.categories'); })->middleware('checkauth'); 
Route::get('/v1/categories-courier', function () {  return view('admin-courier.settings.categories'); })->middleware('checkauth'); 



Route::get('/v1/order-cancel-reasons-laundry', function () {  return view('admin-laundry.settings.order-cancel-reasons'); })->middleware('checkauth'); 
Route::get('/v1/order-cancel-reasons-grocery', function () {  return view('admin-grocery.settings.order-cancel-reasons'); })->middleware('checkauth'); 
Route::get('/v1/order-cancel-reasons-mechanic', function () {  return view('admin-mechanic.settings.order-cancel-reasons'); })->middleware('checkauth'); 
Route::get('/v1/order-cancel-reasons-courier', function () {  return view('admin-courier.settings.order-cancel-reasons'); })->middleware('checkauth'); 


Route::get('/v1/payment-requests-laundry', function () {  return view('admin-laundry.payment-requests.index'); })->middleware('checkauth'); 
Route::get('/v1/payment-request-grocery', function () {  return view('admin-grocery.payment-requests.index'); })->middleware('checkauth'); 
Route::get('/v1/payment-requests-mechanic', function () {  return view('admin-mechanic.payment-requests.index'); })->middleware('checkauth'); 
Route::get('/v1/payment-requests-courier', function () {  return view('admin-courier.payment-requests.index'); })->middleware('checkauth'); 

Route::get('/v1/payment-requests-sent-laundry', function () {  return view('admin-laundry.payment-requests.index_sent'); }); 
Route::get('/v1/payment-requests-sent-grocery', function () {  return view('admin-grocery.payment-requests.index_sent'); }); 
Route::get('/v1/payment-requests-sent-mechanic', function () {  return view('admin-mechanic.payment-requests.index_sent'); }); 
Route::get('/v1/payment-requests-sent-courier', function () {  return view('admin-courier.payment-requests.index_sent'); }); 



Route::get('/v1/tags-laundry', function () {   return view('admin-laundry.settings.tags'); })->middleware('checkauth');
Route::get('/v1/tags-grocery', function () {   return view('admin-grocery.settings.tags'); })->middleware('checkauth');
Route::get('/v1/tags-mechanic', function () {   return view('admin-mechanic.settings.tags'); })->middleware('checkauth');
Route::get('/v1/tags-courier', function () {   return view('admin-courier.settings.tags'); })->middleware('checkauth');





 
 
 

   //image upload for GCommerce================
   Route::match(['get', 'post'], 'image-upload-items', 'ImageController@image_upload_items');
   Route::delete('ajax-remove-image-items/{filename}', 'ImageController@deleteImageItems');

      //image upload for GCommerce================
   Route::match(['get', 'post'], 'image-upload-users', 'ImageController@image_upload_users');
   Route::delete('ajax-remove-image-users/{filename}', 'ImageController@deleteImageUsers');


   //image upload for categories================
   Route::match(['get', 'post'], 'image-upload-categories', 'ImageController@image_upload_categories');
   Route::delete('ajax-remove-image-categories/{filename}', 'ImageController@deleteImageCategories');

    //image upload for tags================
   Route::match(['get', 'post'], 'image-upload-tags', 'ImageController@image_upload_tags');
   Route::delete('ajax-remove-image-tags/{filename}', 'ImageController@deleteImageTags');


  //image upload for stores================
   Route::match(['get', 'post'], 'image-upload-stores', 'ImageController@image_upload_stores');
   Route::delete('ajax-remove-image-stores/{filename}', 'ImageController@deleteImageStores');

 //image upload for coupons================
   Route::match(['get', 'post'], 'image-upload-coupons', 'ImageController@image_upload_coupons');
   Route::delete('ajax-remove-image-coupons/{filename}', 'ImageController@deleteImageCoupons');

 //image upload for logo================
   Route::match(['get', 'post'], 'image-upload-logo', 'ImageController@image_upload_logo');
   Route::delete('ajax-remove-image-logo/{filename}', 'ImageController@deleteImageLogo');

//image upload for banner================
   Route::match(['get', 'post'], 'image-upload-banner', 'ImageController@image_upload_banners');
   Route::delete('ajax-remove-image-banner/{filename}', 'ImageController@deleteImageBanners');


   
// route to show the login form for admin section
Route::group(array('namespace'=>'Admin'), function()
{



//================================== G_Commerce Routes Starts==============================================================
//=========================================================================================================================



 //================================================ item Forms starts Starts ===========================================================================//

  Route::get('/v1/form/item', array('uses' => 'ItemFormsController@get_add_form'));//Route-14
  Route::get('/v1/form/item/{id}', array('uses' => 'ItemFormsController@get_edit_form'));//Route-15

  Route::get('/v1/items-laundry', function () { return view('admin-laundry.items.items'); })->middleware('checkauth');
  Route::get('/v1/items-grocery', function () { return view('admin-grocery.items.items'); })->middleware('checkauth');
  Route::get('/v1/items-mechanic', function () { return view('admin-mechanic.items.items'); })->middleware('checkauth');
  Route::get('/v1/items-courier', function () { return view('admin-courier.items.items'); })->middleware('checkauth');

  Route::get('/v1/item-laundry', function () { return view('admin-laundry.items.item_add'); });
  Route::get('/v1/item-grocery', function () { return view('admin-grocery.items.item_add'); });
  Route::get('/v1/item-mechanic', function () { return view('admin-mechanic.items.item_add'); });
  Route::get('/v1/item-courier', function () { return view('admin-courier.items.item_add'); });


  Route::get('/v1/item-laundry/{id}', function () { return view('admin-laundry.items.item_edit'); });
  Route::get('/v1/item-grocery/{id}', function () { return view('admin-grocery.items.item_edit'); });
  Route::get('/v1/item-mechanic/{id}', function () { return view('admin-mechanic.items.item_edit'); });
  Route::get('/v1/item-courier/{id}', function () { return view('admin-courier.items.item_edit'); });
 
   //================================================ Item Forms Ends ===============================================================================//



   Route::get('/v1/dashboard', array('uses' => 'DashboardController@index'));//Route-65
   
   Route::get('/v1/dashboard-store', array('uses' => 'DashboardStoreController@index'));//Route-65
   
   Route::get('/v1/dashboard-vendor', array('uses' => 'DashboardVendorController@index'));//Route-65
   
   

 

 //================================================ Users Forms Starts ===========================================================================//
 
 
Route::get('/v1/logistics-laundry', function () { return view('admin-laundry.logistics.index'); })->middleware('checkauth');
Route::get('/v1/logistics-grocery', function () { return view('admin-grocery.logistics.index'); })->middleware('checkauth');
Route::get('/v1/logistics-mechanic', function () { return view('admin-mechanic.logistics.index'); })->middleware('checkauth');
Route::get('/v1/logistics-courier', function () { return view('admin-courier.logistics.index'); })->middleware('checkauth');


  Route::get('/v1/form/user', array('uses' => 'UserFormsController@get_add_form')); 
  Route::get('/v1/form/user/{id}', array('uses' => 'UserFormsController@get_edit_form')); 
 
 
 
Route::get('/v1/logistics-laundry', function () { return view('admin-laundry.logistics.index'); })->middleware('checkauth');
Route::get('/v1/logistics-grocery', function () { return view('admin-grocery.logistics.index'); })->middleware('checkauth');
Route::get('/v1/logistics-mechanic', function () { return view('admin-mechanic.logistics.index'); })->middleware('checkauth');
Route::get('/v1/logistics-courier', function () { return view('admin-courier.logistics.index'); })->middleware('checkauth');
 
  Route::get('/v1/form/user', array('uses' => 'UserFormsController@get_add_form')); 
  Route::get('/v1/form/user/{id}', array('uses' => 'UserFormsController@get_edit_form')); 

 
//================================================ Users Forms Ends ===========================================================================//



//==============================send notification routes starts ===============================
Route::get('/v1/emails-to-customers-laundry', function () { return view('admin-laundry.notifications.emails_to_customers'); })->middleware('checkauth');
Route::get('/v1/emails-to-customers-grocery', function () { return view('admin-grocery.notifications.emails_to_customers'); })->middleware('checkauth');
Route::get('/v1/emails-to-customers-mechanic', function () { return view('admin-mechanic.notifications.emails_to_customers'); })->middleware('checkauth');
Route::get('/v1/emails-to-customers-courier', function () { return view('admin-courier.notifications.emails_to_customers'); })->middleware('checkauth');

Route::get('/v1/push-to-customers-laundry', function () { return view('admin-laundry.notifications.push_to_customers'); })->middleware('checkauth');
Route::get('/v1/push-to-customers-grocery', function () { return view('admin-grocery.notifications.push_to_customers'); })->middleware('checkauth');
Route::get('/v1/push-to-customers-mechanic', function () { return view('admin-mechanic.notifications.push_to_customers'); })->middleware('checkauth');
Route::get('/v1/push-to-customers-courier', function () { return view('admin-courier.notifications.push_to_customers'); })->middleware('checkauth');


Route::get('/v1/emails-to-stores-laundry', function () { return view('admin-laundry.notifications.emails_to_stores'); })->middleware('checkauth');
Route::get('/v1/emails-to-stores-grocery', function () { return view('admin-grocery.notifications.emails_to_stores'); })->middleware('checkauth');
Route::get('/v1/emails-to-stores-mechanic', function () { return view('admin-mechanic.notifications.emails_to_stores'); })->middleware('checkauth');
Route::get('/v1/emails-to-stores-courier', function () { return view('admin-courier.notifications.emails_to_stores'); })->middleware('checkauth');

Route::get('/v1/emails-to-subscribers-laundry', function () { return view('admin-laundry.notifications.emails_to_subscribers'); })->middleware('checkauth');
Route::get('/v1/emails-to-subscribers-grocery', function () { return view('admin-grocery.notifications.emails_to_subscribers'); })->middleware('checkauth');
Route::get('/v1/emails-to-subscribers-mechanic', function () { return view('admin-mechanic.notifications.emails_to_subscribers'); })->middleware('checkauth');
Route::get('/v1/emails-to-subscribers-courier', function () { return view('admin-courier.notifications.emails_to_subscribers'); })->middleware('checkauth');
//================================ send notification routes ends ==============================


Route::get('/v1/email_main', function () { return view('emails.email_main'); });
Route::get('/v1/email_main', function () { return view('emails.email_main'); });
Route::get('/v1/email_main', function () { return view('emails.email_main'); });
Route::get('/v1/email_main', function () { return view('emails.email_main'); });




 
   Route::get('/v1/terms-laundry', function () { 
    $terms = @\App\Setting::where('key_title','terms_conditions')->first(['key_value'])->key_value;
    return view('admin-laundry.settings.terms-and-conditions')->with('result', $terms);   
 }); 
      Route::get('/v1/terms-grocery', function () { 
    $terms = @\App\Setting::where('key_title','terms_conditions')->first(['key_value'])->key_value;
    return view('admin-grocery.settings.terms-and-conditions')->with('result', $terms);   
 }); 
         Route::get('/v1/terms-mechanic', function () { 
    $terms = @\App\Setting::where('key_title','terms_conditions')->first(['key_value'])->key_value;
    return view('admin-mechanic.settings.terms-and-conditions')->with('result', $terms);   
 }); 
            Route::get('/v1/terms-courier', function () { 
    $terms = @\App\Setting::where('key_title','terms_conditions')->first(['key_value'])->key_value;
    return view('admin-courier.settings.terms-and-conditions')->with('result', $terms);   
 }); 





   Route::get('/v1/privacy-policy-laundry', function () {  
    $terms = @\App\Setting::where('key_title','privacy_policy')->first(['key_value'])->key_value;
    return view('admin-laundry.settings.privacy-policy')->with('result', $terms);   
 });

      Route::get('/v1/privacy-policy-grocery', function () {  
    $terms = @\App\Setting::where('key_title','privacy_policy')->first(['key_value'])->key_value;
    return view('admin-grocery.settings.privacy-policy')->with('result', $terms);   
 });
         Route::get('/v1/privacy-policy-mechanic', function () {  
    $terms = @\App\Setting::where('key_title','privacy_policy')->first(['key_value'])->key_value;
    return view('admin-mechanic.settings.privacy-policy')->with('result', $terms);   
 });
            Route::get('/v1/privacy-policy-courier', function () {  
    $terms = @\App\Setting::where('key_title','privacy_policy')->first(['key_value'])->key_value;
    return view('admin-courier.settings.privacy-policy')->with('result', $terms);   
 });
  




Route::get('/notifications-laundry', function () { return view('admin-laundry.notifications.index'); })->middleware('checkauth');
Route::get('/notifications-grocery', function () { return view('admin-grocery.notifications.index'); })->middleware('checkauth');
Route::get('/notifications-mechanic', function () { return view('admin-mechanic.notifications.index'); })->middleware('checkauth');
Route::get('/notifications-courier', function () { return view('admin-courier.notifications.index'); })->middleware('checkauth');



Route::get('/invoice-laundry/{id}', function () { return view('admin-laundry.orders.invoice'); })->middleware('checkauth'); 
Route::get('/invoice-grocery/{id}', function () { return view('admin-grocery.orders.invoice'); })->middleware('checkauth'); 
Route::get('/invoice-mechanic/{id}', function () { return view('admin-mechanic.orders.invoice'); })->middleware('checkauth'); 
Route::get('/invoice-courier/{id}', function () { return view('admin-courier.orders.invoice'); })->middleware('checkauth'); 




Route::get('/v1/reviews-laundry', function () { return view('admin-laundry.reviews.reviews'); })->middleware('checkauth');
Route::get('/v1/reviews-grocery', function () { return view('admin-grocery.reviews.reviews'); })->middleware('checkauth');
Route::get('/v1/reviews-mechanic', function () { return view('admin-mechanic.reviews.reviews'); })->middleware('checkauth');
Route::get('/v1/reviews-courier', function () { return view('admin-courier.reviews.reviews'); })->middleware('checkauth');

Route::get('/v1/freshdesk-laundry', function () {   return view('admin-laundry.freshdesk-enquiries.index'); })->middleware('checkauth');
Route::get('/v1/freshdesk-grocery', function () {   return view('admin-grocery.freshdesk-enquiries.index'); })->middleware('checkauth');
Route::get('/v1/freshdesk-mechanic', function () {   return view('admin-mechanic.freshdesk-enquiries.index'); })->middleware('checkauth');
Route::get('/v1/freshdesk-courier', function () {   return view('admin-courier.freshdesk-enquiries.index'); })->middleware('checkauth');

Route::get('/v1/newsletters-laundry', function () {   return view('admin-laundry.newsletters.index'); })->middleware('checkauth'); 
Route::get('/v1/newsletters-grocery', function () {   return view('admin-grocery.newsletters.index'); })->middleware('checkauth'); 
Route::get('/v1/newsletters-mechanic', function () {   return view('admin-mechanic.newsletters.index'); })->middleware('checkauth'); 
Route::get('/v1/newsletters-courier', function () {   return view('admin-courier.newsletters.index'); })->middleware('checkauth'); 



 Route::get('/v1/coupons-laundry', function () { return view('admin-laundry.coupons.coupons'); })->middleware('checkauth');
 Route::get('/v1/coupons-grocery', function () { return view('admin-grocery.coupons.coupons'); })->middleware('checkauth');
 Route::get('/v1/coupons-mechanic', function () { return view('admin-mechanic.coupons.coupons'); })->middleware('checkauth');
 Route::get('/v1/coupons-courier', function () { return view('admin-courier.coupons.coupons'); })->middleware('checkauth');

 Route::get('/v1/coupon-laundry', function () { return view('admin-laundry.coupons.coupon_add'); })->middleware('checkauth');
 Route::get('/v1/coupon-grocery', function () { return view('admin-grocery.coupons.coupon_add'); })->middleware('checkauth');
 Route::get('/v1/coupon-mechanic', function () { return view('admin-mechanic.coupons.coupon_add'); })->middleware('checkauth');
 Route::get('/v1/coupon-courier', function () { return view('admin-courier.coupons.coupon_add'); })->middleware('checkauth');


 Route::get('/v1/coupon-laundry/{id}', function () { return view('admin-laundry.coupons.coupon_edit'); })->middleware('checkauth'); 
 Route::get('/v1/coupon-grocery/{id}', function () { return view('admin-grocery.coupons.coupon_edit'); })->middleware('checkauth'); 
 Route::get('/v1/coupon-mechanic/{id}', function () { return view('admin-mechanic.coupons.coupon_edit'); })->middleware('checkauth'); 
 Route::get('/v1/coupon-courier/{id}', function () { return view('admin.coupons-courier.coupon_edit'); })->middleware('checkauth'); 
 
 

// Route::get('/v1/translation-manager', function () { return view('vendor.translation-manager.index'); });
 
 
 
 Route::get('/v1/stores-laundry', function () { return view('admin-laundry.stores.stores'); })->middleware('checkauth');
 Route::get('/v1/stores-grocery', function () { return view('admin-grocery.stores.stores'); })->middleware('checkauth');
 Route::get('/v1/stores-mechanic', function () { return view('admin-mechanic.stores.stores'); })->middleware('checkauth');
 Route::get('/v1/stores-courier', function () { return view('admin-courier.stores.stores'); })->middleware('checkauth');

 Route::get('/v1/store-laundry', function () { return view('admin-laundry.stores.store_add'); })->middleware('checkauth');
 Route::get('/v1/store-grocery', function () { return view('admin-grocery.stores.store_add'); })->middleware('checkauth');
 Route::get('/v1/store-mechanic', function () { return view('admin-mechanic.stores.store_add'); })->middleware('checkauth');
 Route::get('/v1/store-courier', function () { return view('admin-courier.stores.store_add'); })->middleware('checkauth');

 Route::get('/v1/store-laundry/{id}', function () { return view('admin-laundry.stores.store_edit'); })->middleware('checkauth');  
 Route::get('/v1/store-grocery/{id}', function () { return view('admin-grocery.stores.store_edit'); })->middleware('checkauth');  
 Route::get('/v1/store-mechanic/{id}', function () { return view('admin-mechanic.stores.store_edit'); })->middleware('checkauth');  
 Route::get('/v1/store-courier/{id}', function () { return view('admin-courier.stores.store_edit'); })->middleware('checkauth');  
 
 
 
 Route::get('/v1/customers-laundry', function () { return view('admin-laundry.users.customers'); })->middleware('checkauth');
 Route::get('/v1/customers-grocery', function () { return view('admin-grocery.users.customers'); })->middleware('checkauth');
 Route::get('/v1/customers-mechanic', function () { return view('admin-mechanic.users.customers'); })->middleware('checkauth');
 Route::get('/v1/customers-courier', function () { return view('admin-courier.users.customers'); })->middleware('checkauth');
 

 Route::get('/v1/customer-laundry/{id}', function () { return view('admin-laundry.users.customer_edit'); })->middleware('checkauth');  
 Route::get('/v1/customer-grocery/{id}', function () { return view('admin-grocery.users.customer_edit'); })->middleware('checkauth');  
 Route::get('/v1/customer-mechanic/{id}', function () { return view('admin-mechanic.users.customer_edit'); })->middleware('checkauth');  
 Route::get('/v1/customer-courier/{id}', function () { return view('admin-courier.users.customer_edit'); })->middleware('checkauth');  

 Route::get('/v1/customer-profile-laundry/{id}', function () { return view('admin-laundry.users.customer-profile'); })->middleware('checkauth');
 Route::get('/v1/customer-profile-grocery/{id}', function () { return view('admin-grocery.users.customer-profile'); })->middleware('checkauth');
 Route::get('/v1/customer-profile-mechanic/{id}', function () { return view('admin-mechanic.users.customer-profile'); })->middleware('checkauth');
 Route::get('/v1/customer-profile-courier/{id}', function () { return view('admin-courier.users.customer-profile'); })->middleware('checkauth'); 
 
 
 Route::get('/v1/vendors-laundry', function () { return view('admin-laundry.restaurants.vendors'); })->middleware('checkauth');
 Route::get('/v1/vendors-grocery', function () { return view('admin-grocery.restaurants.vendors'); })->middleware('checkauth');
 Route::get('/v1/vendors-mechanic', function () { return view('admin-mechanic.restaurants.vendors'); })->middleware('checkauth');
 Route::get('/v1/vendors-courier', function () { return view('admin-courier.restaurants.vendors'); })->middleware('checkauth');

 Route::get('/v1/vendor-laundry', function () { return view('admin-laundry.restaurants.vendor_add'); })->middleware('checkauth'); 
 Route::get('/v1/vendor-grocery', function () { return view('admin-grocery.restaurants.vendor_add'); })->middleware('checkauth'); 
 Route::get('/v1/vendor-mechanic', function () { return view('admin-mechanic.restaurants.vendor_add'); })->middleware('checkauth'); 
 Route::get('/v1/vendor-courier', function () { return view('admin-courier.restaurants.vendor_add'); })->middleware('checkauth'); 

 Route::get('/v1/restaurant-laundry/{id}', function () { return view('admin-laundry.restaurants.vendor_edit'); })->middleware('checkauth');
 Route::get('/v1/restaurant-grocery/{id}', function () { return view('admin-grocery.restaurants.vendor_edit'); })->middleware('checkauth');
 Route::get('/v1/restaurant-mechanic/{id}', function () { return view('admin-mechanic.restaurants.vendor_edit'); })->middleware('checkauth');
 Route::get('/v1/restaurant-courier/{id}', function () { return view('admin-courier.restaurants.vendor_edit'); })->middleware('checkauth');  
  
  
  
 Route::get('/v1/store_menu-laundry/{id}', function () { return view('admin-laundry.store-menu.index'); })->middleware('checkauth'); 
 Route::get('/v1/store_menu-grocery/{id}', function () { return view('admin-grocery.store-menu.index'); })->middleware('checkauth'); 
 Route::get('/v1/store_menu-mechanic/{id}', function () { return view('admin-mechanic.store-menu.index'); })->middleware('checkauth'); 
 Route::get('/v1/store_menu-courier/{id}', function () { return view('admin-courier.store-menu.index'); })->middleware('checkauth'); 


 Route::get('/v1/store_info-laundry/{id}', function () {
    return view('admin-laundry.stores.store-settings');
})->middleware('checkauth'); 
  
  Route::get('/v1/store_info-grocery/{id}', function () {
    return view('admin-grocery.stores.store-settings');
})->middleware('checkauth'); 
  
   Route::get('/v1/store_info-mechanic/{id}', function () {
    return view('admin-mechanic.stores.store-settings');
})->middleware('checkauth'); 


    Route::get('/v1/store_info-courier/{id}', function () {
    return view('admin-courier.stores.store-settings');
})->middleware('checkauth'); 



  
 
  Route::get('/v1/driver-laundry', function ()  {   return view('admin-laundry.logistics.driver_add'); })->middleware('checkauth'); 
  Route::get('/v1/driver-grocery', function () { return view('admin-grocery.logistics.driver_add'); })->middleware('checkauth'); 
  Route::get('/v1/driver-mechanic', function () { return view('admin-mechanic.logistics.driver_add'); })->middleware('checkauth'); 
  Route::get('/v1/driver-courier', function () { return view('admin-courier.logistics.driver_add'); })->middleware('checkauth'); 


 Route::get('/v1/driver-laundry/{id}', function () { return view('admin-laundry.logistics.driver_edit'); })->middleware('checkauth'); 
 Route::get('/v1/driver-grocery/{id}', function () { return view('admin-grocery.logistics.driver_edit'); })->middleware('checkauth'); 
 Route::get('/v1/driver-mechanic/{id}', function () { return view('admin-mechanic.logistics.driver_edit'); })->middleware('checkauth'); 
 Route::get('/v1/driver-courier/{id}', function () { return view('admin-courier.logistics.driver_edit'); })->middleware('checkauth'); 


  Route::get('/v1/driver-profile-laundry/{id}', function () { return view('admin-laundry.logistics.driver-profile'); })->middleware('checkauth'); 
  Route::get('/v1/driver-profile-grocery/{id}', function () { return view('admin-grocery.logistics.driver-profile'); })->middleware('checkauth'); 
  Route::get('/v1/driver-profile-mechanic/{id}', function () { return view('admin-mechanic.logistics.driver-profile'); })->middleware('checkauth'); 
  Route::get('/v1/driver-profile-courier/{id}', function () { return view('admin-courier.logistics.driver-profile'); })->middleware('checkauth'); 

 
 Route::get('/v1/manager-laundry', function () { return view('admin-laundry.stores.manager_add'); })->middleware('checkauth'); 
 Route::get('/v1/manager-grocery', function () { return view('admin-grocery.stores.manager_add'); })->middleware('checkauth'); 
 Route::get('/v1/manager-mechanic', function () { return view('admin-mechanic.stores.manager_add'); })->middleware('checkauth'); 
 Route::get('/v1/manager-courier', function () { return view('admin-courier.stores.manager_add'); })->middleware('checkauth'); 


 Route::get('/v1/manager-laundry/{id}', function () { return view('admin-laundry.stores.manager_edit'); })->middleware('checkauth'); 
 Route::get('/v1/manager-grocery/{id}', function () { return view('admin-grocery.stores.manager_edit'); })->middleware('checkauth'); 
 Route::get('/v1/manager-mechanic/{id}', function () { return view('admin-mechanic.stores.manager_edit'); })->middleware('checkauth'); 
 Route::get('/v1/manager-courier/{id}', function () { return view('admin-courier.stores.manager_edit'); })->middleware('checkauth');  
 
 
 
 Route::get('/v1/order_detail-laundry/{id}', function () { return view('admin-laundry.orders.order-detail'); })->middleware('checkauth'); 
 Route::get('/v1/order_detail-grocery/{id}', function () { return view('admin-grocery.orders.order-detail'); })->middleware('checkauth'); 
 Route::get('/v1/order_detail-mechanic/{id}', function () { return view('admin-mechanic.orders.order-detail'); })->middleware('checkauth'); 
 Route::get('/v1/order_detail-courier/{id}', function () { return view('admin-courier.orders.order-detail'); })->middleware('checkauth'); 


 Route::get('/v1/orders-laundry', function () { return view('admin-laundry.orders.orders'); })->middleware('checkauth');
 Route::get('/v1/orders-grocery', function () { return view('admin-grocery.orders.orders'); })->middleware('checkauth');
 Route::get('/v1/orders-mechanic', function () { return view('admin-mechanic.orders.orders'); })->middleware('checkauth');
 Route::get('/v1/orders-courier', function () { return view('admin-courier.orders.orders'); })->middleware('checkauth');

 

    Route::get('/v1/reports-laundry', function () { return view('admin-laundry.reports.reports'); })->middleware('checkauth');
    Route::get('/v1/reports-grocery', function () { return view('admin-grocery.reports.reports'); })->middleware('checkauth');
    Route::get('/v1/reports-mechanic', function () { return view('admin-mechanic.reports.reports'); })->middleware('checkauth');
    Route::get('/v1/reports-courier', function () { return view('admin-courier.reports.reports'); })->middleware('checkauth');


   //Route::get('/v1/reports-detail', function () { return view('admin.reports.report-detail'); });
     Route::get('/v1/reports-detail-laundry/{identifier}', function () { return view('admin-laundry.reports.report-detail'); })->middleware('checkauth'); 
     Route::get('/v1/reports-detail-grocery/{identifier}', function () { return view('admin-grocery.reports.report-detail'); })->middleware('checkauth'); 
     Route::get('/v1/reports-detail-mechanic/{identifier}', function () { return view('admin-mechanic.reports.report-detail'); })->middleware('checkauth'); 
     Route::get('/v1/reports-detail-courier/{identifier}', function () { return view('admin-courier.reports.report-detail'); })->middleware('checkauth'); 
  
  

    Route::get('/admin_login', array('as' => 'admin', 'uses' => 'LoginController@index'));
    Route::post('/login_post',  array('as' => 'admin', 'uses' => 'LoginController@login_post'));
  
 
    Route::get('/admin/change-password', array('middleware' => 'App\Http\Middleware\Role', 'uses' => 'DashController@change_password'));
    Route::put('/admin/change-password', array('middleware' => 'App\Http\Middleware\Role','uses' => 'DashController@update_password'));

  
   
  Route::post('/admin/ajax_users_data', array( 'middleware' => 'auth', 'uses' => 'DashController@ajax_users_data'));
  Route::post('/admin/ajax_likes_data', array( 'middleware' => 'auth', 'uses' => 'DashController@ajax_likes_data'));
  Route::post('/admin/get_countries_data', array( 'middleware' => 'auth', 'uses' => 'DashController@get_countries_data'));
  Route::post('/admin/get_genders_data', array( 'middleware' => 'auth', 'uses' => 'DashController@get_genders_data'));
  
  
  Route::post('/admin/ajax_transaction_data', array( 'middleware' => 'auth', 'uses' => 'DashController@ajax_transaction_data'));
 
  //Users
   Route::resource('user', 'UsersController');
   Route::get('/admin/user', array('middleware' => 'App\Http\Middleware\Role','uses' => 'UsersController@index'));
   Route::get('/admin/user/status/{status}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'UsersController@user_by_status'));
   Route::get('/admin/user/verified/{verified}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'UsersController@user_by_verified'));
   Route::get('/admin/user/verified/{verified}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'UsersController@user_by_verified'));
   
   Route::get('/admin/user/create', array('middleware' => 'App\Http\Middleware\Role','uses' => 'UsersController@create'));
   Route::post('/admin/user', array('middleware' => 'App\Http\Middleware\Role','uses' => 'UsersController@store'));
   Route::get('/admin/user/{id}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'UsersController@show'));
   Route::get('/admin/user/verify/{id}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'UsersController@verify'));
   Route::get('/admin/user/{id}/edit', array('middleware' => 'App\Http\Middleware\Role','uses' => 'UsersController@edit'));
   Route::put('/admin/user/{id}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'UsersController@update'));
   Route::get('/admin/user/{id}/delete', array('uses' => 'UsersController@destroy'));
   Route::get('/admin/user/{id}/block/', array('uses' => 'UsersController@block'));
   Route::get('/admin/user/{id}/unblock/', array('uses' => 'UsersController@unblock'));
   Route::get('/admin/user/{id}/verify/', array('uses' => 'UsersController@verify'));
   Route::get('/admin/user/{id}/unverify/', array('uses' => 'UsersController@unverify'));
   
   Route::get('/admin/user/show/{id}', array('uses' => 'UsersController@show'));
   
   
   
   
   
   
 // Subscribers Route

 Route::get('/v1/subscribers', function () { return view('admin.subscribers.subscribers'); })->middleware('checkauth');
   
    //Admin Users
   Route::resource('admins', 'AdminController');
   Route::get('/admins/admin/status/{status}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AdminController@user_by_status'));
   Route::get('/admins/admin/verified/{verified}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AdminController@user_by_verified'));
   Route::get('/admins/admin/create', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AdminController@create'));
   Route::post('/admins/admin', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AdminController@store'));
   Route::get('/admins/admin/{id}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AdminController@show'));
   Route::get('/admins/admin/verify/{id}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AdminController@verify'));
   Route::get('/admins/admin/{id}/edit', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AdminController@edit'));
   Route::put('/admins/admin/{id}', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AdminController@update'));
   Route::get('/admins/admin/{id}/delete', array('uses' => 'AdminController@destroy'));
   Route::get('/admins/admin/{id}/block/', array('uses' => 'AdminController@block'));
   Route::get('/admins/admin/{id}/unblock/', array('uses' => 'AdminController@unblock'));
   
   

   
   
   
   
  //posts 
   Route::get('posts_list', array('middleware' => 'App\Http\Middleware\Role','uses' => 'PostsController@index'))->name('posts_list');
   Route::get('/posts_list/create/', array('middleware' => 'App\Http\Middleware\Role','uses' => 'PostsController@create'));
   Route::get('/posts_list/{id}/edit', array('middleware' => 'App\Http\Middleware\Role','uses' => 'PostsController@edit_post'))->name('/posts_list/edit');
   Route::post('/posts_list/update', array('middleware' => 'App\Http\Middleware\Role','uses' => 'PostsController@update_post'))->name('/posts_list/update');
   Route::get('/posts_list/{id}/delete', array('middleware' => 'App\Http\Middleware\Role','uses' => 'PostsController@destroy'));
   
   Route::get('/posts_list/images/{id}/delete', array('middleware' => 'App\Http\Middleware\Role','uses' => 'PostsController@destroy_post_images'));
   Route::get('/posts_list/comments/{id}/delete', array('middleware' => 'App\Http\Middleware\Role','uses' => 'PostsController@destroy_post_comments'));
   
   
   
   
    Route::resource('pop_up_content', 'TermsConditionsController');
    Route::get('/admin/pop_up_content', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AppPopUpController@index'));
  Route::post('/admin/app_pop_up_update', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AppPopUpController@pop_up_content_update'));

    //purchase points
    Route::resource('terms_conditions', 'TermsConditionsController');
    Route::get('/admin/terms_conditions', array('middleware' => 'App\Http\Middleware\Role','uses' => 'TermsConditionsController@index'));
  Route::post('/admin/terms_conditions_update', array('middleware' => 'App\Http\Middleware\Role','uses' => 'TermsConditionsController@terms_conditions_update'));
  
  
  
 
  
  
  Route::post('/admin/terms_conditions_update', array('middleware' => 'App\Http\Middleware\Role','uses' => 'TermsConditionsController@terms_conditions_update'));
  
  //App Data
      Route::resource('app_data', 'AppDataController');
    Route::get('/admin/app_data', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AppDataController@index'));
  Route::post('/admin/app_data_update', array('middleware' => 'App\Http\Middleware\Role','uses' => 'AppDataController@app_data_update'));
 
 
  
  
  //mail templates
Route::get('/email_otp', function () {
    return view('emails.otp');
});
  
  
  
 

  
});














//================================== FOOD WEBSITE Routes Starts==============================================================
/**
Route::get('/', function () {
    return view('web-food.index');
});

Route::get('/web-login', function () {
    return view('web-food.login');
});


Route::get('/unsubscribe', function () {
    return view('web-food.unsubscribe');
});



Route::get('/faq', function () {
    return view('web-food.faq');
});
Route::get('/about', function () {
    return view('web-food.about');
});
Route::get('/terms-and-conditions', function () {
    return view('web-food.terms-and-conditions');
});
Route::get('/privacy-policy', function () {
    return view('web-food.privacy-policy');
});
Route::get('/contact', function () {
    return view('web-food.contact');
});
Route::get('/web-login', function () {
    return view('web-food.login');
});
Route::get('/register', function () {
    return view('web-food.register');
});
Route::get('/change-password', function () {
    return view('web-food.change-password');
});
Route::get('/forgot-password', function () {
    return view('web-food.forgot-password');
});
Route::get('/my-orders', function () {
    return view('web-food.my-orders');
});
Route::get('/loyalty-points', function () {
    return view('web-food.loyalty-points');
});
Route::get('/transfer-loyalty-points', function () {
    return view('web-food.transfer-loyalty-points');
});
Route::get('/addresses', function () {
    return view('web-food.address');
});
Route::get('/refer', function () {
    return view('web-food.refer');
});
Route::get('/reviews', function () {
    return view('web-food.reviews');
});
Route::get('/favourites', function () {
    return view('web-food.favourites');
});

Route::get('/account', function () {
    return view('web-food.account-settings');
});

Route::get('/stores', function () {
    return view('web-food.stores');
});
Route::get('/order-items', function () {
    return view('web-food.menu-items');
});
Route::get('/checkout', function () {
    return view('web-food.checkout');
});
Route::get('/order_detail', function () {
    return view('web-food.order-detail');
});
Route::get('/order-items1', function () {
    return view('web-food.menu-items1');
});
**/