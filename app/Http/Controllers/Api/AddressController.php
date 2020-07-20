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
 
 


class AddressController extends Controller 
{
	
use one_signal; // <-- ...and also this line.
use bitcoin_price; // <-- ...and also this line.
use trait_functions; // <-- ...and also this line. 
   
   
   
   
   
 // Route-10.1 ============================================================== Store Item to Items table =========================================> 
   public function store(Request $request)
   {
                $validator = Validator::make($request->all(), [
					//'title' => 'required|unique:posts|max:255',
					'address_type' => 'required',
					'address_phone' => 'required',
					'address_line1' => 'required',
					'latitude' => 'required',
					'longitude' => 'required',
					'pincode' => 'required',
					'linked_id' => 'required',
			      ]);
	   
				if($validator->errors()->all()) 
                {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   $validator->errors()->first();
                    return $data;					
                }
			 
			        $address_type = $this->validate_string($request->address_type);//business,customer,order
			        $linked_id = $this->validate_integer($request->linked_id);
			        $address_title = $this->validate_string($request->address_title);
			        $address_phone = $this->validate_string($request->address_phone);
			        $address_line1 = $this->validate_string($request->address_line1);
			        $address_line2 = $this->validate_string($request->address_line2);
			        $latitude = $this->validate_string($request->latitude);
			        $longitude = $this->validate_string($request->longitude);
			        $city = $this->validate_string($request->city);
			        $state = $this->validate_integer($request->state);
			        $pincode = $this->validate_string($request->pincode);
			        $country = $this->validate_string($request->country);
 
 
					$address = new App\Address;
					$address->address_type = $address_type;
			        $address->linked_id = $linked_id;
			        $address->address_title = $address_title;
			        $address->address_phone = $address_phone;
			        $address->address_line1 = $address_line1;
			        $address->address_line2 = $address_line2;
			        $address->latitude = $latitude;
			        $address->longitude = $longitude;
			        $address->city = $city;
			        $address->state = $state;
			        $address->pincode = $pincode;
			        $address->country = $country;
			        $address->save();
                    $address->address_id = $address->id; 
					
				    if($address != '')
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Address Added Successfully';
                          $data['data']      =   $address;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to Add Area';
                          $data['data']      =   [];  
					}
				   
				  return $data;
				 
  }
   

   
  
  // Route-10.2 ============================================================== Get Categories List =========================================> 
   public function get_list()
   {
	   
        $per_page = $this->get_variable_per_page(); //ASC or DESC
		$orderby = $this->get_variable_orderby();
		$order = $this->get_variable_order();
		
		$linked_id = $this->get_variable_linked_id();
		$address_type = $this->get_variable_address_type();


	 
		
	    $model = new \App\Address;
	    $model = $model::where('address_id' ,'<>', '0');  


	    if($linked_id != '' && $linked_id != null)
		{   $model = $model->where('linked_id' , $linked_id);  }

		 if($address_type != '' && $address_type != null)
		{   $model = $model->where('address_type' , $address_type);  }	

	    
		//$model = $model::orderBy('id','desc');
        
	    $result = $model->paginate($per_page);
	   
	              if(sizeof($result) > 0)
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Address List Fetched Successfully';
                          $data['data']      =   $result;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'No Address Found';
                          $data['data']      =   [];  
					}
				   return $data;
   }  



  // Route-10.3 ============================================================== Get Items List =========================================> 
   public function update(Request $request , $id)
   {
	   
					$validator = Validator::make($request->all(), [
					//'title' => 'required|unique:posts|max:255',
						'address_type' => 'required',
					'address_phone' => 'required',
					'address_line1' => 'required',
					'latitude' => 'required',
					'longitude' => 'required',
					'pincode' => 'required',
					'linked_id' => 'required',
					]);
	   
					if($validator->errors()->all()) 
					{
						$data['status_code']    =   0;
						$data['status_text']    =   'Failed';             
						$data['message']        =   $validator->errors()->first();
						return $data;					
					}				
				
	               //check existance of category with ID in categories table
					$exist = $this->model_exist($id);	
                    if($exist == 0 or $exist == '0')
                    {
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Categories with this ID does not exist';
                          $data['data']      =   [];
                          return $data;						  
					}
				    
			 

	                      $address_type = $this->validate_string($request->address_type);//business,customer,order
			        $linked_id = $this->validate_integer($request->linked_id);
			        $address_title = $this->validate_string($request->address_title);
			        $address_phone = $this->validate_string($request->address_phone);
			        $address_line1 = $this->validate_string($request->address_line1);
			        $address_line2 = $this->validate_string($request->address_line2);
			        $latitude = $this->validate_string($request->latitude);
			        $longitude = $this->validate_string($request->longitude);
			        $city = $this->validate_string($request->city);
			        $state = $this->validate_integer($request->state);
			        $pincode = $this->validate_string($request->pincode);
			        $country = $this->validate_string($request->country);
 
 
 


				 
	                App\Address::where('address_id', $id)->update([
                                 'address_type' => $address_type,//business,customer,order
			        			 'linked_id' => $linked_id,
			       				 'address_title' => $address_title,
			       				 'address_phone' => $address_phone,
			       				 'address_line1' => $address_line1,
			       				 'address_line2' => $address_line2,
			       				 'latitude' => $latitude,
			       				 'longitude' => $longitude,
			       				 'city' => $city,
			       				 'state' => $state,
			       			 	 'pincode' => $pincode,
			       				 'country' => $country
	                ]);
	               
				    $result = @\App\Address::where('address_id',$id)->get();
			 			
	                if(sizeof($result) > 0)
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Address Updated Successfully';
                          $data['data']      =   $result;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to Update Address';
                          $data['data']      =   [];  
					}
				   return $data;
   }  


   
 
  // Route-10.4 ============================================================== Delete a Address =========================================> 
   public function destroy(Request $request , $id)
   {
       
      $exist = @\App\Address::where('address_id',$id)->count();

      if($exist < 1)
      {
      	                  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Address Id not found';
                          $data['data']      =   [];  
                          return $data;
     }

     $address_type = @\App\Address::where('address_id',$id)->first(['address_type'])->address_type;

     if($address_type == 'customer')
     {
     	                  $deleted = @\App\Address::where('address_id',$id)->delete();
     	                  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Address Deleted Successfully';
                          $data['data']      =   [];  
                          return $data;
     }
     else
     {

                   
     	                  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'This Address Type cannot be deleted';
                          $data['data']      =   [];  
                          return $data;
     }

   }
 
 
  



 
















 
 
   
//==========================================================================misc functions===================================================================//   
//check item existence by id
public function model_exist($id)
{
	$count = @\App\Address::where('address_id',$id)->count();
	if($count < 1) {
		return 0;
	}
	else{
		return 1;
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


 
      
   
   public function get_variable_linked_id()
{
	 if(isset($_GET['linked_id']) && $_GET['linked_id'] != null && $_GET['linked_id'] != '')
					{ $linked_id = $_GET['linked_id']; }
					else 
					{ $linked_id = ''; }
    return $linked_id;
}	

   public function get_variable_address_type()
{
	 if(isset($_GET['address_type']) && $_GET['address_type'] != null && $_GET['address_type'] != '')
					{ $address_type = $_GET['address_type']; }
					else 
					{ $address_type = ''; }
    return $address_type;
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