<?php
namespace App\Http\Controllers; //admin add
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
class AppSwitchController extends Controller
{
 
        public function index_grocery(Request $request)
		{
			$request->session()->put('app_type', 'grocery');
			return view('admin-grocery.dashboard.index'); 
		}

	
	    public function index_laundry(Request $request)
		{
			$request->session()->put('app_type', 'laundry'); //return $request->session()->get('name');
			return view('admin-laundry.dashboard.index'); 
		}

	
	
	    public function index_mechanic(Request $request)
		{
			$request->session()->put('app_type', 'mechanic');
			return view('admin-mechanic.dashboard.index'); 
		}

	
	
	    public function index_courier(Request $request)
		{
			$request->session()->put('app_type', 'courier');
			return view('admin-courier.dashboard.index'); 
		}

}