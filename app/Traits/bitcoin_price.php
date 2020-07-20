<?php // Code in app/Traits/MyTrait.php

namespace App\Traits;

trait bitcoin_price
{
    protected function bitcoin_price($name)
    {
        return $name;
    }
	
	
	
    public function currency_bitcoin_price(Request $request)
    {        
	 
	               // $countries = Country::get(["country_name","nicename"]);
					$allarray = array();
			 
			        $data_array = array();
					$d["bitcoin_price"] = 1000;
					$data_array[] = $d;
			         
				 	$data['status_code']    =   1;                      
                    $data['status_text']    =   'Success';
                    $data['message']        =   'Bitcoin Price Fetched';
                    $data['data']      =   $data_array;
		   return $data;
	}
	
	
	
	public function currency_amount_bitcoin_price($currency_code = '')
    {        
	 
	                //$countries = Country::get(["country_name","nicename"]);
					$allarray = array();
			 
			        $data_array = array();
					$d["bitcoin_price"] = 1000;
					$data_array[] = $d;
			         
				 	$data['status_code']    =   1;                      
                    $data['status_text']    =   'Success';
                    $data['message']        =   'Bitcoin Price Fetched';
                    $data['data']      =   $data_array;
		   return $data;
	}
 
 
 
}