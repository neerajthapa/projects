<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use \Danjdewhurst\PassportFacebookLogin\FacebookLoginTrait;
 

class User extends Authenticatable  
{
	
	use HasApiTokens, Notifiable;
	
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
'first_name', 'last_name', 'email', 'phone' , 'password' , 'photo' ,'thumb_photo' , 'user_type' , 'otp' , 'status' ,'vendor_id' , 'remember_token' , 'email_token','longitude','latitude','commission','referral_code','facebook_id','store_id','app_type'
    ];

protected $table = 'user';
	
	protected $primaryKey = 'user_id';
	    public function resolve($network, $accessToken, $accessTokenSecret = null)
    {
        switch ($network) {
            case 'facebook':
                return $this->authWithFacebook($accessToken);
                break;
            default:
                throw SocialGrantException::invalidNetwork();
                break;
        }
    }
    
	
	
	
	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password' 
    ];
	
	
 
		public function orders()
    {
        return $this->hasMany('App\Orders','user_id');
    }

	
 public function getCreatedAtFormattedAttribute($value) {
         return  \Carbon\Carbon::parse($this->created_at)->diffforhumans();
    }

     public function getLoyaltyPointsAttribute($value) {
         $loyalty_points = @\App\LoyaltyPoints::where('user_id',$this->user_id)->sum('points');
         if($loyalty_points < 1)
         {
            return 0;
         }
         else
         {
            return round($loyalty_points,2);
         }
    }


     public function getTotalTasksAttribute($value) {
        if($this->user_type == '5')
        {
            return  @\App\Task::where('driver_id',$this->user_id)->count();
        }
        else
        {
            return  0;
        }
        
    }





         public function getLatestTaskAttribute($value) {
        if($this->user_type == '5')
        {
            return  @\App\Task::where('driver_id',$this->user_id)->orderBy('task_id','DESC')->take(1)->get();
        }
        else
        {
            return  [];
        }
        
    }
	
	
	
 
 public function toArray()
    {
        $array = parent::toArray();
        foreach ($this->getMutatedAttributes() as $key)
        {
            if ( ! array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};   
            }
        }
        return $array;
    }

 



    public function addNew($input)
    {
        $check = static::where('facebook_id',$input['facebook_id'])->first();


        if(is_null($check)){
            return static::create($input);
        }


        return $check;
    }


	
	

}
