<?php
namespace App\Traits;
use App;
use App\Setting;
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
use Illuminate\Support\Arr;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Hash;
use Mail;
use File;



trait trait_functions
{
    protected function trait_functions($name)
    {
        return $name;
    }
	
	
	public function get_currency_symbol()
	{
		return App\Setting::where('key_title','currency_symbol')->first(['key_value'])->key_value;
	}

public function get_default($var , $default)
{
   if(!isset($_GET[$var]) or $_GET[$var] == null or $_GET[$var] == '' or $_GET[$var] == ' ')
   {   return $default;  }
   else{  return $_GET[$var];  }
}

 

//validate all the request variables if they are null or empty , it will return values
public function validate_string($var)
{
	 if(!isset($var) or $var == null or $var == '' or $var == ' ')
	 {   return '';  }
	 else{  return $var;  }
}

//validate all the request variables if they are null or empty , it will return values
public function validate_integer($var)
{
	 if(!isset($var) or $var == null or $var == '' or $var == ' ')
	 { return '0';  }
	 else{  return $var; }
}




public function validate_integer_return_one($var)
{
   if(!isset($var) or $var == null or $var == '' or $var == ' ')
   { return '1';  }
   else{  return $var; }
}


//validate all the request variables if they are null or empty , it will return values
public function validate_boolean($var)
{
	 if(!isset($var) or $var == null or $var == '' or $var == ' ')
	 { return 'true';  }
	 else{  return $var; }
}



//some get functions
 public function get_categories_options()
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
				
	    $item_categories = @\App\SettingCategories::where('app_type',$auth_app_type)->get();
     
        $categories_array = array();
    	foreach($item_categories as $category)
    	{
    		$category_details = @\App\SettingCategories::where('category_id',$category->category_id)->get();
    		$data['value'] = @$category->category_id;
    		$data['label'] = @$category_details[0]['category_title'];
    		$categories_array[] = $data;
    	}
    	return $categories_array;
     
}


//some get functions
 public function get_item_meta_value($item_id , $item_meta_type_id)
{
	$value = @\App\ItemMetaValue::where('item_meta_type_id',$item_meta_type_id)->where('item_id',$item_id)->first(['value'])->value;
    if($value == null or $value == 'null') { $value = '';}
    return $value; 
 }	


 
 public function get_item_variant_value($item_id , $item_variant_type_id)
{
  $value = @\App\ItemVariantValue::where('item_variant_type_id',$item_variant_type_id)->where('item_id',$item_id)->get();
    if($value == null or $value == 'null') { $value = '';}
    return $value; 
 }  





 public function get_user_meta_value($user_id , $user_meta_type_id)
{
 

  $value = @\App\UserMetaValue::where('user_meta_type_id',$user_meta_type_id)->where('user_id',$user_id)->first(['value'])->value;
    if($value == null or $value == 'null') { $value = '';}
    return $value; 
 }  


  public function get_store_meta_value($store_id , $store_meta_type_id)
{
   
 
  $value = @\App\StoreMetaValue::where('store_meta_type_id',$store_meta_type_id)->where('store_id',$store_id)->first(['value'])->value;
    if($value == null or $value == 'null') { $value = '';}
    return $value; 
 }  







	//check existence functions =====================================================

 public function item_exist($id)
{
	$count = @\App\Items::where('item_id',$id)->count();
	if($count < 1) {
		return 0;
	}
	else{
		return 1;
	}
}	
 


 // datetime function =================================

public function add_days($date , $days , $format)
{
	$date = $date->addDays($days);
	$date = $date->format($format);
	return $date;
}
 
 





//================================================ COUPONS FUNCTIONS STARTS ============================================================//
//======================================================================================================================================//


//coupons Helper Functions=====================================================================
public function filter_included_items($items , $coupon_code)
{
	     $count = @\App\Coupons::where('coupon_code',$coupon_code)->count();
	     if($count < 1)
	     {
	     	return [];
	     }
	     $coupon_details = @\App\Coupons::where('coupon_code',$coupon_code)->first();

         $items_included = $coupon_details->items_included;
         $items_included_array = explode(',' , $items_included);



         //loopover items to filter
         $filtered_included_items = array();
         
         for($r=0;$r<sizeof($items);$r++)
         {
         	$item_id = $items[$r]['item_id'];

             if (in_array($item_id, $items_included_array))
            {
                   $filtered_included_items[] = $items[$r];
            }
 
         }
         return $filtered_included_items;

}

public function add_variant_price_to_order_items($items)
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
				
				
   for($i=0; $i < sizeof($items) ; $i++)
    {
        $variants = @$items[$i]['variants'];
     
        $item_id = $items[$i]['item_id'];
        $item_quantity = $items[$i]['quantity'];
        $item_price = strval(@\App\Items::where('item_id',$item_id)->where('app_type',$auth_app_type)->first(['item_price'])->item_price);

    
      	$price_difference = 0;





if($variants != '' && sizeof($variants) > 0)
{
       	for($v=0;$v<sizeof($variants);$v++)
       	{
               $item_variant_value_id = $variants[$v]['item_variant_value_id'];
               $item_variant_details = @\App\ItemVariantValue::where('item_variant_value_id',$item_variant_value_id)->get(['item_variant_price','item_variant_price_difference']);
               $item_variant_price = $item_variant_details[0]['item_variant_price'];
               $item_variant_price_difference = $item_variant_details[0]['item_variant_price_difference'];
            
             if($item_variant_price != 0 && $item_variant_price != '0' &&   $item_variant_price != '' && $item_variant_price != null)
              {
                  $item_price = $item_variant_price;
              	  $type = 'item_variant_price';
              }
        }
 }



   if($variants != '' && sizeof($variants) > 0)
{
    
        for($v=0;$v<sizeof($variants);$v++)
       	{
               $item_variant_value_id = $variants[$v]['item_variant_value_id'];
               $item_variant_details = @\App\ItemVariantValue::where('item_variant_value_id',$item_variant_value_id)->get(['item_variant_price','item_variant_price_difference']);
               $item_variant_price = $item_variant_details[0]['item_variant_price'];
               $item_variant_price_difference = $item_variant_details[0]['item_variant_price_difference'];
            
             if($item_variant_price == 0 || $item_variant_price == '0')
              {
 
              	  $item_price = $item_price + $item_variant_price_difference;
              }
        }
 }
 
       $item_price = $item_price * $item_quantity;

       $items[$i]['item_price'] = strval($item_price);
     
     }

     return $items;
}


public function total_order_amount_from_items($items)
{
     $total = 0;
     for($i=0; $i < sizeof($items) ; $i++)
     {
        $total = $total + floatval($items[$i]['item_price']);
     }
     return $total;
}



















public function coupon_code_exist($coupon_code)
   {
	   
	   	        $auth_user_id = $this->get_auth_user_id();
			    $auth_user_type = $this->get_auth_user_type();
			    $auth_app_type = $this->get_auth_app_type();
			    
			    if($auth_app_type == 'laundry' || $auth_app_type == 'grocery' || $auth_app_type == 'courier' || $auth_app_type == 'mechanic') {} 
			    else {  
			          return 0;
			    }
				
				
      $count = @\App\Coupons::where('coupon_code',$coupon_code)->where('app_type',$auth_app_type)->count();
      if($count > 0)
      { return 1;  }
      else  { return 0;  }
   }


public function exist_between_validfrom_expiry($coupon_code)
{
	
	     $auth_user_id = $this->get_auth_user_id();
			    $auth_user_type = $this->get_auth_user_type();
			    $auth_app_type = $this->get_auth_app_type();
			    
			    if($auth_app_type == 'laundry' || $auth_app_type == 'grocery' || $auth_app_type == 'courier' || $auth_app_type == 'mechanic') {} 
			    else {  
			          return 0;
			    }
				
				
	$exist_between_validfrom_expiry =   @\App\Coupons::where('coupon_code',$coupon_code)->whereDate('valid_from', '<=', date("Y-m-d"))->whereDate('expiry', '>=', date("Y-m-d"))
            ->count();

            if($exist_between_validfrom_expiry > 0)
            	{ return 1;}else { return 0;}
}



public function order_amount_is_in_range($coupon_code , $amount)
{
	$minimum_order_amount =   @\App\Coupons::where('coupon_code',$coupon_code)->first(['minimum_order_amount'])->minimum_order_amount;
	$maximum_order_amount =   @\App\Coupons::where('coupon_code',$coupon_code)->first(['maximum_order_amount'])->maximum_order_amount;
 
            if($minimum_order_amount < $amount && $maximum_order_amount > $amount )
            {
                 return 1;
             }
             else
             {
                 return 0;
             }
}


public function check_coupon_expired($coupon_code)
{
	$exist_between_validfrom_expiry =   @\App\Coupons::where('coupon_code',$coupon_code)->whereDate('expiry', '>=', date("Y-m-d"))
            ->count();

            if($exist_between_validfrom_expiry > 0)
            	{ return 1;}else { return 0;}
}




public function check_limit_user($coupon_code , $limit_user)
{

	return 1;
  
}

public function check_limit_total($coupon_code , $limit_total)
{

	return 1;
  
}

















// ================================================== Orders Functions ======================================================//

public function get_order_meta_value(Request $request , $order_id , $identifier)
{
	
	
	            $auth_user_id = $this->get_auth_user_id();
			    $auth_user_type = $this->get_auth_user_type();
			    $auth_app_type = $this->get_auth_app_type();
			    
			    if($auth_app_type == 'laundry' || $auth_app_type == 'grocery' || $auth_app_type == 'courier' || $auth_app_type == 'mechanic') {} 
			    else {  
			          return '';
			    }
				
				
  $setting_order_meta_type_id = @\App\SettingOrderMetaType::where('identifier',$identifier)->where('app_type',$auth_app_type)->first(['setting_order_meta_type_id'])->setting_order_meta_type_id;

  $order_meta_value = @\App\OrderMetaValue::where('order_id',$order_id)->where('setting_order_meta_type_id',$setting_order_meta_type_id)->first(['order_meta_value_text'])->order_meta_value_text;
return $order_meta_value;
}



public function get_setting_order_meta_type_id(Request $request , $identifier)
{
	            $auth_user_id = $this->get_auth_user_id();
			    $auth_user_type = $this->get_auth_user_type();
			    $auth_app_type = $this->get_auth_app_type();
				
  $setting_order_meta_type_id = @\App\SettingOrderMetaType::where('identifier',$identifier)->where('app_type',$auth_app_type)->first(['setting_order_meta_type_id'])->setting_order_meta_type_id;
  return $this->validate_string($setting_order_meta_type_id);
}




public function get_auth_user_id()
{
    $user_id = Auth::id(); 
     

    if($user_id == null || $user_id == '' || $user_id == ' ')
    {
       if(isset($_GET['auth_user_id']) && $_GET['auth_user_id'] != '')
       {
        $user_id = $_GET['auth_user_id'];
       }
     }

       if($user_id == null || $user_id == '' || $user_id == ' ')
    {
      return '0';
    }

    return $user_id;
 
}

public function get_auth_user_type()
{
    $user_id = Auth::id(); 
     

    if($user_id == null || $user_id == '' || $user_id == ' ')
    {
       if(isset($_GET['auth_user_id']) && $_GET['auth_user_id'] != '')
       {
        $user_id = $_GET['auth_user_id'];
       }
     }

       if($user_id == null || $user_id == '' || $user_id == ' ')
    {
      return '0';
    }

    $user_type = @\App\User::where('user_id',$user_id)->first(['user_type'])->user_type;
    return $user_type;
 
}


public function get_auth_app_type()
{

   if(isset($_GET['auth_app_type']) && $_GET['auth_app_type'] != '')
   {
     return $_GET['auth_app_type'];
   }


    $auth_user_id = $this->get_auth_user_id();
    $auth_app_type = @\App\User::where('user_id' , $auth_user_id)->first(['app_type'])->app_type;
    if($auth_app_type == null || $auth_app_type == '' || $auth_app_type == ' ')
    {
      return '';
    }
    else
    {
      return $auth_app_type;
    }
    return $auth_app_type;
}












}