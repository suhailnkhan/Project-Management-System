<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //

    protected $fillable = ['body', 'subject', 'sent_to_id', 'sender_id'];

    // A message belongs to a sender
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // A message also belongs to a receiver
    public function receiver()
    {
        return $this->belongsTo(User::class, 'sent_to_id');
    }



}
