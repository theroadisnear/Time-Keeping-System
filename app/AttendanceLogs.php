<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Users;

class AttendanceLogs extends Model
{
    protected $fillable = ['date_time_in', 'date_time_out', 'time_rendered', 'message_logs'];

    public function attendanceLogs()
    {
    	return $this->belongsTo('App\Users');
    }
}
