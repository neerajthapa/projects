<?php
namespace App\Traits;
use \App\Jobs\SendEmailTest;

trait notifications
{
    
    protected function notifications($name)
    {
        return $name;
    }
	 
//main function to send notifications
    protected function notify(  $request='' ,$notification_type ,$id , $receiver_id = '' )
    { 

         $notifications_push_data = @\App\NotificationsPush::where('notification_type' , $notification_type )->get(['id','notification_type','title','sub_title','user_type']);
         $notifications_email_data = @\App\NotificationsEmail::where('notification_type' , $notification_type )->get(['id','notification_type','email_subject','email_body','user_type']);
         $notifications_sms_data = @\App\NotificationsSms::where('notification_type' , $notification_type )->get(['id','notification_type','title','sub_title','user_type']);
      
   
       if($notification_type == 'order_status_updated' || $notification_type == 'order_placed' || $notification_type == 'order_reviewed_by_customer' || $notification_type == 'order_reviewed_by_driver' || $notification_type == 'order_dropped_off_by_driver' || $notification_type == 'order_picked_up_by_driver' || $notification_type == 'order_reclaimed' || $notification_type == 'task_assigned_to_driver'     )
        {
                          $details = @\App\Order::where('order_id',$id)->get();
                          $details[0]['order_details'] = app('App\Http\Controllers\Api\OrderController')->show( $id , $request);
        }


        if($notification_type == 'store_update_request_approved_by_admin')
        {
                          $details = @\App\Store::where("store_id",$id)->get();
        }
 

              if($notification_type == 'signup'  )
        {
                          $details = @\App\User::where('user_id' , $id)->get();
        }


             
                          $this->send_email_notification_logic( $notification_type , $id , $details , $notifications_email_data , $receiver_id);
                        //send push
                          $this->send_push_notification_logic( $notification_type , $id , $details , $notifications_push_data , $receiver_id);

                          $this->send_sms_notification_logic( $notification_type , $id , $details , $notifications_sms_data , $receiver_id);
        
    }
//main function ends




//send push notification ends here ==================================================================================================================================================================
//=================================================================================================================================================================================================== 

public function send_push_notification_logic( $notification_type , $id , $details , $notifications_push_data , $receiver_id = '')
    {


 
        //for loop over all notifications_push
        if(count($notifications_push_data) > 0 )
        {
            foreach($notifications_push_data as $notification_push)
            {
               $user_type = $notification_push['user_type'];

               $sub_title = $notification_push['sub_title'];
                $sub_title = $this->convert_string($notification_type , $id , $sub_title );

               $title = $notification_push['title'];
               $title = $this->convert_string($notification_type , $id , $title );

               //get receiver types from database======
 
               $user_id = '';

               //admin
               if($user_type == 1 or $user_type == '1')
               {
                   
               }
               
               // customer
               if($user_type == 2 or $user_type == '2')
               {
                   $user_id = $details[0]['customer_id'];       
               }
 
               // vendor
               if($user_type == 3 or $user_type == '3')
               {
               
                    $store_id = $details[0]['store_id'];  
                    $user_id = @\App\Store::where('store_id' , $store_id )->first(['vendor_id'])->vendor_id; 
               }

               //store manager
               if($user_type == 4 or $user_type == '4')
               {
                    $store_id = $details[0]['store_id'];  
                    $user_id = @\App\Store::where('store_id' , $store_id )->first(['manager_id'])->manager_id;  
                }

               //driver
               if($user_type == 5 or $user_type == '5')
               {
                    
               }


            if($receiver_id != '' && $receiver_id != null)
               {
                $user_id = $receiver_id;
               }


 
 
                if($user_id != '' && $user_id != null && $user_id != ' ')
                {
                  


                   $notification_token = @\App\UserSessions::where('user_id' , $user_id)->where('notification_token','<>','')->pluck('notification_token');
                   if(sizeof($notification_token) > 0 )
                   {
 

 
                          $this->send_push_notification( $notification_type , $id , $title , $sub_title , $notification_token , $details  );
                   }
                   
                }
              }

            
        }
        return 1;
    }





    //send push notification ends here ==================================================================================================================================================================
//=================================================================================================================================================================================================== 

public function send_sms_notification_logic( $notification_type , $id , $details , $notifications_push_data , $receiver_id = '')
    {

 


        //for loop over all notifications_push
        if(count($notifications_push_data) > 0 )
        {
            foreach($notifications_push_data as $notification_push)
            {

               $user_type = $notification_push['user_type'];

                 $sub_title = $notification_push['sub_title'];
                  $sub_title = $this->convert_string($notification_type , $id , $sub_title );

               $title = $notification_push['title'];
               $title = $this->convert_string($notification_type , $id , $title );

               //get receiver types from database======
 
               $user_id = '';

               //admin
               if($user_type == 1 or $user_type == '1')
               {
                   
               }
               
               // customer
               if($user_type == 2 or $user_type == '2')
               {
                   $user_id = $details[0]['customer_id'];       
               }
 
               // vendor
               if($user_type == 3 or $user_type == '3')
               {
               
                    $store_id = $details[0]['store_id'];  
                    $user_id = @\App\Store::where('store_id' , $store_id )->first(['vendor_id'])->vendor_id; 
               }

               //store manager
               if($user_type == 4 or $user_type == '4')
               {
                    $store_id = $details[0]['store_id'];  
                    $user_id = @\App\Store::where('store_id' , $store_id )->first(['manager_id'])->manager_id;  
                }

               //driver
               if($user_type == 5 or $user_type == '5')
               {
                    
               }
 
                if($user_id != '' && $user_id != null && $user_id != ' ')
                {


                  
                   $receiver_phone = @\App\User::where('user_id' , $user_id)->where('phone','<>','')->first(['phone'])->phone;
                   if( $receiver_phone != '' )
                   {
                           $this->send_sms_notification( $notification_type , $id , $title , $sub_title , $receiver_phone , $details  );
                   }
                   
                }
              }

            
        }
        return 1;
    }


public function send_sms_notification( $notification_type , $id , $title , $sub_title , $receiver_phone , $details = [] )
{
	// hamid (yugal sir) = +17732518701
	//hamid = +17732518701
          try {
		             @$twilio = new \Aloha\Twilio\Twilio('ACfb093e03fd084a1a79d594a3d1c711dd', 'c2d9a7928c3f1f82c217e484d27a6f53', '+19085740454');
		              $p = @$twilio->message($receiver_phone, $sub_title);
              } catch (\Exception $e){

                        return 1;	
						if($e->getCode() == 21211)
						{
                             $message = $e->getMessage();
                        }
                  }
}



 protected function send_push_notification( $notification_type , $id , $title , $sub_title , $notification_token , $details = [] )
 {
    $details = @\App\Order::where('order_id',$id)->get();
    $data = array( 'title' => $title , 'subtitle' => $sub_title , 'ios_sound'=>'','badge'=>0 , 'details'=>$details , 'id'=>$id , 'notification_type'=>$notification_type  );

    $registration_ids = $notification_token;
    $content = array( "en" => $sub_title);
    $title = array( "en" => $title );
    $sub_title = array( "en" => $sub_title );
    $fields = array(
                    'app_id' =>env("ONE_SIGNAL_APP_ID", ""),
                     'include_player_ids' => $notification_token,
                     'data' => $data,
                     'contents' => $content,
                     'headings' => $title,
                     //'subtitle' => $sub_title,
                      'ios_sound'=>'incoming.caf',
                     'android_sound'=>'alert.mp3',
                     'ios_badgeCount'=>1,
                     'ios_badgeType'=>'Increase' );
    
    $fields = json_encode($fields);
    //print("\nJSON sent:\n");
    //print($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic '.env("ONE_SIGNAL_REST_KEY", "")));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $response = curl_exec($ch);
    curl_close($ch);
    $return["allresponses"] = $response;
    $return = json_encode( $return);
    //echo $return;
    return 1;
}

//send push notification ends here ===================================================================================================================================================================
//==================================================================================================================================================================================================== 
//send email notification ends here ================================================================================================================================================================
//=================================================================================================================================================================================================== 
 
    public function send_email_notification_logic( $notification_type , $id , $details , $notifications_email_data , $receiver_id = '')
    {
        //for loop over all notifications_push
        if(count($notifications_email_data) > 0 )
        {
            foreach($notifications_email_data as $notification_email )
            {
               $user_type = $notification_email['user_type'];
               $email_body = $notification_email['email_body'];
               $email_body = $this->convert_string($notification_type , $id , $email_body );

               $email_subject = $notification_email['email_subject'];
               $email_subject = $this->convert_string($notification_type , $id , $email_subject );
             
               //get receiver types from database======
               $user_id = '';

               //admin
               if($user_type == 1 or $user_type == '1')
               {
                   $user_type = '230';
               }

               // customer
               if($user_type == 2 or $user_type == '2')
               {
                   $user_id = $details[0]['customer_id'];       
               }

               // vendor
               if($user_type == 3 or $user_type == '3')
               {
                   $store_id = $details[0]['store_id'];  
                   $user_id = @\App\Store::where('store_id' , $store_id )->first(['vendor_id'])->vendor_id; 
               }
 
               //store manager
               if($user_type == 4 or $user_type == '4')
               {
                   $store_id = $details[0]['store_id'];  
                   $user_id = @\App\Store::where('store_id' , $store_id )->first(['manager_id'])->manager_id;  

                }
 
               //driver
               if($user_type == 5 or $user_type == '5')
               {
                   $user_id = @\App\Task::where('order_id',$id)->first(['driver_id'])->driver_id;
               }


               if($notification_type == 'signup')
               {
                    @$user_id = $details[0]['user_id'];
               }
   
               if($receiver_id != '' && $receiver_id != null)
               {
                    $user_id = $receiver_id;
               }
 
                if($notification_type == 'store_update_request_placed')
                {
		                    $email = @\App\Setting::where('key_title','admin_email')->first(['key_value'])->key_value;
		                    if($email != '' && $email  != null)
		                    {
		                                    $this->send_email_notification( $notification_type , $id , $email_subject , $email_body , $email , $details );
		                                    if($receiver_id != '' && $receiver_id != null)
		                                    {
		                                       return 1;
		                                    }
		                    }
                }
                else
                {
	                        if($user_id != '' && $user_id != null && $user_id != ' ')
	                        {
	                            $email = @\App\User::where('user_id' , $user_id)->where('email','<>','')->first(['email'])->email;
	                           if( $email != '' )
	                           {
		                                    $this->send_email_notification( $notification_type , $id , $email_subject , $email_body , $email , $details );
		                                    if($receiver_id != '' && $receiver_id != null)
		                                    {
		                                       return 1;
		                                    }
	                           }
	                        }
                }



              }

            
        }
        return 1;
    }


 protected function send_email_notification( $notification_type , $id , $email_subject , $email_body , $email , $details  )
 {
          $main = array();
          $main['email_body'] = $email_body;
          $main['email_subject'] = $email_subject;
          $main['details'] = $details;
          $main['email'] = $email;
          $main['id'] = $id;
          $main['notification_type'] = $notification_type;
          $d = dispatch(new \App\Jobs\SendEmailTest($main));
          /**
			           \Mail::send('emails.email_main', $main, function($message) use (  $notification_type , $email , $id,  $email_subject , $main ) 
			                            {  
			                                $message->to( $email, env('APP_NAME'))->subject( env('APP_NAME').':'. $email_subject );
			                                $message->from('harvindersingh@goteso.com', env('APP_NAME'));
			                            });
		  **/
 }


//send email notification ends here =====================================================================================================================================================================
//======================================================================================================================================================================================================= 

 
 protected function convert_string( $notification_type , $id , $string  )
 {
           $notification_variables = @\App\NotificationVariables::get([ 'variable_key' , 'variable_value' , 'model' , 'column_where_key']);
           if(count($notification_variables) > 0)
           {
 
              foreach($notification_variables as $variable)
               {
                         $model = @$variable['model'];
                        $variable_key = @$variable['variable_key'];
                        $variable_value = @$variable['variable_value'];
                        $column_where_key = @$variable['column_where_key'];

                        if($model == 'App\User')
                        {

                            $primary_id = @\App\Order::where('order_id',$id)->first(['customer_id'])->customer_id;

                            if($notification_type == 'signup')
                            {
                                 $primary_id = $id;
                              
                            }
                        }
                        
                         if($model == 'App\Order')
                        {

                            $primary_id = $id;
                        }

                             if($model == 'App\OrderReview')
                        {
                            $primary_id = $id;
                        }

                        if($model == 'App\Store')
                        {
                             $store_id = @\App\Order::where('order_id',$id)->first(['store_id'])->store_id;
                             if($store_id != '' && $store_id != null)
                             {
                                $primary_id = $store_id;
                             }
                        }


 
                  
 

                        $modelName1 = $model ;  
                        $model1 = new $modelName1();
                         $data = $model1::where($column_where_key , $primary_id )->get();
 
                          $variable_value = @$data[0][$variable_value];

                          $string = str_replace( @$variable_key , $variable_value , @$string );
               }
              return @$string;
           }
}



















//================================= misc function to get extra data from other tables =================================================//



//========================== misc function to get extra data from other tables ends here  =============================================//

 }
 
 
 