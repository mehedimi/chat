<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = [
		'message'
	];

	protected $appends = ['send_date'];


    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getsendDateAttribute()
    {
    	return $this->created_at->format('d, M h:m a');
    }
}
