<?php

namespace App\Http\Controllers\Admin; //admin add
use App;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // using controller class
use Auth;
use Session;
use DB;
use Validator;
use App\AppData;
use Mail;
use Hash;
use App\TermsConditions;
 


class AppDataController extends Controller 
{
    
   
   public function __construct()
    {
        $this->middleware('auth');
    }

 
    public function index(request $request)
    {
		
		 
        // get all the users
        $app_data = AppData::get();
		
 		return view('admin.app_data.index')->with('content', $app_data);
    }
 
    public function app_data_update(request $request)
    {
    
	  $AppData = AppData::firstOrNew(array('key_name' => 'admin_contact'));
      $AppData->value = $request->admin_contact;	 
	  $AppData->save();	 
	  
	  
	  
	   $AppData2 = AppData::firstOrNew(array('key_name' => 'admin_email'));
      $AppData2->value = $request->admin_email;	 
	  $AppData2->save();	



	  $AppData2 = AppData::firstOrNew(array('key_name' => 'android_app_version'));
      $AppData2->value = $request->android_app_version;	 
	  $AppData2->save();


      $AppData2 = AppData::firstOrNew(array('key_name' => 'ios_app_version'));
      $AppData2->value = $request->ios_app_version;	 
	  $AppData2->save();	  
	  
	  
	  
       $app_data = AppData::get();
		
 		return view('admin.app_data.index')->with('content', $app_data);
    }
 
 
	

}