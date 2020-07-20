<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
	
      protected $fillable = ['first_name', 'last_name', 'status', 'email', 'password', 'user_group_id', 'remember_token', 'store_brand_id', 'store_notification_text', 'store_beacon_UDID', 'latitude', 'longitude', 'short_address', 'long_address', 'store_qrcode', 'user_type','store_qrcode_string','photo'];
	
}
