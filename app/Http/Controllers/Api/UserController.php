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
 
 


class UserController extends Controller 
{
	
use one_signal; // <-- ...and also this line.
use bitcoin_price; // <-- ...and also this line.
use trait_functions; // <-- ...and also this line. 
   
   
   
   
 
     //webservice for login request
    public function login(Request $request)
    {   

        $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:4',
 
        ]);
        //return $validator->errors()->all();
        if($validator->errors()->all())
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   $validator->errors()->first();   
            return $data;          
        }
        else
        {   


//custom code
                $userc = @\App\User::where('email',$request->email)->count();
                if($userc < 1)
                {
                    $data['status_code']    =   0;
                $data['status_text']    =   'Failed';             
                $data['message']        =   'login Failed.';
                $data['user_data']      =   [];   
                return $data; 

                }
                else
                {
                $user = @\App\User::where('email',$request->email)->get();
                $data['status_code']    =   1;
                $data['status_text']    =   'Success';             
                $data['message']        =   'You have logged-in successfully.';
                $data['user_data']      =   $user;   
                return $data; 
              }
//custom code ends


  

    if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))  
      {
              $user_type = Auth::user()->user_type;

              if($user_type != '2')
              { 
                $data['status_code']    =   0;
                $data['status_text']    =   'Failed';             
                $data['message']        =   'Invalid User Type';
                $data['user_data']      =   []; 
                return $data;
              }
                $user = Auth::guard('api')->user()->toArray();
 
                $data['status_code']    =   1;
                $data['status_text']    =   'Success';             
                $data['message']        =   'You have logged-in successfully.';
                $data['user_data']      =   $user;        

      
             // $this->notification_to_single($user["notification_token"], 'Login by '.$user["name"] , 'Thank You for Login');
      
            }            
            else
            {
                $data['status_code']    =   0;
                $data['status_text']    =   'Failed';             
                $data['message']        =   'Please enter correct email and password.';

            }
            

        }

        return $data;
    }
  
 

//Route-11.6 ==================================================================
      public function submit_add_form(Request $request)
   {
 
               $basic_form_fields = $request[0]['fields'];
               $meta_form_fields = $request[1]['fields'];

            

               if(sizeof($basic_form_fields) > 0)
                {
                	 for($i=0;$i <sizeof($basic_form_fields);$i++)
                	   {
                	      $data[$basic_form_fields[$i]['identifier']] = @$basic_form_fields[$i]['value'];
                     }
                }

                 if(sizeof($meta_form_fields) > 0)
                 {
                     for($j=0;$j <sizeof($meta_form_fields);$j++)
                	    {
                	     // $key_name = $meta_form_fields[$j]['identifier'];
                       $meta[$meta_form_fields[$j]['identifier']]  = @$meta_form_fields[$j]['value'];
                     }
                  }
                  else
                  {
                    $meta = '';
                  }
                  
                 $data['meta'] = $meta;


                 return $this->store( $request , $data);
  
  }



//Route-11.7 ==================================================================
      public function submit_edit_form(Request $request , $id)
   {

   	    
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
               $basic_form_fields = @$request[0]['fields'];
               $meta_form_fields = @$request[1]['fields'];

      

               if(sizeof($basic_form_fields) > 0)
                {
                	 for($i=0;$i <sizeof($basic_form_fields);$i++)
                	 {
                	      $data[$basic_form_fields[$i]['identifier']] = @$basic_form_fields[$i]['value'];
                     }
                  
                	  
                }
                $meta_data2 ='';

                if(sizeof($meta_form_fields) > 0 )
                {
                for($i=0;$i <sizeof($meta_form_fields);$i++)
                	 {
                    $key_name = @$meta_form_fields[$i]['identifier'];
                   
                	      @$meta_data->$key_name = @$meta_form_fields[$i]['value'];
                     }

                $data['meta'] = $meta_data;
              }
              else
              {
                $data['meta'] = '';
              }


 
                return $this->update( $request , $id ,$data);
  
  }










   
 // Route-11.1 ============================================================== Store User to User table =========================================> 
   public function store(Request $request , $create_item_request = '')
   {
 
 
                if($create_item_request != '')
                {
                	$request = $create_item_request;
                }


              if($request['first_name'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'First Name Required';
                    return $data;	
               }

               if($request['email'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Email Required';
                    return $data;	
               }

               if($request['phone'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Phone Required';
                    return $data;	
               }

               if($request['password'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Password Required';
                    return $data;	
               }

               if($request['user_type'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'User Type Required';
                    return $data;	
               }


              //email exist check
              $email_exist_count = @\App\User::where('email' , $request['email'])->count();
              if($email_exist_count > 0) 
              {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Email Already Exist';
                    return $data; 
              } 

 
			        $first_name = $this->validate_string(@$request['first_name']); 
			        $last_name = $this->validate_string(@$request['last_name']);
			        $email = $this->validate_string(@$request['email']);
			        $phone = $this->validate_string(@$request['phone']);
			        $password = Hash::make(@$request['password']);       
			        $photo = @$this->validate_string(@$request['photo']);
			        $user_type = $this->validate_string(@$request['user_type']);
			        $otp = $this->validate_string(@$request['otp']);
			        $remember_token = $this->validate_string(@$request['remember_token']);
			        $email_token = $this->validate_string(@$request['email_token']);
	            $latitude = $this->validate_string(@$request['latitude']);
              $longitude = $this->validate_string(@$request['longitude']);	
              $commission = $this->validate_integer(@$request['commission']);  
              $status = $this->validate_integer_return_one(@$request['status']);  
              $vendor_id = $this->validate_string(@$request['vendor_id']);  
              $store_id = $this->validate_string(@$request['store_id']);  
 
              if($photo != null && $photo != '')
              {
                  $thumb_photo = "thumb-".$photo;
              }
              else
              {
                  $thumb_photo = '';
              }
  
					    $user = new App\User;
					    $user->first_name = @$first_name;
			        $user->last_name = @$last_name;
			        $user->email = @$email;
			        $user->phone = @$phone;
			        $user->password = @$password;
			        $user->photo = @$photo;
              $user->thumb_photo =  $this->validate_string(@$thumb_photo); 
			        $user->user_type = @$user_type;
			        $user->otp = @$otp;
			        $user->remember_token = @$remember_token;
              $user->commission = @$commission;
			        $user->email_token =@$email_token;
              $user->longitude = @$longitude;
              $user->latitude = @$longitude;
              $user->status = @$status;
              $user->vendor_id = @$vendor_id;
              $user->store_id = @$store_id;
 			        $user->save();

              

// $count = \App\BoardCard::where("id",$input->get("cardId"))->whereRaw("FIND_IN_SET(".$users_array[$t].",board_card.user_id)")->get()->count();
 			        //store meta value
					$user_meta = @$request['meta'];

          if($user_meta != '')
          {
            $this->store_meta_values(@$user->user_id , @$user_meta , $user_type );
          }
					
				    if($user != '')
					{
						              $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'User Added Successfully';
                          $data['data']      =   $user;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to Add User';
                          $data['data']      =   [];  
					}
				   
				  return $data;
	 }
   

   
  
  // Route-11.2 ============================================================== Get Users List =========================================> 
   public function get_list()
   {
    ///auth filter starts
    $auth_user_id = $this->get_auth_user_id();
    $auth_user_type = $this->get_auth_user_type();
    $auth_app_type = $this->get_auth_app_type();

    $per_page = $this->get_variable_per_page(); //ASC or DESC
		$orderby = $this->get_variable_orderby();
		$order = $this->get_variable_order();
		$search = $this->get_variable_search();
		$request_type = $this->get_variable_request_type();
		$user_type = $this->get_variable_user_type();
		$include_meta = $this->get_variable_include_meta();
			  
	  $model = new \App\User;
	  $model = $model::where('user_id' ,'<>', '0'); 
    $model = $model->where('app_type' , $auth_app_type);  

		if($user_type != '' && $user_type != null)
		{  $model = $model->where('user_type' , $user_type);  }	

  ///auth filter starts
    $auth_user_id = $this->get_auth_user_id();
    $auth_user_type = $this->get_auth_user_type();
 
     if($auth_user_type == '3') //vendor
    {   $model = $model->where('vendor_id' , $auth_user_id );   
    }

    if($auth_user_type == '4')
    {


        $auth_store_id = @\App\Store::where('manager_id',$auth_user_id)->first(['store_id'])->store_id;

      if($auth_store_id != null && $auth_store_id != '')
      {
         $model = $model->where('store_id' , $auth_store_id ); 
      }
     
    }


  ///auth filter starts Ends



 
	    if($search != '' && $search != null)
		{  $model = $model->where(function($q) use ($search) { $q->where( DB::raw("CONCAT(email,' ',phone,' ',first_name,' ',last_name,' ',user_id)"),'like', '%'.$search.'%'); });  }

        $model = $model->orderBy($orderby,$order);	



        if($request_type =='input_field')
		{	 $result = $model->paginate($per_page , ['user_id','first_name','last_name']); 			}
	    else { $result = $model->paginate($per_page); }
	    



	    if($include_meta == 'true')
		{
			foreach($result as $r)
			{
			   $r->meta = @\App\UserMetaValue::where('user_id' , $r->user_id)->get(); 
			}
		}

		if($request_type =='input_field')
				{
                  	foreach($result as $r)
			        {
			          $r->label = $r->first_name; 
			          $r->value = $r->user_id; 
			        }    
				}


	   
	              if(sizeof($result) > 0)
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Users List Fetched Successfully';
                          $data['data']      =   $result;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'No User Found';
                          $data['data']      =   [];  
					}
				   return $data;
   }  






  
  // Route-11.3 ============================================================== Get Users List =========================================> 
   public function show($id)
   {
	    
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
					
					$details = @\App\User::where('user_id',$id)->get();
					
					$meta_include_needed = $this->get_variable_include_meta();


					if($meta_include_needed == 'true'  )
					{
						$details[0]['meta'] = @\App\UserMetaValue::where('user_id',$id)->first();
					}
					
			 			
				    if($details != '')
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'User Fetched Successfully';
                          $data['data']      =   $details;  
				    }
					else
					{
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Unable to Fetch User';
                          $data['data']      =   [];  
					}
				   return $data;
				 
  }   
  



   
  // Route-11.4 ============================================================== Get Items List =========================================> 
   public function update(Request $request , $id , $create_user_request = '')
   {


 

	          if($create_user_request != '')
                {
                	$request = $create_user_request;
                }

 
              if($request['first_name'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'First Name is Required';
                    return $data;	
               }

              if($request['email'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Email is Required';
                    return $data;	
               }

                 if($request['phone'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'Phone is Required';
                    return $data;	
               }

                 if($request['user_type'] == '')
               {
                    $data['status_code']    =   0;
                    $data['status_text']    =   'Failed';             
                    $data['message']        =   'User Type is Required';
                    return $data;	
               }

           

			  
	               //check existance of user with ID in user table
					$exist = $this->model_exist($id);	
                    if($exist == 0 or $exist == '0')
                    {
						  $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'User with this ID does not exist';
                          $data['data']      =   [];
                          return $data;						  
					}


   



				      	  $first_name = $this->validate_string(@$request['first_name']); 
			            $last_name = $this->validate_string(@$request['last_name']);
			            $email = $this->validate_string(@$request['email']);
			            $phone = $this->validate_string(@$request['phone']);
			            $photo = $this->validate_string(@$request['photo']);

			            $user_type = $this->validate_string(@$request['user_type']);

			            $otp = $this->validate_string(@$request['otp']);
			            $remember_token = $this->validate_integer(@$request['remember_token']);
			            $email_token = $this->validate_string(@$request['email_token']);
                  $latitude = $this->validate_string(@$request['latitude']);
                  $longitude = $this->validate_string(@$request['longitude']);  
                  $commission = $this->validate_integer(@$request['commission']);  

                  $status = $this->validate_integer_return_one(@$request['status']);  
                  $vendor_id = $this->validate_string(@$request['vendor_id']);  
				   $store_id = $this->validate_string(@$request['store_id']);  

                  
          if($photo != null && $photo != '')
              {
                  $thumb_photo = "thumb-".$photo;
              }
              else
              {
                  $thumb_photo = '';
              }

 
	              	$user =  \App\User::where('user_id',$id)->update([
                        'first_name' => $first_name,
						            'last_name' =>  $last_name,
					             	'email' => $email,
					             	'phone' => $phone,
					             	'photo' => $photo,
                        'thumb_photo' => $thumb_photo,
						            'user_type' => $user_type,
						            'otp' => $otp,
						            'remember_token' => $remember_token,
                   	  	'email_token' => $email_token,
                        'commission' => $commission,
                        'vendor_id' => $vendor_id,
						'store_id' => $store_id,
						'latitude' => $latitude,
                        'longitude' => $longitude
		              ]);
				 


					
					//update meta value

        if(@$request['meta'] != '')
         {


 
					   $user_meta = @$request['meta'];


             if($user_meta != '')
              {
   
                $this->update_meta_values($id , $user_meta , $user_type);
              }
        }
					
					
	               
				    $result = @\App\User::where('user_id',$id)->get();
			 			
	                if(sizeof($result) > 0)
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'User Updated Successfully';
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
  


   
 
  // Route-11.5 ============================================================== Delete a Address =========================================> 
   public function destroy(Request $request , $id)
   {

        $users_details = @\App\User::where('user_id',$id)->get();

        if(count($users_details) < 1)
        {
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'User not found';
                          $data['data']      =   [];  
                          return $data;
        }


        $user_type = $users_details[0]["user_type"];

        //admin =====================================================
        if($user_type == '1')
        {
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'Admin cannot be Deleted !';
                          $data['data']      =   [];  
                          return $data;
        }

        //customer ==================================================
        if($user_type == '2')
        {
            $customer_id_exist_in_orders = @\App\Order::where('customer_id',$id)->count();
            if($customer_id_exist_in_orders > 0)
            {
                           $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'this customer cannot be deleted as he/she has orders with us';
                          $data['data']      =   [];  
                          return $data;

            }


            @\App\LoyaltyPoints::where('user_id',$id)->delete();
            @\App\LogUpdateRequest::where('user_id',$id)->delete();
            @\App\Newsletters::where('email',$users_details[0]['email'])->delete();
            @\App\NotificationSettings::where('user_id',$id)->delete();
            @\App\OrderReview::where('user_id',$id)->delete();
            @\App\UserMetaValue::where('user_id',$id)->delete();
            @\App\UserSessions::where('user_id',$id)->delete();
            @\App\User::where('user_id',$id)->delete();

            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Customer Deleted Successfully !';
            $data['data']      =   [];  
            return $data;
        }


        //vendor ===================================================
        if($user_type == '3')
        {
            $vendor_id_exist_in_items = @\App\Items::where('vendor_id',$id)->count();
            if($vendor_id_exist_in_items > 0)
            {
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'this vendor cannot be deleted as he/she has items added';
                          $data['data']      =   [];  
                          return $data;

            }

             $vendor_id_exist_in_coupons = @\App\Coupons::where('vendor_id',$id)->count();
            if($vendor_id_exist_in_coupons > 0)
            {
                           $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';             
                          $data['message']        =   'this vendor cannot be deleted as he/she has coupons added';
                          $data['data']      =   [];  
                          return $data;

            }

            @\App\User::where('user_id',$id)->delete();
 
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Vendor Deleted Successfully !';
            $data['data']      =   [];  
            return $data;
          
        }


        //store manager =============================================
        if($user_type == '4')
        {
            $vendor_id_exist_in_stores = @\App\Store::where('manager_id',$id)->count();
            if($vendor_id_exist_in_stores > 0)
            {
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';    
                          $store_id = @\App\Store::where('manager_id',$id)->first(['store_id'])->store_id;
                          $store_title = @\App\Store::where('store_id',$store_id)->first(['store_title'])->store_title;
                          $data['message']        =   'this Store Manager cannot be deleted as he/she is assigned to <a href="'.env("APP_URL")."/vi/store/".$store_id.'">'.$store_title.'</a>';
                          $data['data']      =   [];  
                          return $data;

            }
            @\App\User::where('user_id',$id)->delete();
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Store Manager Deleted Successfully !';
            $data['data']      =   [];  
            return $data;
          
        }


        //Tasks===================================================
        if($user_type == '5')
        {
            $vendor_id_exist_in_tasks = @\App\Task::where('driver_id',$id)->count();
            if($vendor_id_exist_in_tasks > 0)
            {
                          $data['status_code']    =   0;
                          $data['status_text']    =   'Failed';    
                          $data['message']        =   'this Driver cannot be deleted as he/she has tasks assigned';
                          $data['data']      =   [];  
                          return $data;

            }
            @\App\User::where('user_id',$id)->delete();
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Driver Deleted Successfully !';
            $data['data']      =   [];  
            return $data;
          
        }


   }
 
 
  



 

//Route-11.6

   public function update_password(Request $request , $user_id = '')
   {

  $password = $this->validate_string($request->password);

  if($password == '' || $password == null)
  {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'Password Required';
            $data['data']      =   [];  
            return $data;

  }

         $password= Hash::make($request->password);  
         @\App\User::where('user_id', $user_id)->update(['password' => $password]);

            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'New Password Generated';
            $data['data']      =   [];  
            return $data;
  }










   public function store_meta_values($user_id , $user_meta , $user_type)
  {
	  $user_meta_type = @\App\UserMetaType::where('user_type',$user_type)->get();
	  	  
	  foreach($user_meta_type as $imt)
	  {
		$identifier = $imt->identifier;  
	 	$value = $this->validate_string(@$user_meta[$identifier]);
	    $user_meta_type_id = $this->get_user_meta_type_id($identifier);
	    
		$user_meta_value = new \App\UserMetaValue;
		$user_meta_value->user_meta_type_id = $imt->user_meta_type_id;
		$user_meta_value->user_id = @$user_id;
		$user_meta_value->value = $this->validate_string(@$value);
		$user_meta_value->save();
	  }
	  return 1;
  }
  


     public function update_meta_values($user_id , $user_meta , $user_type)
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
			 
			 
 

  
	  $user_meta_type = @\App\UserMetaType::where('app_type' , $auth_app_type)->where('user_type',$user_type)->get();
	  	  

 
	  foreach($user_meta_type as $imt)
	  {
	   	$identifier = $imt->identifier;  
	   	$value = $this->validate_string(@$user_meta->$identifier);
	    $user_meta_type_id = @$this->get_user_meta_type_id($identifier);

 
      $meta_value_count = @App\UserMetaValue::where('user_id', $user_id)->where('user_meta_type_id', $user_meta_type_id)->count();

      if($meta_value_count < 1)
      {

         $user_meta_value = new \App\UserMetaValue;
         $user_meta_value->user_meta_type_id =  $user_meta_type_id;
          $user_meta_value->user_id = @$user_id;
          $user_meta_value->value = $this->validate_string(@$value);
        $user_meta_value->save();

       

      }
    else
  {
  
	  	App\UserMetaValue::where('user_id', $user_id)->where('user_meta_type_id', $user_meta_type_id)->update(['value' => @$value ]);
  }
	  }
	 
  }
  
  public function get_user_meta_type_id($identifer)
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
	  $user_meta_type_id = @\App\UserMetaType::where('app_type' , $auth_app_type)->where('identifier',$identifer)->first(['user_meta_type_id'])->user_meta_type_id;
	  return $user_meta_type_id;
  }
  



 
 
   
//==========================================================================misc functions===================================================================//   
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


public function get_variable_user_type()
{
	 if(isset($_GET['user_type']) && $_GET['user_type'] != null && $_GET['user_type'] != '')
					{ $user_type = $_GET['user_type']; }
					else 
					{ $user_type = ''; }
    return $user_type;
}	
 
      
   
   public function get_variable_linked_id()
{
	 if(isset($_GET['linked_id']) && $_GET['linked_id'] != null && $_GET['linked_id'] != '')
					{ $linked_id = $_GET['linked_id']; }
					else 
					{ $linked_id = ''; }
    return $linked_id;
}	
 
  
 
   public function get_variable_include_meta()
{
	 if(isset($_GET['include_meta']) && $_GET['include_meta'] != null && $_GET['include_meta'] != '')
					{ $include_meta = $_GET['include_meta']; }
					else 
					{ $include_meta = 'false'; }
    return $include_meta;
}	
 

 public function get_variable_request_type()
 {
 	   if(isset($_GET['request_type']) && $_GET['request_type'] != null && $_GET['request_type'] != '')
					{ $request_type = $_GET['request_type']; }
					else 
					{ $request_type = ''; }
       return $request_type;
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