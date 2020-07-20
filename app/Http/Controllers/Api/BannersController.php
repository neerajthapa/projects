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
 
 


class BannersController extends Controller 
{
	
use one_signal; // <-- ...and also this line.
use bitcoin_price; // <-- ...and also this line.
use trait_functions; // <-- ...and also this line. 
   
   
   
   
   
 // Route-29.1 ============================================================== Store Item to Items table =========================================> 
   public function store(Request $request)
   {
                $validator = Validator::make($request->all(), [
					//'title' => 'required|unique:posts|max:255',
					'photo' => 'required',

				 
				 
			      ]);


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
				
				
                	if($request->linked_id == '')
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Store Required';
                          $data['data']      =   [];  
                          return $data;
					}


	   
				if($validator->errors()->all()) 
                {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   $validator->errors()->first();
                    return $data;					
                }
			 
					$banners = new \App\Banners;
					$banners->photo = $this->validate_string(@$request->photo);
				    $banners->type = $this->validate_string(@$request->type);
				    $banners->linked_id = $this->validate_integer(@$request->linked_id);
					$banners->app_type = $this->validate_string($auth_app_type);
                    $banners->save();
					
				    if($banners != '')
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Banner Added Successfully';
                          $data['data']      =   $banners;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to Add Banner';
                          $data['data']      =   [];  
					}
				   
				  return $data;
				 
  }
   

   
  
  // Route-29.2 ============================================================== Get Banners List =========================================> 
   public function get_list()
   {
	   
 

		$linked_id = $this->get_variable_linked_id();
		$type = $this->get_variable_type();
		
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
		
	 
		$model = new \App\Banners;
		$model = $model::where('id' ,'<>', '0');  
		$model = $model->where('app_type' , $auth_app_type);  
	   
	     

	 
	       if($type != '' )
	     	{   

		    	 $model = $model->where('type' , $type);  

		    	  if($linked_id != '' )
				     	{ 
				     		$model = $model->where('linked_id' , $linked_id); 
				     	}
			}	
  
        $result = $model->get();
	   
	              if(sizeof($result) > 0)
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Banners List Fetched Successfully';
                          $data['data']      =   $result;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'No Banners Found';
                          $data['data']      =   [];  
					}
				   return $data;
   }  




  // Route-29.3 ============================================================== Get Items List =========================================> 
   public function update(Request $request , $id)
   {
	   
					$validator = Validator::make($request->all(), [
						//'title' => 'required|unique:posts|max:255',
						'photo' => 'required',
				 
					 
					]);
	   
					if($validator->errors()->all()) 
					{
						$data['status_code']    =   0;
						$data['status_text']    =   'Failed';             
						$data['message']        =   $validator->errors()->first();
						return $data;					
					}				
				


                	if($request->linked_id == '')
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Store Required';
                          $data['data']      =   [];  
                          return $data;
					}

					
	                $type = $this->validate_string(@$request->type);
	                $photo = $this->validate_string(@$request->photo);
	                $linked_id = $this->validate_integer(@$request->linked_id);
				 
	                App\Banners::where('id', $id)->update(['type' => @$type ,'photo' => @$photo ,'linked_id' => @$linked_id  ]);
	               
				    $result = @\App\Banners::where('id',$id)->get();
			 			
	                if(sizeof($result) > 0)
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Banner Updated Successfully';
                          $data['data']      =   $result;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to  Update Banner';
                          $data['data']      =   [];  
					}
				   return $data;
   }  


   
 
 
 
 
    // Route-29.4 ========================================================To delete banner =========================================> 
 
  
   public function destroy($id)
   {
   	                      @\App\Banners::where('id',$id)->delete();
			              $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Banner Deleted Successfully';
                          $data['data']      =   [];  
                          return $data;
   }





 
 
 
 
 
   
//==========================================================================misc functions===================================================================//   
//check item existence by id
public function model_exist($id)
{
	$count = @\App\Locations::where('location_id',$id)->count();
	if($count < 1) {
		return 0;
	}
	else{
		return 1;
	}
}	


 
 

///================================ function to check GET variable's and Defaults ====================================================//
 
      
public function get_variable_linked_id()
{
	 if(isset($_GET['linked_id']) && $_GET['linked_id'] != null && $_GET['linked_id'] != '')
					{ $linked_id = $_GET['linked_id']; }
					else 
					{ $linked_id = ''; }
    return $linked_id;
}	

   public function get_variable_type()
{
	 if(isset($_GET['type']) && $_GET['type'] != null && $_GET['type'] != '')
					{ $type = $_GET['type']; }
					else 
					{ $type = ''; }
    return $type;
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