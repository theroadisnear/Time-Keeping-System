<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Users;

class Images extends Model
{
    protected $fillable = ['idpicture', 'try'];

    public function users()
    {
    	return $this->belongsTo('App\Users');
    }
}
