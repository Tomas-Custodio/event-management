<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Traits\CanLoadRelationShips;
use Illuminate\Support\Facades\Gate;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller {

    public function index(Request $request) {

    
        $query = Event::query();

        $eventwithattendees = $request->boolean('eventwithattendees');

        $eventwithuser = $request->boolean('eventwithuser');

        if ($eventwithattendees) {

            $query->with('attendees');
        }

        if ($eventwithuser){

             $query->with('user');
        }
       
        return EventResource::collection($query->get());}

    public function store(Request $request) {

        $data = $request->validate([ 
            
                'name' => "required|string",
                'description' => "required|string",
                'user_id' => "required|integer",
                'start_time' => "required|string",
                'end_time' => "required|string",]);

        $newEvent = Event::create($data);
        new EventResource($newEvent);

    }

    public function show(Event $event) {

        #Gate::authorize('cando',$event);
        new EventResource($event);
    }

    public function update(Request $request, Event $event) {
        
        #Gate::authorize('cando',$event);

        $data = $request->validate([ 

                'name' => "required|string",
                'description' => "required|string",
                'user_id' => "required|integer",
                'start_time' => "required|string",
                'end_time' => "required|string", ]);

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