<?php

namespace App\Http\Controllers; 
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // using controller class
use Auth;
use Session;
use DB;
use Validator;
use App\User;
use Hash;

use App\Jobs\SendPushNotification;

class UsersController extends Controller 
{
	

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function student_create()
    {
       $countries = DB::table('countries')->get();        
      return view('users.student_create')->with('countries',$countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function student_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|max:255|unique:users',
        'password'  =>  'required|min:6|confirmed',
        'password_confirmation'  =>  'required',
        'country_id' => 'required',
        
         ]);
        if ($validator->fails()) {
          //print_r($validator->errors()->all());die;
            return redirect('guest-student')
                ->withInput()
                ->withErrors($validator);
        }
        $student = new User;
        $student->first_name  = $request->first_name;
        $student->last_name   = $request->last_name;
        $student->email  = $request->email;
        $student->country_id   = $request->country_id;
        $student->password  =  Hash::make($request->password);
        $student->user_group_id = 2;
        $student->status = 1;
        $student->save();
        Session::flash('message', 'A verifaction link send to you at your email. please check your email and confirm your registration.....');
        return redirect('build-student-profile/'.$student->id);
    }

    /**
     * Call next step for complete his/her profile
     *
     * @return Response
     */
    public function build_profile($user_id)
    {
    	$student = User::find($user_id);
    	return view('users.build_profile')->with('student', $student);
    	
    }

    public function test_queue(Request $request)
    {
        $device_type = 'Ios';
        $push_message = 'test message';
        $badge_count = 1;
        $custom_array = array(
            'follow_user_id' => 123,
            'notification_by_user_id' => 124,
            'notification_type' => 'nearby',
            'is_anonymous' => 1,
            'ques_id' => 12
        );

        $arr = [
          '44fa5c67e3ca14d17d20c6d0ae21dcc186e22b7eb70155629673ad4b63d19cb8',
            'c24e9c645f5f949b69293194e1e65a39d4243c87662c9feed9938d4f55b522b8',
            '04ff53c2dcbdb103dc270123f711cb88afaa6bd804111311e761e299b24c0406',
            'b871ed650011cd3d398ce6ea976d282f18b814271b49051a5436c1b84dcf932d',
            '5c03bf401f043bcdb1ffce7dea37161d98e36434dff26cf2bb1f31d1dda9da39',
            '12ee7e7af6eb50b3a6a7b8ffde17407214d0397f17626db78bb3bcee54367e66',
            '61238ab6054b82623cdeac8632a15420695e9900b9ccd47171c62d526b8f4758',
            '522976531f82599b2c6781dc4e752882c8fe5dfd95c9a218b4212b706bb77eb7',
            'f6a55018f2e832f50fca7a35a8b52d4d03562d496a9d334d39912b850765cef5',
            'be9730fd9b227903ad8feae88d667ab70df46ad36ceefaea957b017be838a7cd'
        ];

        foreach($arr as $deviceToken)
        {
            $job = (new SendPushNotification($device_type,$push_message,$badge_count,$custom_array,$deviceToken));
            $this->dispatch($job);
        }

//        $deviceToken = '32e12d77acb252f7a532942c53a422c4e26d5f992cdc654d58a91368d9c7b927';
//        $job = (new SendPushNotification($device_type,$push_message,$badge_count,$custom_array,$deviceToken));
//        $this->dispatch($job);
    }

}