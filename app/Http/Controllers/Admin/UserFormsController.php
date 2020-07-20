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
 
 


class UserFormsController extends Controller 
{
	
use one_signal; // <-- ...and also this line.
use bitcoin_price; // <-- ...and also this line.
use trait_functions; // <-- ...and also this line.
 
   
   


 
   public function get_add_form()
   {

   	//user types filters ==========================================
    $auth_user_id = $this->get_auth_user_id();
    $user_type = $this->get_auth_user_type();

    $get_user_type = $_GET['user_type'];
 
  
      $main_array = array();
	  
	  // 1. Basic Informations
	  $data_array1['title'] = 'Basic Information';
	  $data_array1['type'] = 'basic';
 	 
 	  $fields_array = array();

 	   $fields_keys0["title"] = "Image";
	  $fields_keys0["type"] = 'file';
	  $fields_keys0["identifier"] = 'photo';
	  $fields_keys0["value"] = '';
	  $fields_keys0["limit"] = '1';
      $fields_array[] = $fields_keys0;




	  $fields_keys1["title"] = "First Name";
	  $fields_keys1["type"] = 'text';
	  $fields_keys1["identifier"] = 'first_name';
	  $fields_keys1["value"] = '';
      $fields_array[] = $fields_keys1;
	  
 	  $fields_keys2["title"] = "Last Name";
	  $fields_keys2["type"] = 'text';
      $fields_keys2["identifier"] = 'last_name';
      $fields_keys2["value"] = '';
	  $fields_array[] = $fields_keys2;

 
	  $fields_keys3["title"] = "Email";
	  $fields_keys3["type"] = 'email';
	  $fields_keys3["identifier"] = 'email';
      $fields_keys3["value"] = '';
      $fields_array[] = $fields_keys3;


      $fields_keys4["title"] = "Phone";
	  $fields_keys4["type"] = 'text';
      $fields_keys4["identifier"] = 'phone';
      $fields_keys4["value"] = '';
	  $fields_array[] = $fields_keys4;


	  $fields_keys5["title"] = "Password";
	  $fields_keys5["type"] = 'password';
      $fields_keys5["identifier"] = 'password';
      $fields_keys5["value"] = '';
	  $fields_array[] = $fields_keys5;


	  $fields_keys6["title"] = "User Type";
	  $fields_keys6["type"] = 'hidden';
      $fields_keys6["identifier"] = 'user_type';
      $fields_keys6["value"] = '';
      $fields_array[] = $fields_keys6;

 

if($get_user_type == '5' || $get_user_type == '4')
{

if($user_type == '1' || $user_type == '3' || $user_type == '4')
{
	    $type ='api';
	    $value = '';

	    if($user_type == '3')
		{
		  $value = $auth_user_id;
		  $type = 'hidden'; 
		}

		 if($user_type == '4')
		{
         $value = @\App\Store::where('manager_id',$auth_user_id)->first(['vendor_id'])->vendor_id;
         $type = 'hidden'; 
		}

      $fields_keys8["title"] = "Vendor";
	  $fields_keys8["type"] = $type;
      $fields_keys8["options"] = '';
	  $fields_keys8["identifier"] = 'vendor_id';
      $fields_keys8["value"] = $value;
	  $fields_array[] = $fields_keys8;
}
}





if($get_user_type == '5')
{

if($user_type == '1' || $user_type == '3' || $user_type == '4')
{
	    $type ='api';
	    $value = '';

	    if($user_type == '3')
		{
		  $value = '';
		  $type = 'api'; 
		}

		 if($user_type == '4')
		{
         $value = @\App\Store::where('manager_id',$auth_user_id)->first(['store_id'])->store_id;
         $type = 'hidden'; 
		}

      $fields_keys88["title"] = "Store";
	  $fields_keys88["type"] = $type;
      $fields_keys88["options"] = '';
	  $fields_keys88["identifier"] = 'store_id';
      $fields_keys88["value"] = $value;
	  $fields_array[] = $fields_keys88;
}
}






 


 if($user_type == '1' && $get_user_type == '5')
 {
      $fields_keys10["title"] = "Commission";
	  $fields_keys10["type"] = 'text';
      $fields_keys10["identifier"] = 'commission';
      $fields_keys10["value"] = '';
      $fields_array[] = $fields_keys10;
  }




      
      
      $data_array1['fields'] = $fields_array;
	  $main_array[] =$data_array1;

	  
	  // 2. Meta Informations ==============
	  $data_array2['title'] = 'Additional Informations';
	  $data_array2['type'] = 'meta';

	  $user_meta_types = @\App\UserMetaType::where('user_type',$_GET['user_type'])->get();
      $meta_fields_array = array();
	  foreach($user_meta_types as $meta_type)
	  {
	 	 $meta_data["title"] = $meta_type->title;
         $meta_data["type"] =  $meta_type->type;
	 	 $meta_data["identifier"] =  $meta_type->identifier;
	 	 $meta_data["value"] = '';
	 	 $meta_data["field_options"] = json_decode($meta_type->field_options);
	 	 $meta_data["limit"] = $meta_type->count_limit;
	 	 $meta_data["user_type"] = $meta_type->user_type;
      	 $meta_fields_array[] = $meta_data;
	  }
 	 
 	  $data_array2['fields'] = $meta_fields_array;
	  $main_array[] =$data_array2;

      $result = $main_array;

      return $result;
       //return view('admin.items.item_add', compact('result'));
  }
  

   //get_item_meta_value($item_id , $item_meta_type_id)


//check user existence by id
public function model_exist($id)
{
	$count = @\App\User::where('user_id',$id)->count();
	if($count < 1) {
		return 0;
	}
	else{
		return 1;
	}
}	



 
   public function get_edit_form($id)
   {
   	//user types filters ==========================================
    $auth_user_id = $this->get_auth_user_id();
    $user_type = $this->get_auth_user_type();
    $get_user_type = @$_GET['user_type'];

   	$main_array = array();
	  
	               //check existance of item with ID in items table
					$exist = $this->model_exist($id);	
                    if($exist == 0 or $exist == '0')
                    {
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'User with this ID does not exist';
                          $data['data']      =   [];
                          return $data;						  
					}

	  $user_details = @\App\User::where('user_id',@$id)->first();
	  // 1. Basic Informations
	  $data_array1['title'] = 'Basic Information';
	  $data_array1['type'] = 'basic';
 	 

 	  $fields_array = array();

 	  	   $fields_keys0["title"] = "Image";
	  $fields_keys0["type"] = 'file';
	  $fields_keys0["identifier"] = 'photo';
	  $fields_keys0["value"] = $user_details->photo;
	  $fields_keys0["limit"] = '1';
      $fields_array[] = $fields_keys0;



	  $fields_keys1["title"] = "First Name";
	  $fields_keys1["type"] = 'text';
	  $fields_keys1["identifier"] = 'first_name';
	  $fields_keys1["value"] = $user_details->first_name;
      $fields_array[] = $fields_keys1;

 

      $fields_keys2["title"] = "Last Name";
	  $fields_keys2["type"] = 'text';
	  $fields_keys2["identifier"] = 'last_name';
	  $fields_keys2["value"] = $user_details->last_name;
      $fields_array[] = $fields_keys2;

  
	  
	  $fields_keys3["title"] = "Email";
	  $fields_keys3["type"] = 'email';
	  $fields_keys3["identifier"] = 'email';
      $fields_keys3["value"] = $user_details->email;
      $fields_array[] = $fields_keys3;

 

      $fields_keys4["title"] = "Phone";
	  $fields_keys4["type"] = 'text';
      $fields_keys4["identifier"] = 'phone';
      $fields_keys4["value"] = $user_details->phone;
	  $fields_array[] = $fields_keys4;

 
 
	  $fields_keys6["title"] = "User Type";
	  $fields_keys6["type"] = 'hidden';
      $fields_keys6["identifier"] = 'user_type';
      $fields_keys6["value"] = $user_details->user_type;
      $fields_array[] = $fields_keys6;
 

 if($user_type == '1' && $get_user_type == '5')
 {
      $fields_keys10["title"] = "Commission";
	  $fields_keys10["type"] = 'text';
      $fields_keys10["identifier"] = 'commission';
      $fields_keys10["value"] =  $user_details->commission;
      $fields_array[] = $fields_keys10;
  }



if($get_user_type == '5' || $get_user_type == '4' || $get_user_type == '2')
{
 	 
if($user_type == '1' || $user_type == '3' || $user_type == '4' || $user_type == '2')
{


 

 	    $type ='api';
	    $value = '';

	    if($user_type == '3' || $user_type =='2')
		{
		  $value = $auth_user_id;
		  $type = 'api'; 
		}

		 if($user_type == '4')
		{
         $value = @\App\Store::where('manager_id',$auth_user_id)->first(['vendor_id'])->vendor_id;
         $type = 'hidden'; 
		}

     	 $fields_keys8["title"] = "Vendor";
	 	 $fields_keys8["type"] = $type;
     	 $fields_keys8["options"] = '';
	 	 $fields_keys8["identifier"] = 'vendor_id';
     	 $fields_keys8["value"] =$user_details->vendor_id;

     	 $display_value_details = @\App\User::where('user_id' , $user_details->vendor_id )->get(['first_name','last_name']);
     	 $fields_keys8["display_value"] = @$display_value_details[0]['first_name']." ".@$display_value_details[0]['last_name'];
	 	 $fields_array[] = $fields_keys8;
}
}


 



if($get_user_type == '5')
{

  if($user_type == '1' || $user_type == '3' || $user_type == '4')
  {
	    $type ='api';
	    $value = '';

	    if($user_type == '3')
		{
		  $value = '';
		  $type = 'hidden'; 
		}

		 if($user_type == '4')
		{
         $value = @\App\Store::where('manager_id',$auth_user_id)->first(['store_id'])->store_id;
         $type = 'hidden'; 
		}

      $fields_keys88["title"] = "Store";
	  $fields_keys88["type"] = $type;
      $fields_keys88["options"] = '';
	  $fields_keys88["identifier"] = 'store_id';
      $fields_keys88["value"] = @$user_details->store_id;

      $display_value_details = @\App\Store::where('store_id' , @$user_details->store_id )->get(['store_title']);
      $fields_keys88["display_value"] = @$display_value_details[0]['store_title'];
	  $fields_array[] = $fields_keys88;

       
  }

}







     	 $data_array1['fields'] = $fields_array;
	 	 $main_array[] =$data_array1;


 
	  // 2. Meta Informations ==============
	  $data_array2['title'] = 'Additional Informations';
	  $data_array2['type'] = 'meta';

	  $item_meta_types = @\App\UserMetaType::where('user_type',$_GET['user_type'])->get();
      $meta_fields_array = array();
	  foreach($item_meta_types as $meta_type)
	  {
	  	 $meta_type->user_meta_type_id;
	 	 $meta_data["title"] = $meta_type->title;
	 	 $meta_data["type"] =  $meta_type->type;
	 	 $meta_data["identifier"] =  $meta_type->identifier;
	 	 $meta_data["value"] = $this->get_user_meta_value(@$id , @$meta_type->user_meta_type_id);
	 	 $meta_data["limit"] = $meta_type->count_limit;
	 	 $meta_data["field_options"] = json_decode($meta_type->field_options);
      	 $meta_fields_array[] = $meta_data;
	  }


 	 
 	  $data_array2['fields'] = $meta_fields_array;
	  $main_array[] =$data_array2;
      $result = $main_array;

      return $result;
       //return view('admin.items.item_edit', compact('result'));
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