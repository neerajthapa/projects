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
use App\User;
use Carbon\Carbon;
use App\Otp;
use App\UserSocialLinks;
use App\UserLikesDislikes;
use App\UserRatings;
use App\Country;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Traits\one_signal; // <-- you'll need this line...
use App\Traits\bitcoin_price;
use App\Traits\trait_functions;
use Illuminate\Support\Arr;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Hash;
use Mail;
use File;
 
 

class DashboardController extends Controller 
{
	
use one_signal; // <-- ...and also this line.
use bitcoin_price; // <-- ...and also this line.
use trait_functions; // <-- ...and also this line.
 
   
   


 // Route-64 ============================================================== To get dashboard Data =========================================> 
 
   public function index(Request  $request)
   {
          $auth_user_id = $this->get_auth_user_id();
          $auth_user_type = $this->get_auth_user_type();
          $auth_app_type = $this->get_auth_app_type();
         


    $auth_user_id = $this->get_auth_user_id();
    $user_type = $this->get_auth_user_type();
    
    if($user_type == '4') //store manager_id
    {
         return app('App\Http\Controllers\Admin\DashboardStoreController')->index($request);
    }

     if($user_type == '3') //vendor
    {
         return  app('App\Http\Controllers\Admin\DashboardVendorController')->index($request);
    }
 	 
    //  $dashboard_blocks_array[] = $this->get_orders_graph_data($request);

  

      return '1';

   }

 


// Fuction o give different types of data for dashboard page

   public function get_top_users(Request $request)
   {

          $auth_user_id = $this->get_auth_user_id();
          $auth_user_type = $this->get_auth_user_type();
          $auth_app_type = $this->get_auth_app_type();
          if($auth_app_type == 'laundry' || $auth_app_type == 'grocery' || $auth_app_type == 'courier' || $auth_app_type == 'mechanic') {} 
          else {  
                return []; 
             }


     $main = array();
     $d["type"] = 'top_users'; 
     $d["title"] = 'Top Users'; 
     $top_users = array();
     $setting_order_meta_type_id = $this->get_setting_order_meta_type_id( $request , 'customer_id');

 
     $top_user_data = \App\OrderMetaValue::where('setting_order_meta_type_id',$setting_order_meta_type_id)->where('order_meta_value_text','<>' , null)->groupBy('order_meta_value_text')->select('order_meta_value_text', DB::raw('count(*) as total'))->orderBy('total','DESC')->take(5)->get();
 
     foreach($top_user_data as $tu)
     {
        $user_exist_count = @\App\User::where('app_type' , $auth_app_type )->where('user_id',$tu->order_meta_value_text)->count();
        if($user_exist_count > 0 )
        {

          @$u = @\App\User::where('app_type' , $auth_app_type )->where('user_id',$tu->order_meta_value_text)->first(['user_id','first_name','last_name','email','phone','photo','created_at']);
          @$u->total_orders = @$tu->total;
          @$top_users[] = @$u;
        }
      
     }
 
     $d["data"] = $top_users;
     $main[] = $d;
     return $main;

   }




   public function get_tasks(Request $request)
   {

          $auth_user_id = $this->get_auth_user_id();
          $auth_user_type = $this->get_auth_user_type();
          $auth_app_type = $this->get_auth_app_type();
          if($auth_app_type == 'laundry' || $auth_app_type == 'grocery' || $auth_app_type == 'courier' || $auth_app_type == 'mechanic') {} 
          else {  
                $data['status_code']    =   0;
                $data['status_text']    =   'Failed';             
                $data['message']        =   'App Type Required';
                $data['data']      =   [];   
				return [];
             }


     $main = array();
     $d["type"] = 'tasks'; 
     $d["title"] = 'Recent Tasks'; 
     $tasks = array();

     $order_ids = @\App\Order::where('app_type' , $auth_app_type )->pluck('order_id');
     $tasks = \App\Task::whereIn('order_id' , $order_ids)->paginate(10);
     $d["data"] = $tasks;
     $main[] = $d;
     return $main;

   }






   public function get_recent_users()
   {

          $auth_user_id = $this->get_auth_user_id();
          $auth_user_type = $this->get_auth_user_type();
          $auth_app_type = $this->get_auth_app_type();
          if($auth_app_type == 'laundry' || $auth_app_type == 'grocery' || $auth_app_type == 'courier' || $auth_app_type == 'mechanic') {} 
          else {  
                $data['status_code']    =   0;
                $data['status_text']    =   'Failed';             
                $data['message']        =   'App Type Required';
                $data['data']      =   [];   
				return [];
             }

     $main = array();
     $d["type"] = 'recent_users'; 
     $d["title"] = 'Recent Users'; 
     $recent_users = \App\User::where('app_type' , $auth_app_type )->orderBy('created_at','DESC')->take(5)->get(['user_id','first_name','last_name','email','phone','photo','created_at']);
     $d["data"] = $recent_users;
     $main[] = $d;
     return $main;

   }

 
    public function get_recent_orders(Request $request)
   {

          $auth_user_id = $this->get_auth_user_id();
          $auth_user_type = $this->get_auth_user_type();
          $auth_app_type = $this->get_auth_app_type();
          if($auth_app_type == 'laundry' || $auth_app_type == 'grocery' || $auth_app_type == 'courier' || $auth_app_type == 'mechanic') {} 
          else {  
                $data['status_code']    =   0;
                $data['status_text']    =   'Failed';             
                $data['message']        =   'App Type Required';
                $data['data']      =   [];  
                return [];				
             }

   	 $main = array();
     $d['type'] ='recent_orders';
     $d['title'] ='Recent Orders';
	   $orders = \App\Order::where('app_type' , $auth_app_type )->orderBy('created_at','DESC')->get()->take(5);
     $d['data'] = $orders;
     $main[] = $d;
     return $main;
   }


    public function get_today_pickup_orders(Request $request)
   {

          $auth_user_id = $this->get_auth_user_id();
          $auth_user_type = $this->get_auth_user_type();
          $auth_app_type = $this->get_auth_app_type();
          if($auth_app_type == 'laundry' || $auth_app_type == 'grocery' || $auth_app_type == 'courier' || $auth_app_type == 'mechanic') {} 
          else {  
                $data['status_code']    =   0;
                $data['status_text']    =   'Failed';             
                $data['message']        =   'App Type Required';
                $data['data']      =   [];   
				return [];
             }


     //getting list of todays pickup order
      $main = array();
      $d["type"] = 'today_pickup_orders'; 
      $d["title"] = 'Todays Pickup Orders'; 
  
      $todays_orders_pickup_id = array();
      $todays_pickup_orders = array();

      $setting_order_meta_type_id = $this->get_setting_order_meta_type_id( $request , 'pickup_time');
      $present_date = \Carbon\Carbon::now()->format('Y-m-d')."";
      $todays_orders_pickup_id = @\App\OrderMetaValue::where('setting_order_meta_type_id',$setting_order_meta_type_id)->where('order_meta_value_text', 'like', "%".$present_date."%")->pluck('order_id');
  
     if(sizeof($todays_orders_pickup_id) > 0)
     {
       for($po=0;$po<sizeof($todays_orders_pickup_id);$po++)
        {
             $order = @\App\Order::where('app_type' , $auth_app_type )->where('order_id',$todays_orders_pickup_id[$po])->first();
             $todays_pickup_orders[] =$order;
        }
     }
 
      $d["data"] = $todays_pickup_orders;
      $main[] = $d;
      return $main;
  
   	
   }


   public function get_today_delivery_orders(Request $request)
   {

          $auth_user_id = $this->get_auth_user_id();
          $auth_user_type = $this->get_auth_user_type();
          $auth_app_type = $this->get_auth_app_type();
          if($auth_app_type == 'laundry' || $auth_app_type == 'grocery' || $auth_app_type == 'courier' || $auth_app_type == 'mechanic') {} 
          else {  
                $data['status_code']    =   0;
                $data['status_text']    =   'Failed';             
                $data['message']        =   'App Type Required';
                $data['data']      =   [];   
				return $data;
             }


   	     //getting list of todays pickup order
      $main = array();
      $d["type"] = 'today_delivery_orders'; 
      $d["title"] = 'Todays Delivery Orders'; 
  
      $todays_orders_delivery_id = array();
      $todays_delivery_orders = array();

      $setting_order_meta_type_id = $this->get_setting_order_meta_type_id( $request , 'delivery_time');
      $present_date = \Carbon\Carbon::now()->format('Y-m-d')."";
      $todays_orders_delivery_id = @\App\OrderMetaValue::where('setting_order_meta_type_id',$setting_order_meta_type_id)->where('order_meta_value_text', 'like', "%".$present_date."%")->pluck('order_id');
  
     if(sizeof($todays_orders_delivery_id) > 0)
     {
       for($po=0;$po<sizeof($todays_orders_delivery_id);$po++)
        {
             $order = @\App\Order::where('app_type' , $auth_app_type )->where('order_id',$todays_orders_delivery_id[$po])->first();
             $todays_delivery_orders[] =$order;
        }
     }
 
      $d["data"] = $todays_delivery_orders;
      $main[] = $d;
      return $main;
   }




// orders graph data

   public function get_orders_graph_data(Request $request)
   {

          $auth_user_id = $this->get_auth_user_id();
          $auth_user_type = $this->get_auth_user_type();
          $auth_app_type = $this->get_auth_app_type();
          if($auth_app_type == 'laundry' || $auth_app_type == 'grocery' || $auth_app_type == 'courier' || $auth_app_type == 'mechanic') {} 
          else {  
                $data['status_code']    =   0;
                $data['status_text']    =   'Failed';             
                $data['message']        =   'App Type Required';
                $data['data']      =   [];   
				return [];
             }


     //graph 3 starts here
      $data = array();
      $data_object["type"] = 'orders'; 
      $dates3 = array();
      for($t = 0; $t <= 7; $t++) 
      {
        $dates3[] = date('Y-m-d', strtotime( date( 'Y-m-d' )." -".$t." days"));
      }

     
 
      $total3 = 0;

      foreach(array_reverse($dates3)  as $date)
      {
        $ud3['label'] = \Carbon\Carbon::parse($date)->format('M');
        $ud3['date'] = $date;
        $ud3['y'] = \App\Order::where('app_type' , $auth_app_type )->whereDate('created_at', 'like', "%".$date."%")->count();
        $total3= $total3 + \App\Order::where('app_type' , $auth_app_type )->whereDate('created_at', 'like', "%".$date."%")->sum('total');
        $data[] = $ud3;
      }

      $data_object["total"] = round($total3,2);
      $data_object["desc"] = "Total Order of Last 1 Week";
      $data_object["data"] = $data;

      $main_array[] = $data_object;
      return $main_array;
    }





















///================================ function to check GET variable's and Defaults ====================================================//
public function get_variable_per_page()
{
	 if(isset($_GET['per_page']) && $_GET['per_page'] != null && $_GET['per_page'] != '')
					{ $per_page = $_GET['per_page']; }
					else 
					{ $per_page = 20; }
    return $per_page;
}

public function get_variable_orderby()
{
	 if(isset($_GET['orderby']) && $_GET['orderby'] != null && $_GET['orderby'] != '')
					{ $orderby = $_GET['orderby']; }
					else 
					{ $orderby = 'created_at'; }
    return $orderby;
}

public function get_variable_order()
{
	 if(isset($_GET['order']) && $_GET['order'] != null && $_GET['order'] != '')
					{ $order = $_GET['order']; }
					else 
					{ $order = 'DESC'; }
    return $order;
}


public function get_variable_search()
{
	 if(isset($_GET['search']) && $_GET['search'] != null && $_GET['search'] != '')
					{ $search = $_GET['search']; }
					else 
					{ $search = ''; }
    return $search;
}	
      
   
   public function get_variable_category()
{
	 if(isset($_GET['category']) && $_GET['category'] != null && $_GET['category'] != '')
					{ $category = $_GET['category']; }
					else 
					{ $category = ''; }
    return $category;
}	

   public function get_variable_tag()
{
	 if(isset($_GET['tag']) && $_GET['tag'] != null && $_GET['tag'] != '')
					{ $tag = $_GET['tag']; }
					else 
					{ $tag = ''; }
    return $tag;
}	

  
   public function get_variable_status()
{
	 if(isset($_GET['status']) && $_GET['status'] != null && $_GET['status'] != '')
					{ $status = $_GET['status']; }
					else 
					{ $status = 'active'; }
    return $status;
}


   public function get_variable_include_meta()
{
	 if(isset($_GET['include_meta']) && $_GET['include_meta'] != null && $_GET['include_meta'] != '')
					{ $include_meta = $_GET['include_meta']; }
					else 
					{ $include_meta = 'true'; }
    return $include_meta;
}	
 
 ///================================ function to check GET variable's and Defaults Ends ====================================================//
 
 
 
 
 
  
 
 
 
 
	 
 
 


}