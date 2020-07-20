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
use App\Admin;
use Hash;
use Mail;
 
 
use App\Traits\one_signal; // <-- you'll need this line...


class AdminController extends Controller 
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
        $users = Admin::where("user_type",'admin')->orderBy('id','desc')->paginate(50);  
		if ($request->ajax()) {
            return view('admin.admin.data-ajax', compact('users'));
        }
 		return view('admin.admin.index')->with('users', $users);
    }
	
		   
		   public function user_by_status(request $request, $status)
    {
		// get all the users
        $users = Admin::where('status',$status)->where("user_type",'admin')->orderBy('id','desc')->paginate(10);  
		if ($request->ajax()) {
            return view('admin.admin.data-ajax', compact('users'));
        }
 		return view('admin.admin.index')->with('users', $users );
    }
	 
	public function user_by_verified(request $request, $verified)
    {
		   // get all the users
        $users = Admin::where('verified',$verified)->orderBy('id','desc')->paginate(10);  
		if ($request->ajax()) {
            return view('admin.users.data-ajax', compact('users'));
        }
 		return view('admin.admin.index')->with('users', $users );
    }
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $countries = DB::table('countries')->get();        
      return view('admin.admin.create')->with('countries',$countries);
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
        
         ]);
        if ($validator->fails()) {
          //print_r($validator->errors()->all());die;
            return redirect('/admins/admin/create')
                ->withInput()
                ->withErrors($validator);
        }

        $mail = DB::table('mails')->where('id', '1')->first();
        
        /* Mail Code Start  
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
        $user = new Admin;
        $user->first_name  = $request->first_name;
        $user->last_name   = $request->last_name;
        $user->email  = $request->email;
        $user->user_type = 'admin';
        $user->password  =  Hash::make($request->password);
  
        $user->status = 1;
        $user->save();
 
 
        // redirect
        Session::flash('message', 'Successfully created admin!');
        return redirect('admins');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {   
        if(!is_numeric($id))
        {
         return redirect('admins');   
        }
        // get the testimonial
        $user = Admin::where('id',$id)->first(['id','first_name','last_name','email', 'status']);
       // show the view and pass the nerd to it
        return view('admin.admin.show')
            ->with('user', $user);
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
         return redirect('admins');   
        }
        $countries = DB::table('countries')->get();   
        $user = Admin::find($id);

        // show the edit form and pass the nerd
        return view('admin.admin.edit')
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
         return redirect('admins');   
        }
  
  
            // store
            $user = Admin::find($id);
            $user->first_name  = $request->first_name;
			$user->last_name  = $request->last_name;
            $user->email   = $request->email;
            $user->status  = $request->status;
                                        
            $user->save();

            // redirect
            Session::flash('message', 'Successfully updated admin!');
            return redirect('admins');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = Admin::find($id);
        $user->delete();
        Session::flash('message', 'Successfully deleted the admin!');
        return redirect('admins');
    }
	public function block($id)
	{
	        $user = Admin::find($id);
            $user->status  = '0';
            $user->save();
			Session::flash('message', 'Successfully Blocked the Admin!');
			
			//$notification_token= Admin::where('id',$id)->first(["notification_token"])->notification_token;
	        //$this->notification_to_single($notification_token, 'You are Blocked' , 'You are blocked from loyatyApp by Admin');
				
		    return back();
	}
		public function unblock($id)
	{
	        $user = Admin::find($id);
            $user->status  = '1';
            $user->save();
			Session::flash('message', 'Successfully Unblocked the Admin!');
			
			//$notification_token= Admin::where('id',$id)->first(["notification_token"])->notification_token;
	       // $this->notification_to_single($notification_token, 'You are Unblocked' , 'You are Unblocked from loyatyApp by Admin');
		 		 
			return back();
	}
	
	
		public function verify($id)
	{
	        $user = Admin::find($id);
            $user->verified  = '1';
            $user->save();
			Session::flash('message', 'Admin Verified Successfully');
			
			//$notification_token= Admin::where('id',$id)->first(["notification_token"])->notification_token;
	       // $this->notification_to_single($notification_token, 'You are Verified' , 'You are Successfully Verified by loyatyApp Admin');
				
		    return back();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}