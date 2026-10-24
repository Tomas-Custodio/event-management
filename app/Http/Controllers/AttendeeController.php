<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendee;
use App\Http\Resources\AttendeeResource;

class AttendeeController extends Controller {

    public function index( Event $event) {

        $attendees = $event->attendees()->latest()->paginate();
        return AttendeeResource::collection($attendees);
        
    }

    public function show( Event $event, Attendee $attendee) {

        return new AttendeeResource($attendee);
    }

    public function store(Request $request, Event $event){

        $data =$event->attendees()->create([

            'user_id' => 1,
            'event_id' => 1  
        ]);

        return new AttendeeResource($data);
    }

    public function destroy( Event $event, Attendee $attendee) {

        $attendee->delete();
        return response()->json([
            'msg' => " cliente deleteado com sucesso"],200);
    }
}