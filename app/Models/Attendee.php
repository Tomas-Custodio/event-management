<?php

namespace App\Models;

use App\Models\Event;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;





class Attendee extends Model {

    /** @use HasFactory<\Database\Factories\AttendeeFactory> */
    use HasFactory;

    protected $fillable =[
        'user_id',
        'event_id'
    ];


     public function user():BelongsTo {

        return $this->BelongsTo(User::class,'user_id');
    }

     public function event():BelongsTo {

        return $this->BelongsTo(Event::class,'event_id');
    }
}