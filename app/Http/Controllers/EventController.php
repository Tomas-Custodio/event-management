<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $events = Event::with(['user','attendees'])->get();

        // return response()->json(['data' => $events], 200);

        return EventResource::collection($events);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([ 
            
                'name' => "required|string",
                'description' => "required|string",
                'user_id' => "required|integer",
                'start_time' => "required|string",
                'end_time' => "required|string",]);

        $newEvent = Event::create($data);

        new EventResource($newEvent);


    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        new EventResource($event);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {

        $data = $request->validate([ 
            
                'name' => "required|string",
                'description' => "required|string",
                'user_id' => "required|integer",
                'start_time' => "required|string",
                'end_time' => "required|string",]);

        $event->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
         $event->delete();
    }
}
