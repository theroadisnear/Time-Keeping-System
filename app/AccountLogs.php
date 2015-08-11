<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AccountLogs extends Model
{
    protected $fillable = ['account_id', 'user_id', 'message_logs'];

	public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Manila')
            ->toDateTimeString();
    }

    public function accountLogs()
    {
    	return $this->belongsTo('App\Accounts');
    }
}
