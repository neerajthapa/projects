<?php

namespace App\Http\Controllers\Admin; //admin add

use DateTime;
use App\Http\Requests;
use App\Http\Controllers\Controller; // using controller class
use Auth;
use Session;
use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Answer;
use App\Auction;
use App\UserPurchasePoint;
use App\UserPointHistory;
use Validator;
use Carbon\Carbon;
use DB;
use Hash;


class DashController extends Controller 
{
	
   
   public function __construct()
    {
        $this->middleware('auth');
    }

  //For Admin login view
  public function index(Request $request) 
  { 
     
	// return  $users_graph_data;
     return view('admin.dash.index') ;
}



//======================================================== GET USERS DATA ==============================================================//
public function ajax_users_data(Request $request) 
  { 
  
  
 
	
  
 $type = $request->type;
 if($type =='monthly')
 {
     $no_of_days_current_month = cal_days_in_month(CAL_GREGORIAN, date("m"), date("y"));
     $total_users = User::count();
	 $total_brands = \App\Admin::where('user_type','brand')->count();
	 $total_stores = \App\Admin::where('user_type','store')->count();
	 $total_offers = \App\Posts::count();
	 
     $current_month = date("Y-m");     
     $previous_month = date("Y-m",strtotime("-1 month"));  
 
	 
	 $users_graph_data = array();
	 for($t=1;$t <= $no_of_days_current_month;$t++)
	 {
	     $current_day = date("Y-m-".$t); 
		 $ud['label'] = $t;
		 $ud['date'] = $current_day;
		 $ud['y'] = User::whereDate('created_at', '=', date('Y-m-'.$t))->count();
		 $users_graph_data[] = $ud;
	 }
	 return $users_graph_data;
 }
	
 
 if($type =='weekly')
 {
$start = Carbon::now()->subDays(30);
$m= date("m");
$de= date("d");
$y= date("Y");

for($i=14; $i>=0; $i--)
{
 $dates[] = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 
}
$users_graph_data = array();
foreach($dates as $date)
{
 
		 $ud['label'] = Carbon::parse($date)->format('d M');
		 $ud['date'] = $date;
		 $ud['y'] = User::whereDate('created_at', '=', $date)->count();
		 $users_graph_data[] = $ud;
}
return $users_graph_data;
 }

 
if($type =='yearly')
{
     for($t = 0; $t <= 12; $t++) 
     {
       $dates[] = date('Y-m', strtotime( date( 'Y-m-01' )." -".$t." months"));
     }

$users_graph_data = array();
foreach(array_reverse($dates)  as $date)
{
 
		 $ud['label'] = Carbon::parse($date)->format('M');
		 $ud['date'] = $date;
		 $ud['y'] = User::whereDate('created_at', 'like', "%".$date."%")->count();
		 $users_graph_data[] = $ud;
}
return $users_graph_data;
}

 
}





//======================================================== GET USERS DATA ==============================================================//
public function ajax_likes_data(Request $request) 
  { 
  
 $type = $request->type;
 if($type =='monthly')
 {
     $no_of_days_current_month = cal_days_in_month(CAL_GREGORIAN, date("m"), date("y"));
 
	 
     $current_month = date("Y-m");     
     $previous_month = date("Y-m",strtotime("-1 month"));  
 
	 
	 $users_graph_data = array();
	 for($t=1;$t <= $no_of_days_current_month;$t++)
	 {
	     $current_day = date("Y-m-".$t); 
		 $ud['label'] = $t;
		 $ud['date'] = $current_day;
		 $ud['y'] = \App\PostsActivity::whereDate('created_at', '=', date('Y-m-'.$t))->count();
		 $users_graph_data[] = $ud;
	 }
	 return $users_graph_data;
 }
	
 
 if($type =='weekly')
 {
$start = Carbon::now()->subDays(30);
$m= date("m");
$de= date("d");
$y= date("Y");

for($i=14; $i>=0; $i--)
{
 $dates[] = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 
}
$users_graph_data = array();
foreach($dates as $date)
{
 
		 $ud['label'] = Carbon::parse($date)->format('d M');
		 $ud['date'] = $date;
		 $ud['y'] = \App\PostsActivity::whereDate('created_at', '=', $date)->count();
		 $users_graph_data[] = $ud;
}
return $users_graph_data;
 }

 
if($type =='yearly')
{
     for($t = 0; $t <= 12; $t++) 
     {
       $dates[] = date('Y-m', strtotime( date( 'Y-m-01' )." -".$t." months"));
     }

$users_graph_data = array();
foreach(array_reverse($dates)  as $date)
{
 
		 $ud['label'] = Carbon::parse($date)->format('M,Y');
		 $ud['date'] = $date;
		 $ud['y'] = \App\PostsActivity::whereDate('created_at', 'like', "%".$date."%")->count();
		 $users_graph_data[] = $ud;
}
return $users_graph_data;
}

 
}














//======================================================== GET USERS DATA ==============================================================//
public function ajax_transaction_data(Request $request) 
  { 
  
 $type = $request->type;
 if($type =='monthly')
 {
     $no_of_days_current_month = cal_days_in_month(CAL_GREGORIAN, date("m"), date("y"));
 
	 
     $current_month = date("Y-m");     
     $previous_month = date("Y-m",strtotime("-1 month"));  
 
	 
	 $users_graph_data = array();
	 for($t=1;$t <= $no_of_days_current_month;$t++)
	 {
	     $current_day = date("Y-m-".$t); 
		 $ud['label'] = $t;
		 $ud['date'] = $current_day;
		 $ud['y'] = \App\Transactions::whereDate('created_at', '=', date('Y-m-'.$t))->count();
		 $users_graph_data[] = $ud;
	 }
	 return $users_graph_data;
 }
	
 
 if($type =='weekly')
 {
$start = Carbon::now()->subDays(30);
$m= date("m");
$de= date("d");
$y= date("Y");

for($i=14; $i>=0; $i--)
{
 $dates[] = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 
}
$users_graph_data = array();
foreach($dates as $date)
{
 
		 $ud['label'] = Carbon::parse($date)->format('d M');
		 $ud['date'] = $date;
		 $ud['y'] = \App\Transactions::whereDate('created_at', '=', $date)->count();
		 $users_graph_data[] = $ud;
}
return $users_graph_data;
 }

 
if($type =='yearly')
{
     for($t = 0; $t <= 12; $t++) 
     {
       $dates[] = date('Y-m', strtotime( date( 'Y-m-01' )." -".$t." months"));
     }

$users_graph_data = array();
foreach(array_reverse($dates)  as $date)
{
 
		 $ud['label'] = Carbon::parse($date)->format('M,Y');
		 $ud['date'] = $date;
		 $ud['y'] = \App\Transactions::whereDate('created_at', 'like', "%".$date."%")->count();
		 $users_graph_data[] = $ud;
}
return $users_graph_data;
}

 
}











 



public function get_countries_data(Request $request) 
  { 
 
  $data = DB::table("users")
    ->select(DB::raw("country as label,COUNT(*) as y"))
    ->orderBy("created_at")
    ->groupBy(DB::raw("country"))
    ->get();

 return $data;
	 
 
}






public function get_genders_data(Request $request) 
  { 
  
 $data = DB::table("users")
    ->select(DB::raw("gender as label,COUNT(*) as y"))
    ->orderBy("created_at")
    ->groupBy(DB::raw("gender"))
    ->get();

 return $data;
	 
 
}



 
 
 


  //For Admin Change password
  public function change_password()
  {
    return view('admin.dash.change_password');
  }

  //For Admin Change password
  public function update_password(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'password'  =>  'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6|',
         ]);
        if ($validator->fails()) {
          //print_r($validator->errors()->all());die;
            return redirect('/admin/change-password')
                ->withInput()
                ->withErrors($validator);
        }
        else
        {
          $user = User::find(Auth::user()->id);
          $user->password  =  Hash::make($request->password);                                    
          $user->save();
          // redirect
          Session::flash('message', 'Successfully updated password!');
          return redirect('admin/change-password');
        }
   
  }

  
}