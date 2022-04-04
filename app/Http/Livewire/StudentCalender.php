<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Event;

class StudentCalender extends Component
{
    
    public $events = '';

    public function render()
    {
        $events = Event::select('id', 'title', 'start')->get();

        $this->events = json_encode($events);

        $events2 = Event::select('id', 'title', 'start')->get();

        return view('livewire.student-calender',['events2' => $events2]);
    }




}


