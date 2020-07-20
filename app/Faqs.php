<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
        protected $fillable = [ 'question', 'answer', 'app_type'];
		protected $table = 'faqs';
		
		
        
 public function getCreatedAtFormattedAttribute($value) {
         return  \Carbon\Carbon::parse($this->created_at)->diffforhumans();
    }

 public function getCreatedAtFormatted2Attribute($value) {
         return  \Carbon\Carbon::parse($this->created_at)->format('M d, Y');
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
	
}