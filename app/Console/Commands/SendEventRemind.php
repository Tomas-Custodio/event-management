<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventRemindNotification;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

#[Signature('app:send-event-remind')]
#[Description('Send notifications to event attendees')]

class SendEventRemind extends Command {
    public function handle() {

        $events = Event::with('attendees.user')
            ->whereBetween('start_time', [ now(),now()->addDay()])->get();

        $eventCount = $events->count();
        $eventLabel = Str::plural('event', $eventCount);

        $this->info("Found {$eventCount} {$eventLabel}");

        $events->each(

                fn ($event) => $event->attendees->each(

                    fn ($attendee) => $attendee->user->notify(
                        new EventRemindNotification($event)
                    )
                )
        );

        $this->info('Reminder notifications processed successfully');

        return self::SUCCESS;
    }
}