<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Attendee;
use App\Models\Event;

use App\Http\Resources\AttendeeResource;

class AttendeeController extends Controller {

    /**
     * Display a listing of the resource.
     */

    public function index( Request $request, Event $event) {
        
        $request = $request->boolean('attendwithevent');

        $attendees = $event->attendees()->latest()->paginate();
        return AttendeeResource::collection($attendees);

    }

    public function show( Event $event, Attendee $attendee) {

        return new AttendeeResource($attendee);
    }

    public function store(Request $request, Event $event){

        $data =$event->attendees()->create([

            'user_id' => 1,
            'event_id' => $event->id  
        ]);

        return new AttendeeResource($data);
    }


    public function update(Request $request, Attendee $attendee){

        $attendee->update(['event_id' => $attendee->event->id]);
        return new AttendeeResource($attendee);
    }

    public function destroy( Event $event, Attendee $attendee) {

        $attendee->delete();
        return response()->json([

            'msg' => "cliente deleteado com sucesso"],200);
}}