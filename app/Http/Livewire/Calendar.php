<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;

class Calendar extends Component
{
    
    public $events = '';
    public $successM = '';
    public $errorM = '';
    public $x;


    public function getevent()
    {
        $events = Event::select('id', 'title', 'start')->get();

        return  json_encode($events);
    }


    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        $this->x = Event::create($input);
        
    }


    public function eventDrop($event, $oldEvent)
    {

        if(array_key_exists('id', $event)){
            $eventdata = Event::find($event['id']);
            $eventdata->start = $event['start'];
            $eventdata->save();
            
        }else{
            $this->errorM = __('Refresh the page before moving the event');
        }
    }
    public function render()
    {
        $events = Event::select('id', 'title', 'start')->get();

        $this->events = json_encode($events);

        $events2 = Event::select('id', 'title', 'start')->get();

        return view('livewire.calendar',['events2' => $events2]);
    }

    public function clearMessage()
    {
        $this->errorM = '';
        $this->successM = '';
    }

    public function delete($id)
    {
        $event = Event::find($id);
        $event->delete();
        $this->successM = __('Deleted successfully, edits will appear after refreshing the page');
    }

}


