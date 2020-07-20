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
 
 


class AreasController extends Controller 
{
	
use one_signal; // <-- ...and also this line.
use bitcoin_price; // <-- ...and also this line.
use trait_functions; // <-- ...and also this line. 
   
   
   
   
   
 // Route-8.1 ============================================================== Store Item to Items table =========================================> 
   public function store(Request $request)
   {
                $validator = Validator::make($request->all(), [
					//'title' => 'required|unique:posts|max:255',
				//	'title' => 'required',
			      ]);
	   
				if($validator->errors()->all()) 
                {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   $validator->errors()->first();
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




					$area = new App\Areas;
					$area->title = $this->validate_string($request->title);
				    $area->latitude = $this->validate_string($request->latitude);
				    $area->longitude = $this->validate_string($request->longitude);
				    $area->pincode = $this->validate_string($request->pincode);
				    $area->parent_id = $this->validate_integer($request->parent_id);
				    $area->app_type = $this->validate_string($auth_app_type);
				    $area->location_id = $this->validate_integer($request->location_id);
			        $area->save();
					
				    if($area != '')
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Area Added Successfully';
                          $data['data']      =   $area;  
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
   

   
  
  // Route-8.2 ============================================================== Get Categories List =========================================> 
   public function get_list()
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


	   
        $per_page = $this->get_variable_per_page(); //ASC or DESC
		$orderby = $this->get_variable_orderby();
		$order = $this->get_variable_order();
		$search = $this->get_variable_search();

		$parent_id = $this->get_variable_parent_id();
		$parents_only = $this->get_variable_parents_only();
		$location_id = $this->get_variable_location_id();
	 
		
	   	$model = new \App\Areas;
	   	$model = $model::where('area_id' ,'<>', '0');  
	    $model = $model->where('app_type' , $auth_app_type)->where('area_id' ,'<>', '0');  


	    if($parent_id != '' && $parent_id != null)
		{   $model = $model->where('parent_id' , $parent_id);  }


		if($location_id != '' && $location_id != null)
		{   $model = $model->where('location_id' , $location_id);  }	

	 

	 	    if($parents_only != '' && $parents_only != null)
		{   $model = $model->where('parent_id' , '0');  }	

	 
	  
	

        
	    if($search != '' && $search != null)
		{  $model = $model->where(function($q) use ($search) { $q->where( DB::raw("CONCAT(title)"),'like', '%'.$search.'%'); });  }
      		$model = $model->orderBy($orderby,$order);
	   
        $result = $model->paginate($per_page);
	   
	              if(sizeof($result) > 0)
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Areas List Fetched Successfully';
                          $data['data']      =   $result;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'No Areas Found';
                          $data['data']      =   [];  
					}
				   return $data;
   }  



  // Route-8.3 ============================================================== Get Items List =========================================> 
   public function update(Request $request , $id)
   {
	   
					$validator = Validator::make($request->all(), [
					//'title' => 'required|unique:posts|max:255',
				//	'title' => 'required',
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
				    
					$title =$request->title;
	                $parent_id = $this->validate_integer($request->parent_id);
				 
	                App\Areas::where('area_id', $id)->update([
                           'title' => $this->validate_string($request->title),
				    		'latitude' => $this->validate_string($request->latitude),
				    		'longitude' => $this->validate_string($request->longitude),
				    		'pincode' => $this->validate_string($request->pincode),
				    		'parent_id' => $this->validate_integer($request->parent_id),
				   			'location_id' => $this->validate_integer($request->location_id)
	                ]);
	               
				    $result = @\App\Areas::where('area_id',$id)->get();
			 			
	                if(sizeof($result) > 0)
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Area Updated Successfully';
                          $data['data']      =   $result;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to Area';
                          $data['data']      =   [];  
					}
				   return $data;
   }  


   
 
  // Route-8.4 ============================================================== Get Items List =========================================> 
  
   public function destroy($id)
   {
   	 
   	         //check existance of item with ID in items table
				 	$exist = $this->model_exist($id);	
                    if($exist == 0 or $exist == '0')
                    {
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Area with this ID does not exist';
                          $data['data']      =   [];
                          return $data;						  
					}

                    @\App\Areas::where('area_id',$id)->delete();
                    @\App\Areas::where('parent_id', $id )->update(['parent_id' => '0']);
 

   	 	                  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Area Deleted Successfully';
                          $data['data']      =   [];  
                          return $data;
   }






 
 
  




  //Route-8.5 ============================================================= Get Areas Nearest to Get Latitude and Longitude
     public function get_list_nearby()
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


   	$latitude = $_GET['latitude'];
   	$longitude = $_GET['longitude'];
   	$distance_limit =  $_GET['distance_limit'];

if(isset($_GET['distance_limit']) && $_GET['distance_limit'] != '' && $_GET['distance_limit'] != null)
{
}
else { $distance_limit = 5000; }
 

		$d = DB::table("areas")
 
	->select("*" , "areas.area_id"
		,DB::raw("6371 * acos(cos(radians(" . $latitude . ")) 
		* cos(radians(areas.latitude)) 
		* cos(radians(areas.longitude) - radians(" . $longitude . ")) 
		+ sin(radians(" .$latitude. ")) 
		* sin(radians(areas.latitude))) AS distance"))
		->groupBy("areas.area_id")
		->where('app_type' , $auth_app_type)->take(1)->get();





$d = $result = json_decode($d, true);
$distance = intval($d[0]['distance']);


if($distance > $distance_limit  )
{
	 					  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to find any area in this distance_limit';
                          $data['data']      =   [];  
                          return $data;
}
 else
{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Area Fetched Successfully';
                          $data['data']      =   $d;  
 }
				 
				   return $data;
   }  

 
 
 




 
   
//==========================================================================misc functions===================================================================//   
//check item existence by id
public function model_exist($id)
{
	$count = @\App\Areas::where('area_id',$id)->count();
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


public function get_variable_search()
{
	 if(isset($_GET['search']) && $_GET['search'] != null && $_GET['search'] != '')
					{ $search = $_GET['search']; }
					else 
					{ $search = ''; }
    return $search;
}	
      
   
   public function get_variable_parent_id()
{
	 if(isset($_GET['parent_id']) && $_GET['parent_id'] != null && $_GET['parent_id'] != '')
					{ $parent_id = $_GET['parent_id']; }
					else 
					{ $parent_id = ''; }
    return $parent_id;
}	

   public function get_variable_location_id()
{
	 if(isset($_GET['location_id']) && $_GET['location_id'] != null && $_GET['location_id'] != '')
					{ $location_id = $_GET['location_id']; }
					else 
					{ $location_id = ''; }
    return $location_id;
}	

   public function get_variable_parents_only()
{
	 if(isset($_GET['parents_only']) && $_GET['parents_only'] != null && $_GET['parents_only'] != '')
					{ $parents_only = $_GET['parents_only']; }
					else 
					{ $parents_only = ''; }
    return $parents_only;
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