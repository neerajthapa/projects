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
use Mail;
use Hash;
 
 
use App\Traits\one_signal; // <-- you'll need this line...


class UsersController extends Controller 
{
    
  use one_signal; 
    
   
   public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(request $request)
    {
		
		
        // get all the users
        $users = User::orderBy('id','desc')->paginate(10);  
		if ($request->ajax()) {
            return view('admin.users.data-ajax', compact('users'));
        }
 		return view('admin.users.index')->with('users', $users);
    }
	
		   


		   public function user_by_status(request $request, $status)
    {
		// get all the users
        $users = User::where('status',$status)->orderBy('id','desc')->paginate(10);  
		if ($request->ajax()) {
            return view('admin.users.data-ajax', compact('users'));
        }
 		return view('admin.users.index')->with('users', $users );
    }
	
	
	
	
	public function user_by_verified(request $request, $verified)
    {
		   // get all the users
        $users = User::where('verified',$verified)->orderBy('id','desc')->paginate(10);  
		if ($request->ajax()) {
            return view('admin.users.data-ajax', compact('users'));
        }
 		return view('admin.users.index')->with('users', $users );
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $countries = DB::table('countries')->get();        
      return view('admin.users.create')->with('countries',$countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
		
		 
        $validator = Validator::make($request->all(), [
        'first_name' => 'required|max:255|alpha',
        'last_name' => 'required|max:255|alpha',
        'email' => 'required|email|max:255|unique:users',
        'password'  =>  'required|min:6|confirmed|alpha_num',
        'country_id' => 'required',
         ]);
        if ($validator->fails()) {
          //print_r($validator->errors()->all());die;
            return redirect('/admin/user/create')
                ->withInput()
                ->withErrors($validator);
        }

        $mail = DB::table('mails')->where('id', '1')->first();
        
        /* Mail Code Start */
        $emailData = array(
        'to'        => $request->email, 
        'from'      => 'rahul.katara@endivesoftware.com',
        'subject'   => $mail->subject,
        'view'      => 'admin.mail.register',
        'email'   => $request->email,
        'password' => $request->password,
        );      
        Mail::send($emailData['view'], $emailData, function ($message) use ($emailData) {
            $message
                ->to($emailData['to'])
                ->from($emailData['from'])
                ->subject($emailData['subject']);
        });     
        /* Mail Code End */
        $user = new User;
        $user->first_name  = $request->first_name;
        $user->last_name   = $request->last_name;
        $user->email  = $request->email;
        $user->country_id   = $request->country_id;
        $user->password  =  Hash::make($request->password);
        $user->user_group_id = 2;
        $user->status = 1;
        $user->save();

        $user_points['user_id'] = $user->id;
        $user_points['points'] = 5;
        UserPoint::create($user_points);

        $user_point_history['user_id'] = $user->id;
        $user_point_history['point'] = 5;
        $user_point_history['type'] = 'Get';
        UserPointHistory::create($user_point_history);
        // redirect
        Session::flash('message', 'Successfully created user!');
        return redirect('admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
	 
	 
	 
	     // 1 use to get bitcoins balance of user from transactions table
 	public function get_user_bitcoin_balance(Request $request , $type='' , $user_id = '')
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
					// call bitcoins api
					
				 $balance =  \App\Transactions::where('user_id',$user_id)->sum('amount');
	 
		 
		          $d = array();
if($balance == '' or $balance == null or $balance == ' ')
{
$balance = 0;
}

if($type =='ajax')
{
return $balance;
}

		          $d1['balance'] = $balance;
		          $d[] = $d1;
			 
		            if($balance != '')
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Operation Successful';
                          $data['data']      =   $d;  
				    }
					else
					{
						  $data['status_code']    =   1;
                          $data['status_text']    =   'Success';             
                          $data['message']        =   'Operation Successful';
                          $data['data']      =   $d;  
					}
				   
	            return $data;
				}
	}
	
	
	
	
    public function show(Request $request ,$id='' , $type=''  )
    {   
        if(!is_numeric($id))
        {
         return redirect('admin/user');   
        }
        // get the testimonial
        $user = User::where('id',$id)->get();
		
		$user[0]['followers_count']   = @\App\UsersRelations::where('recipient_id',$id)->where('status','1')->count();
		$user[0]['followings_count']   = @\App\UsersRelations::where('user_id',$id)->where('status','1')->count();
		$user[0]['bitcoin_balance']   = $this->get_user_bitcoin_balance( $request , 'ajax', $id );
		$user[0]['total_orders']   =  @\App\Orders::where('user_id',$id)->where('status','<>','completed')->count();
		$user[0]['total_trades']   =  @\App\Trades::where('seller_id',$id)->orWhere('buyer_id',$id)->where('status','<>','completed')->count();
		
	 if($type != '' && $type != null && $type == 'ajax')
	 {
		 return $user;
	 }
       // show the view and pass the nerd to it
        return view('admin.users.show')
            ->with('user', $user)->with('user_id',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(!is_numeric($id))
        {
         return redirect('admin/user');   
        }
        $countries = DB::table('countries')->get();   
        $user = User::find($id);

		
	 
        // show the edit form and pass the nerd
        return view('admin.users.edit')
            ->with('user', $user)->with('countries', $countries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id , Request $request)
    {
                // validate
        if(!is_numeric($id))
        {
         return redirect('admin/user');   
        }
  
  
            // store
            $user = User::find($id);
            $user->first_name  = $request->first_name;
			$user->last_name  = $request->last_name;
            $user->email   = $request->email;
            $user->phone  = $request->phone;
			$user->address  = $request->address;
			$user->about  = $request->about;
 
            $user->country   = $request->country_name;                                    
            $user->save();

            // redirect
            Session::flash('message', 'Successfully updated user!');
            return redirect('admin/user');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('message', 'Successfully deleted the user!');
        return redirect('admin/user');
    }
	public function block($id)
	{
	        $user = User::find($id);
            $user->status  = '0';
            $user->save();
			Session::flash('message', 'Successfully Blocked the user!');
			
			$notification_token= User::where('id',$id)->first(["notification_token"])->notification_token;
	        $this->notification_to_single($notification_token, 'You are Blocked' , 'You are blocked from loyatyApp by Admin');
				
		    return back();
	}
		public function unblock($id)
	{
	        $user = User::find($id);
            $user->status  = '1';
            $user->save();
			Session::flash('message', 'Successfully Unblocked the user!');
			
			$notification_token= User::where('id',$id)->first(["notification_token"])->notification_token;
	        $this->notification_to_single($notification_token, 'You are Unblocked' , 'You are Unblocked from loyatyApp by Admin');
		 		 
			return back();
	}
	
	
	
	
	
	
	
	
	
	
	
		public function verify($id)
	{
	        $user = User::find($id);
            $user->verified  = '1';
            $user->save();
			Session::flash('message', 'Successfully Verified the user!');
			
			$notification_token= User::where('id',$id)->first(["notification_token"])->notification_token;
	        $this->notification_to_single($notification_token, 'You are Blocked' , 'You are Verified by Admin');
				
		    return back();
	}
	
	
		public function unverify($id)
	{
	        $user = User::find($id);
            $user->verified  = '0';
            $user->save();
			Session::flash('message', 'Successfully UnVerified the user!');
			
			$notification_token= User::where('id',$id)->first(["notification_token"])->notification_token;
	        $this->notification_to_single($notification_token, 'You are Unblocked' , 'You are UnVerified by Admin');
		 		 
			return back();
	}
	
	
	
	
 
	
	
	
	
	//new services===================================================================
	
	public function users_orders(Request $request , $user_id = '')
	{
		 $user = $this->show( $request ,$user_id , 'ajax'  );
		 $data = @\App\Orders::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
	 
		 return view('admin.users.users_orders')->with('user', $user)->with('data', $data)->with('user_id', $user_id);
    }
	
	
	
		public function users_trades(Request $request , $user_id = '')
	{
		 $user = $this->show( $request ,$user_id , 'ajax'  );
		 $data =  @\App\Trades::where('seller_id',$user_id)->orWhere('buyer_id',$user_id)->paginate(10);
		 return view('admin.users.users_trades')->with('user', $user)->with('data', $data)->with('user_id', $user_id);
    }
	
	
	
	
		public function users_transactions(Request $request , $user_id = '')
	{
		 $user = $this->show( $request ,$user_id , 'ajax'  );
		 $data = @\App\Transactions::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
		 return view('admin.users.users_transactions')->with('user', $user)->with('data', $data)->with('user_id', $user_id);
    }
	
	 
	
		public function users_posts(Request $request , $user_id = '')
	{
		 $user = $this->show( $request ,$user_id , 'ajax'  );
		 $data = @\App\Posts::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
		 return view('admin.users.users_posts')->with('user', $user)->with('data', $data)->with('user_id', $user_id);
    }
	
	
	
			public function users_trades_posts(Request $request , $user_id = '')
	{
		 $user = $this->show( $request ,$user_id , 'ajax'  );
		 $data = @\App\TradesPosts::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
		 return view('admin.users.users_trades_posts')->with('user', $user)->with('data', $data)->with('user_id', $user_id);
    }
	
 
	
 public function trades_posts_details(Request $request,$trades_posts_id= '' , $user_id = '' )
 {
	 
 
	 	 $user = $this->show( $request ,$user_id , 'ajax'  );
		 $data = @\App\TradesPosts::where('id',$trades_posts_id)->orderBy('id','DESC')->paginate(10);
		 return view('admin.users.users_trades_posts_details')->with('user', $user)->with('data', $data)->with('user_id', $user_id);
	 
 }
	
	
	
	
	
	
	
	
	

}