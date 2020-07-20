<?php
namespace App\Traits;

trait one_signal
{
    protected function one_signal($name)
    {
        return $name;
    }
	
	
	
	
	
function auth_token_array($con)
{ 
$authTokenArr = array();
  $sql="SELECT  authToken from  login where authToken <> ''";
  $result = mysqli_query($con,$sql);
     while($row = mysqli_fetch_array($result))
	        { $authTokenArr[] = $row["authToken"];  }
  if((mysqli_num_rows($result)>0)) { return $authTokenArr; }
  else{ return []; }		
  }

 
 
 protected function notification_to_array($authTokenArr , $title , $text){


	$message = array("message" => "travel", "title" =>"Test Notification" , "time_remaining" => '100' , "eventid" => '');
 
  	$data = array( 'title' => 'travel', 'subtitle' => $text , 'ios_sound'=>'','badge'=>0 );
    $registration_ids = $authTokenArr;
	$content = array( "en" => $text);
	$title = array( "en" => $title );
    $subTitle = array( "en" => $text );
    $fields = array(
                      'app_id' =>env("ONE_SIGNAL_APP_ID", ""),
                     'include_player_ids' => $authTokenArr,
                     'data' => $data,
                     'contents' => $content,
                     'headings' => $title,
                     'subtitle' => $subTitle,
					  'ios_sound'=>'incoming.caf',
					 'android_sound'=>'alert.mp3',
					 'ios_badgeCount'=>1,
			         'ios_badgeType'=>'Increase'
                      
                    );
    $fields = json_encode($fields);
   // print("\nJSON sent:\n");
   // print($fields);
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
 }
 
 
  protected function notification_to_single($authToken , $title , $text){
	   
	$message = array("message" => "travel", "title" =>"Test Notification" , "time_remaining" => '100' , "eventid" => '');
   	$data = array( 'title' => 'travel', 'subtitle' =>$text , 'ios_sound'=>'','badge'=>0 );
    $registration_ids = $authToken;
	$content = array( "en" =>$text);
	$title = array( "en" =>$title );
    $subTitle = array( "en" =>$text );
    $fields = array(
                    'app_id' =>env("ONE_SIGNAL_APP_ID", ""),
                     'include_player_ids' => array($authToken),
                     'data' => $data,
                     'contents' =>$content,
                     'headings' =>$title,
                     'subtitle' => $subTitle,
					  'ios_sound'=>'incoming.caf',
					 'android_sound'=>'alert.mp3',
					 'ios_badgeCount'=>1,
			         'ios_badgeType'=>'Increase'
                   
                    );
    $fields = json_encode($fields);
   //  print("\nJSON sent:\n");
 //  print($fields);
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
 //	echo $return;
 }
 
 
 
 
   protected function notification_to_single_identifier($authToken , $title , $text , $details , $identifier){
    $data = array( 'title' => $title, 'subtitle' => $text , 'ios_sound'=>'','badge'=>0,'details'=>$details , 'notification_identifier'=>$identifier);
    $registration_ids = $authToken;
	$content = array( "en" => $text);
	$title = array( "en" => $title );
    $subTitle = array( "en" => $text );
    $fields = array(
                    'app_id' =>env("ONE_SIGNAL_APP_ID", ""),
                     'include_player_ids' => array($authToken),
                     'data' => $data,
                     'contents' => $content,
                     'headings' => $title,
                     'subtitle' => $subTitle,
					 'notification_identifier' => $identifier,
					  'ios_sound'=>'incoming.caf',
					 'android_sound'=>'alert.mp3',
					 'ios_badgeCount'=>1,
			         'ios_badgeType'=>'Increase'
                   
                    );
    $fields = json_encode($fields);
   // print("\nJSON sent:\n");
  //  print($fields);
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
 //	echo $return;
 }
 
 
 
protected function notification_to_multiple_identifier($authToken , $title , $text , $details){
	$data = array( 'title' => 'travel', 'subtitle' => $text , 'ios_sound'=>'','badge'=>0,'details'=>$details );
    $registration_ids = $authToken;
	$content = array( "en" => $text);
	$title = array( "en" => $title );
    $subTitle = array( "en" => $text );
    $fields = array(
                    'app_id' =>env("ONE_SIGNAL_APP_ID", ""),
                     'include_player_ids' => $authToken,
                     'data' => $data,
                     'contents' => $content,
                     'headings' => $title,
                     'subtitle' => $subTitle,
					  'ios_sound'=>'incoming.caf',
					 'android_sound'=>'alert.mp3',
					 'ios_badgeCount'=>1,
			         'ios_badgeType'=>'Increase'
                   
                    );
    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
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
 	echo $return;
 }
 
 


protected function notification_to_all($authToken , $title , $text , $details){
    $data = array( 'title' => 'travel', 'subtitle' => $text , 'ios_sound'=>'','badge'=>0,'details'=>$details );
    $registration_ids = $authToken;
    $content = array( "en" => $text);
    $title = array( "en" => $title );
    $subTitle = array( "en" => $text );
    $fields = array(
                    'app_id' =>env("ONE_SIGNAL_APP_ID", ""),
                    // 'include_player_ids' => $authToken,
                     'included_segments' => array(  'All'  ),
                     'data' => $data,
                     'contents' => $content,
                     'headings' => $title,
                     'subtitle' => $subTitle,
                      'ios_sound'=>'incoming.caf',
                     'android_sound'=>'alert.mp3',
                     'ios_badgeCount'=>1,
                     'ios_badgeType'=>'Increase'
                    );
    $fields = json_encode($fields);
 //    print("\nJSON sent:\n");
  //   print($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic '.env("ONE_SIGNAL_REST_KEY", "")));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
   // $response = curl_exec($ch);
    curl_close($ch);
   //  $return["allresponses"] = $response;
  //  $return = json_encode( $return);
    // echo $return;
 }
 




 
protected function notification_to_single_identifier_logout($authToken , $title , $text , $details){
	$data = array( 'title' => 'travel', 'subtitle' => $text , 'ios_sound'=>'','badge'=>0,'details'=>$details , 'type'=>'logout');
    $registration_ids = $authToken;
	$content = array( "en" => $text);
	$title = array( "en" => $title );
    $subTitle = array( "en" => $text );
    $fields = array(
                    'app_id' =>env("ONE_SIGNAL_APP_ID", ""),
                     'include_player_ids' => array($authToken),
                     'data' => $data,
					 'details'=>$details,
                     'contents' => $content,
                     'headings' => $title,
                     'subtitle' => $subTitle,
					  'ios_sound'=>'incoming.caf',
					 'android_sound'=>'alert.mp3',
					 'type'=>'logout',
					 'ios_badgeCount'=>1,
			         'ios_badgeType'=>'Increase'
                   
                    );
    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
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
 	echo $return;
 }
 
  
 
 
 
 
 protected function get_notification_string($string , $df)
 {
	        $notification_variables = @\App\NotificationVariables::get();
            foreach($notification_variables as $var)
			 {
					 $string = str_replace(@$var->variable_key,@$df[$var->variable_value],@$string);
			 }
			return $string;
 }
 
 
 
}