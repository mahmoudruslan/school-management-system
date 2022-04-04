<div>
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="tab nav-border" style="position: relative;">
                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block w-100">
                                <h5 class="card-title">{{__('Calender')}}</h5>
                            </div>
                            <div class="d-block d-md-flex nav-tabs-custom">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="months-tab2" data-toggle="tab"
                                            href="#months2" role="tab" aria-controls="months2" aria-selected="true">
                                            {{__('Calender')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="year-tab2" data-toggle="tab" href="#year2"
                                            role="tab" aria-controls="year2" aria-selected="false">{{__('All events')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="months2" role="tabpanel"
                                aria-labelledby="months-tab2">
                                {{-- contant 1 --}}

                                @if (!empty($successM))
                                    <div class="alert alert-success">
                                        <button type="button" class="close"
                                            wire:click="clearMessage">x</button>
                                        {{ $successM }}
                                    </div>
                                @endif
                                @if (!empty($errorM))
                                <div class="alert alert-danger">
                                    <button type="button" class="close"
                                        wire:click="clearMessage">x</button>
                                    {{ $errorM }}
                                </div>
                            @endif

                                <div id='calendar-container' wire:ignore>
                                    <div id='calendar'></div>
                                </div>

                            </div>


                            <div class="tab-pane fade" id="year2" role="tabpanel" aria-labelledby="year-tab2">
                                {{-- contant 2 --}}
                                <div class="table-responsive ">
                                    <table id="datatable"
                                        class="table table-hover table-sm table-bordered p-0 data-table"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr id="myUL">
                                                <th>#</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Date') }}</th>


                                                <th class="pl-5 pr-4">{{ __('Processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($events2 as $event)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $event->title }}</td>
                                                    <td>{{ $event->start }}</td>
                                                    <td>
                                                        <button style="color: white" data-toggle="modal" data-target="#exampleModal{{$event->id}}"  class="btn btn-danger btn-sm" type="button">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="exampleModal{{ $event->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">

                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>{{ __('Warning') . ' : ' . __('Are you sure you want to delete the event?') }}
                                                                </h6>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ __('Close') }}</button>
                                                                <button type="submit"
                                                                    wire:click="delete({{ $event->id }})"
                                                                    data-dismiss="modal"
                                                                    class="btn btn-danger">{{ __('Delete') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('calendar');
            var checkbox = document.getElementById('drop-remove');
            var data = @this.events;
            var calendar = new Calendar(calendarEl, {
                events: JSON.parse(data),
                dateClick(info) {
                    var title = prompt('Enter Event Title');
                    var date = new Date(info.dateStr + 'T00:00:00');
                    if (title != null && title != '') {
                        calendar.addEvent({
                            title: title,
                            start: date,
                            allDay: true
                        });
                        var eventAdd = {
                            title: title,
                            start: date
                        };
                        @this.addevent(eventAdd);
                        alert('Great. Now, update your database...');
                    } else {
                        alert('Event Title Is Required');
                    }
                },
                editable: true,
                selectable: true,
                displayEventTime: false,
                droppable: true, // this allows things to be dropped onto the calendar
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
                loading: function(isLoading) {
                    if (!isLoading) {
                        // Reset custom events
                        this.getEvents().forEach(function(e) {
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
                }
            });
            calendar.render();
            @this.on(`refreshCalendar`, () => {
                calendar.refetchEvents()
            });
        });
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush
