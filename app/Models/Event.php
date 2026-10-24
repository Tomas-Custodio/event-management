<?php

namespace App\Models;

use App\Models\User;
use App\Models\Attendee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [

        'name','description','user_id','start_time','end_time',
    ];


     public function user() {

        return $this->BelongsTo(User::class,'user_id');
    }

     public function attendees() {

        return $this->hasMany(Attendee::class,'event_id');
    }
}
