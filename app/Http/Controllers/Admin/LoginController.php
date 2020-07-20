<?php

namespace App\Http\Controllers\Admin; //admin add

use App\Http\Requests;
use App\Http\Controllers\Controller; // using controller class
use Auth;
use Session;
use Illuminate\Http\Request;
use App\User;



class LoginController extends Controller 
{
	
  //For Admin login view
  public function index(Request $request) 
  {  
  
    return view('admin-grocery.login.index');
  }
  
  
  
    //For Admin login view
  public function login_post(Request $request) 
  {  
 
   
 if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'status'=>1 , 'user_type'=>1 ]) || Auth::attempt(['email' => $request->email, 'password' => $request->password,'status'=>1 , 'user_type'=>'4' ]))
		{		

            $app_type = @\App\User::where('email' , $request->email )->first(['app_type'])->app_type;
			if($app_type == '' || $app_type == null || $app_type ==  ' ' || $app_type == 'undefined')
			{
				$this->logout($request);
			}
       return redirect('admin/dashboard-grocery');
    
			  
		}
		else
		{
			Session::flash('message', 'Invalid email and password'); 
			
			 
		}
 
	
	  
    return view('admin-grocery.login.index');
  }
  
  
   

  //for logout


public function logout(Request $request) {
  \Auth::logout();
  session()->flush();
  return view('admin-grocery.login.index');
}



  //For first registration admin
  public function register()
  {
  	 User::create([
            'name' => 'rahul katara',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'user_group_id'=>1,
            'status'=>1,
            'username'=>'admin'

        ]);
  	die('sdf');

  }



}