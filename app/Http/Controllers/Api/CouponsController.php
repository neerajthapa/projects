<?php
namespace App\Http\Controllers\Api; //admin add
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
 use anlutro\LaravelSettings\Setting;
 


class CouponsController extends Controller 
{
	

use one_signal; // <-- ...and also this line.
use bitcoin_price; // <-- ...and also this line.
use trait_functions; // <-- ...and also this line. 
   
   
  



   
 // Route-5.1 ============================================================== Store Item to Items table =========================================> 
   public function store(Request $request , $create_item_request = '')
   {
                
               if($create_item_request != '')
               {
                	$request = $create_item_request;
               }

                if($request['coupon_title'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Coupon Title Required';
                    return $data;	
               }

                if($request['coupon_code'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Coupon Code Required';
                    return $data; 
               }

                if($request['discount'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Discount Required';
                    return $data; 
               }

         
        
        if($request['type'] == '')
          {
                         $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Coupon Type Required';
                       
                          return $data;
          }
		  
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
				
				

          $expiry = $this->get_variable_expiry($request);
          $valid_from = $this->get_variable_valid_from($request);
            $type = $this->get_variable_type($request['type']);
            
 
					$item = new \App\Coupons;
					$item->coupon_title = @$request['coupon_title'];
					$item->coupon_desc =   $this->validate_string(@$request['coupon_desc']);
					$item->coupon_image = $this->validate_string(@$request['coupon_image']);
					$item->coupon_code =$this->validate_string(@$request['coupon_code']);

					$item->discount =$this->validate_integer(@$request['discount']);

					$item->valid_from = $valid_from;
					$item->expiry = $expiry;
                     $item->type = $type;
					$item->max_discount = $this->validate_integer(@$request['max_discount']);
					$item->items_included = $this->validate_string(@implode (",", $request['items_included']));
					$item->limit_total = $this->validate_integer(@$request['limit_total']);
					$item->limit_user = $this->validate_integer(@$request['limit_user']);
					$item->minimum_order_amount = $this->validate_integer(@$request['minimum_order_amount']);
					$item->maximum_order_amount = $this->validate_integer(@$request['maximum_order_amount']);
					$item->active_status = $this->validate_boolean(@$request['active_status']);
					$item->vendor_id = $this->validate_integer(@$request['vendor_id']);
					$item->store_id = $this->validate_integer(@$request['store_id']);
					$item->app_type = $this->validate_integer(@$auth_app_type);
 
					$item->save();
				        	  
				 
					if($item != '')
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Coupon Added Successfully';
                          $data['data']      =   $item;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to Add Coupon';
                          $data['data']      =   [];  
					}
				   return $data;
				 
  }
  

   

 // Route-5.2 ============================================================== Get Item Details =========================================> 
   public function show($id)
   {
	        //check existance of item with ID in items table
					$exist = $this->model_exist($id);	
                    if($exist == 0 or $exist == '0')
                    {
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Coupon with this ID does not exist';
                          $data['data']      =   [];
                          return $data;						  
					}						
					
					$details = @\App\Coupons::where('coupon_id',$id)->get();
			   	
				    if($details != '')
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Coupon Fetched Successfully';
                          $data['data']      =   $details;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to Fetch Coupon';
                          $data['data']      =   [];  
					}
				   return $data;
				 
  }   
  
  // Route-5.3 ============================================================== Get Coupons List =========================================> 
   public function get_list()
   {

 

/***************************

$k = ["a","b","c","d"];
\App\Coupons::whereIn('coupon_title', $k)->get(); 

    $model = new \App\Coupons;
    $model = $model::where('coupon_id' ,'<>', '0');  
    $model=    $model->whereRaw('FIND_IN_SET("a",coupon_title)');
   for($i=1;$i<sizeof($k); $i++)
     {
       $model =    $model->orWhereRaw('FIND_IN_SET( "'.$k[$i].'", coupon_title)');
     }
  $result = $model->paginate(15);

return $result; 
*******************///

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
				
				

    $per_page = $this->get_variable_per_page(); //ASC or DESC
		$orderby = $this->get_variable_orderby();
		$order = $this->get_variable_order();
		$search = $this->get_variable_search();
		$status = $this->get_variable_status();
    $store_id = $this->get_variable_store_id();
		
		$include_consumed = $this->get_variable_include_consumed();
		$include_expired  = $this->get_variable_include_expired();
	
		
		$model = new \App\Coupons;
    $model = $model::where('coupon_id' ,'<>', '0');  
	$model = $model->where('app_type' , $auth_app_type);  


    //user types filters ==========================================
    $auth_user_id = $this->get_auth_user_id();
    $user_type = $this->get_auth_user_type();
    if($user_type == '4') //store manager_id
    {
       $store_id = @\App\Store::where('manager_id',$auth_user_id)->first(['store_id'])->store_id;
       if($store_id == '' || $store_id == null) { $store_id = 'NA';}
    }
     if($user_type == '3') //vendor
    {   $model = $model->where('vendor_id' , $auth_user_id );   
    }
    //user type_filter check ends =================================



    

      if($store_id != '' && $store_id != null)
    {   $model = $model->where('store_id' , $store_id);  } 
 
    //user type_filter check ends

        if($status != 'any' && $status != '' && $status != null)
        {
        	$model->where('active_status' , $status); 
        }
 
        if(   $include_expired == 'true')
        {

           	$model->whereDate('expiry', '<', date("Y-m-d"));
        }
              else
        {

            $model->whereDate('expiry', '>', date("Y-m-d"));
        }
 

	    if($search != '' && $search != null)
		{  $model = $model->where(function($q) use ($search) { $q->where( DB::raw("CONCAT(coupon_id,' ',coupon_code,' ',coupon_desc,' ', coupon_title)"),'like', '%'.$search.'%'); });  }
        

		$model = $model->orderBy($orderby,$order);
         
        $result = $model->paginate($per_page);
		
 
				 
	              if(sizeof($result) > 0)
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Coupons List Fetched Successfully';
                          $data['data']      =   $result;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'No Coupons Found';
                          $data['data']      =   [];  
					}
				   return $data;
   }  



  // Route-5.4 ============================================================== Get Items List =========================================> 
   public function update(Request $request , $id , $create_item_request = '')
   {
	          if($create_item_request != '')
                {
                	$request = $create_item_request;
                }



              if($request['coupon_title'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Coupon Title Required';
                    return $data; 
               }

                if($request['coupon_code'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Coupon Code Required';
                    return $data; 
               }

                           if($request['discount'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Discount Required';
                    return $data; 
               }
            

       
			  
        if($request['type'] == '')
          {
                         $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Coupon Type Required';
                       
                          return $data;
          }
	               //check existance of item with ID in items table
					$exist = $this->model_exist($id);	
                    if($exist == 0 or $exist == '0')
                    {
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Coupon with this ID does not exist';
                          $data['data']      =   [];
                          return $data;						  
					}
				    $type = $this->get_variable_type($request['type']);
	                    $expiry = $this->get_variable_expiry($request);
          $valid_from = $this->get_variable_valid_from($request);

	              	  App\Coupons::where('coupon_id', $id)->update(
	                	[
	                 'coupon_title' => $this->validate_string(@$request['coupon_title']),
					 'coupon_desc' =>   $this->validate_string(@$request['coupon_desc']) ,
					 'coupon_image' => $this->validate_string(@$request['coupon_image']) ,
					 'coupon_code' =>$this->validate_string(@$request['coupon_code']) ,

					 'discount' =>$this->validate_integer(@$request['discount']) ,
					 'valid_from' => $valid_from,
           'type' => $type,
					 'expiry' => $expiry,
					 'max_discount' => $this->validate_integer(@$request['max_discount']) ,
					 'items_included' => $this->validate_string(@implode (",", $request['items_included'])) ,
					 'limit_total' => $this->validate_integer(@$request['limit_total']) ,
					 'limit_user' => $this->validate_integer(@$request['limit_user']) ,
					 'minimum_order_amount' => $this->validate_integer(@$request['minimum_order_amount']) ,
					 'maximum_order_amount' => $this->validate_integer(@$request['maximum_order_amount']) ,
					 'active_status' => $this->validate_boolean(@$request['active_status']) ,
					 'vendor_id' => $this->validate_integer(@$request['vendor_id']) ,
					 'store_id' => $this->validate_integer(@$request['store_id'])

	                	]);
					 
				    $result = @\App\Coupons::where('coupon_id',$id)->get();
 
			 			
	                if(sizeof($result) > 0)
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Coupon Updated Successfully';
                          $data['data']      =   $result;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to Update';
                          $data['data']      =   [];  
					}
				   return $data;
   }  


   
  //Route-5.5 =====================APPLY COUPON============================

   public function apply(Request $request)
   {
 
 
				
				
          $coupon_code = $request->coupon_code;
          $items = $request->items;
          $store_id = $this->validate_string($request->store_id);


          //check ifcoupon code exist
          $coupon_code_exist = $this->coupon_code_exist($coupon_code);
          if($coupon_code_exist == 0 or $coupon_code_exist == '0')
          {        
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Coupon does not exits';
                          $data['data']      =   []; 
                          $data['discount']      =   0;  
                          return $data;
          }


          if($store_id != '')
          {
            $store_id_exist = @\App\Coupons::where('coupon_code',$coupon_code)->where('store_id' ,$store_id)->count();
            if($store_id_exist < 1)
            {
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Coupon not valid for store';
                          $data['data']      =   []; 
                          $data['discount']      =   0;  
                          return $data;

            }
          }

 
         


         $coupon_details = @\App\Coupons::where('coupon_code',$coupon_code)->first();


 
 
          //check if value present date exist between valid from and valid to
           $exist_between_validfrom_expiry =   $this->exist_between_validfrom_expiry($coupon_code);
           if($exist_between_validfrom_expiry == 0 or $exist_between_validfrom_expiry == '0')
            {
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Coupon is expired';
                          $data['data']      =   []; 
                           $data['discount']      =   0;   
                          return $data;
            }
         


           /**
           //check limit_user
           $check_limit_user =   $this->check_limit_user($coupon_code , $details->limit_user);
           if($check_limit_user == 0 or $check_limit_user == '0')
            {
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Coupon Code is not under valid time period';
                          $data['data']      =   [];  
                          return $data;
            }

           //check limit_total
           $check_limit_total = $this->check_limit_total($coupon_code , $details->limit_total);
           if($check_limit_total == 0 or $check_limit_total == '0')
            {
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Coupon Code is not under valid time period';
                          $data['data']      =   [];  
                          return $data;
            }
            **/

            //check active_status (it should be true to pass this check)
             if($coupon_details->active_status != 'true'  )
            {
 
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Coupon Code you entered is not Active';
                          $data['data']      =   []; 
                           $data['discount']      =   0;   
                          return $data;
            }

         
        //advanced checks

           

if($coupon_details['items_included'] != '' && $coupon_details['items_included'] != null)
{
          $filtered_included_items = $this->filter_included_items($items , $coupon_code);

          if(sizeof($filtered_included_items) < 1)
          {
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'This Coupon not applied on any of the items you selected';
                          $data['data']      =   []; 
                          $data['discount']      =   0;   
                          return $data;
          }
 }
else
{
	$filtered_included_items = $items;
}

          $included_items_with_variant_price = $this->add_variant_price_to_order_items($filtered_included_items);
            $included_order_total = $this->total_order_amount_from_items($included_items_with_variant_price);

      

          $order_total = $this->total_order_amount_from_items($items);
        
          $order_amount_is_in_range = $this->order_amount_is_in_range($coupon_code , $included_order_total);


 
  
         if($order_amount_is_in_range == 0 or $order_amount_is_in_range == '0')
         {

        
                         $maximum_order_amount = $coupon_details['maximum_order_amount'];

                        
                            $minimum_order_amount = $coupon_details['minimum_order_amount'];
                          if($maximum_order_amount == '' || $maximum_order_amount == null) { $maximum_order_amount = 0;}
                          if($minimum_order_amount == '' || $minimum_order_amount == null) { $minimum_order_amount = 0;}



  
                          if($included_order_total > intval($maximum_order_amount))
                          {
                             $maximum_order_amount_plus_one = intval($maximum_order_amount);
                             $data['message']        =   'Coupon cannot be applied as maximum order amount not met. Order total must be smaller than '.$maximum_order_amount_plus_one;
                          }
                          else  if($included_order_total < intval($minimum_order_amount))
                          {
                            $minimum_order_amount_minus_one = intval($minimum_order_amount) - 1;
                            $data['message']        =   'Coupon cannot be applied as minimum order amount not met. Order total must be greater than '.$minimum_order_amount_minus_one;
                          }
           


         	                $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                         
                          $data['data']      =   []; 
                          $data['discount']      =   0;   
                          return $data;
         }
           


if($coupon_details->type == 'cash')
{
         $discount = $coupon_details->discount;
         $max_discount = $coupon_details->max_discount;
        if($max_discount > 0)
         {

             $discount_on_order_amount = $discount / 100 * $included_order_total;
 
         if($discount_on_order_amount > $max_discount or $max_discount == $discount_on_order_amount)
         {
                       $discount_on_order_amount = $max_discount;
         }

          else
         {
                       $discount_on_order_amount = $discount_on_order_amount;
         }
       }
       else
       {
        $discount_on_order_amount = $discount;
       }
              if(floatval($discount_on_order_amount) < 0)
              {
                  $discount_on_order_amount = 0;
              }
    
               $final_order_total = $included_order_total - $discount_on_order_amount;
          $darr= array();
          $d['Discount'] = $discount_on_order_amount;
          $d['final_order_total'] = $final_order_total;
          $darr[] = $d;

          $currency_symbol = @\App\Setting::where('key_title','currency_symbol')->first(['key_value'])->key_value;

          $data['status_code']    =   1;
          $data['status_text']    =   'Success';             
          $data['message']        =   'Discount of '.$currency_symbol.''.$discount_on_order_amount.' Applied';
          //  $data['data']      =   $darr;  
          $data['discount']      =   $discount_on_order_amount;  
          return $data;



  }


else if($coupon_details->type == 'points')
{
         $discount = $coupon_details->discount;
         $max_discount = $coupon_details->max_discount;
        if($max_discount > 0)
         {

           $discount_on_order_amount = $discount / 100 * $included_order_total;

 
         if($discount_on_order_amount > $max_discount or $max_discount == $discount_on_order_amount)
         {
                      $discount_on_order_amount = $max_discount;
         }

          else
         {
                      $discount_on_order_amount = $discount;
         }
       }
       else
       {
        $discount_on_order_amount = $discount;
       }

         // $final_order_total = $included_order_total - $discount_on_order_amount;
          $darr= array();
          $d['Discount'] = $discount_on_order_amount;
          $d['final_order_total'] = $included_order_total;
          $darr[] = $d;



 
                     $promotion_loyalty_points_expiry_day_count = @\App\Setting::where('key_title','promotion_loyalty_points_expiry_day_count')->first(['key_value'])->key_value;
                     if($promotion_loyalty_points_expiry_day_count > 0)
                      {
                         $today = @\Carbon\Carbon::now();
                         $expiry_date = $today->addDays($promotion_loyalty_points_expiry_day_count);
                      }
                      else
                      {
                        $expiry_date = '';
                      }
                  



                    $LoyaltyPoints = new \App\LoyaltyPoints;
                    $LoyaltyPoints->user_id = $this->validate_string(@$request['customer_id']);
                    $LoyaltyPoints->points = $discount_on_order_amount;
                    $LoyaltyPoints->expiry_date = $this->validate_string($expiry_date);
                    $LoyaltyPoints->type = 'promotion';
                    $LoyaltyPoints->source = $this->validate_string($request['sourcedddddddddddddd']);
                    $LoyaltyPoints->save();


if(intval($discount_on_order_amount) < 1)
{
  $message = 'No Loyalty Points are available';
}
else
{
  

  if($discount_on_order_amount > 0)
  {
      $message = $discount_on_order_amount.' Loyalty Points are Credited';
  }
  else
  {
      $message = 'No Loyalty Points are Credited';
  }


}

          $data['status_code']    =   1;
          $data['status_text']    =   'Success';             
          $data['message']        =   $message;
          $data['loyalty_point_id']        =   @$LoyaltyPoints->id;
          // $data['data']      =   $darr;  
          $data['discount']      =   0;
          return $data;
  }


else
{


          $data['status_code']    =   0;
          $data['status_text']    =   'Failed';             
          $data['message']        =   'Invalid Coupon , Type not defined';
          // $data['data']      =   $darr;  
          $data['discount']      =   [];  
          return $data;
 }



 


  
         



   }
   
   
   


//Route-5.6 ===================================================================

public function destroy($id)
{

                          @\App\Coupons::where('coupon_id',$id)->delete();

                          $data['status_code']    =   0;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Coupon Deleted Successfully';
                          $data['data']      =   []; 
                          return $data;
}












   
   
//==========================================================================misc functions===================================================================//   
//check item existence by id
public function model_exist($id)
{
	$count = @\App\Coupons::where('coupon_id',$id)->count();
	if($count < 1) {
		return 0;
	}
	else{
		return 1;
	}
}	



//validate all the request variables if they are null or empty , it will return values
public function validate_datetime($var)
{
	 if(!isset($var) or $var == null or $var == '' or $var == ' ')
	 {
	 	 $date = @\Carbon\Carbon::now();
	 	 $date = @\Carbon\Carbon::parse($date);
		 return $this->add_days($date , '7' , 'Y-m-d h:i:s');
	 }
	 else{
		 return $var;
	 }
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
      
  
   public function get_variable_status()
{
	 if(isset($_GET['status']) && $_GET['status'] != null && $_GET['status'] != '')
					{ $status = $_GET['status']; }
					else 
					{ $status = 'true'; }
    return $status;
}




   public function get_variable_type($type)
{
   if( $type != null && $type != '')
          { $type2 = $type; }
          else 
          { $type2 = 'cash'; }
    return $type2;
}




   public function get_variable_include_expired()
{
	 if(isset($_GET['include_expired']) && $_GET['include_expired'] != null && $_GET['include_expired'] != '')
					{ $include_expired = $_GET['include_expired']; }
					else 
					{ $include_expired = 'false'; }
    return $include_expired;
}

   public function get_variable_include_consumed()
{
	 if(isset($_GET['include_consumed']) && $_GET['include_consumed'] != null && $_GET['include_consumed'] != '')
					{ $include_consumed = $_GET['include_consumed']; }
					else 
					{ $include_consumed = 'false'; }
    return $include_consumed;
}





   




   public function get_variable_expiry($request)
{
   if(  $request['expiry'] != null && $request['expiry'] != '')
          { $expiry = $request['expiry']; }
          else 
          { $expiry = \Carbon\Carbon::now()->addYears(19); }
    return $expiry;
}



   public function get_variable_valid_from($request)
{
   if(  $request['valid_from'] != null && $request['valid_from'] != '')
          { $valid_from = $request['valid_from']; }
          else 
          { $valid_from = \Carbon\Carbon::now(); }
    return $valid_from;
}


   public function get_variable_store_id()
{
   if(isset($_GET['store_id']) && $_GET['store_id'] != null && $_GET['store_id'] != '')
          { $store_id = $_GET['store_id']; }
          else 
          { $store_id = ''; }
    return $store_id;
}
 
 
 ///================================ function to check GET variable's and Defaults Ends ====================================================//
 
 
 
 
 
  
 
 
 
 
	
	
	public function paginateWithoutKey($items, $perPage = 15, $page = null, $options = [])
    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        $lap = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

        return [
            'current_page' => $lap->currentPage(),
            'data' => $lap ->values(),
            'first_page_url' => $lap ->url(1),
            'from' => $lap->firstItem(),
            'last_page' => $lap->lastPage(),
            'last_page_url' => $lap->url($lap->lastPage()),
            'next_page_url' => $lap->nextPageUrl(),
            'per_page' => $lap->perPage(),
            'prev_page_url' => $lap->previousPageUrl(),
            'to' => $lap->lastItem(),
            'total' => $lap->total(),
        ];
    }
	
	
	
	 public function paginate($items, $perPage = 15, $page = null, $options = [])
{
	$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
	$items = $items instanceof \Collection ? $items : Collection::make($items);
	return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
}
	 
	 	public function add_trades_feedback(Request $request)
{
	 
        $validator = Validator::make($request->all(), [
           
	 
        ]);
        if ($validator->errors()->all())
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';
            $data['message']        =   $validator->errors()->first();
        }
        else
        {
        
		
			$trade_id = $request->trade_id;
		    $user_id = $request->user_id;
			$feedback = $request->feedback;
			$ratings = $request->ratings;
		  
		  
		    $order_seller_id = @\App\Trades::where('id',$request->trade_id)->first(['seller_id'])->seller_id;
			$order_buyer_id = @\App\Trades::where('id',$request->trade_id)->first(['buyer_id'])->buyer_id;
			
			if($user_id == $order_seller_id)
			{
				 
				 \App\Trades::where('id',$request->trade_id)->update([ 'seller_ratings' => $ratings , 'seller_feedback' => $feedback]);
			}
			
		 
			if($user_id == $order_buyer_id)
			{
				 
				 \App\Trades::where('id',$request->trade_id)->update([ 'buyer_ratings' => $ratings , 'buyer_feedback' => $feedback]);
			}
		  
 
		
 
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';
            $data['message']        =   'Submitted successfully';

        }
        return $data;
    }
	
	
	
	
 
 
	
 
	

    
 
   public function make_thumb($src, $dest, $desired_width) 
   {

    /* read the source image */
    $source_image = imagecreatefromjpeg($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    
    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));
    
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    
    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
    
    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $dest);
    }

    /**
     * @author Dikshant
     * set user language by default
     */
 
 
 


}