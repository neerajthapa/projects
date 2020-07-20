<?php

namespace App\Http\Controllers\Test; 
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

class testController extends Controller 
{
	
 public function testroute()
 {
	 return 'test';
 }
}