<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    
	protected $fillable = ['official_time_in', 'official_time_out'];
	protected $primaryKey = 'user_id';
    public function users()
    {
		
    	return $this->belongsTo('App\Users');
    }
}
