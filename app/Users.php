<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Images;

class Users extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

    protected $fillable = [
    	'usernumber',
    	'lastname',
    	'firstname',
    	'middleinitial',
    	'birthday',
    	'department',
    	'deleted_at',
        'status',
    ];

    public function images()
    {
    	return $this->hasOne('App\Images', 'App\Shifts', 'App\AttendanceLogs', 'App\Accounts');
    }
}
