<div>
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="tab-pane fade active show" id="months2" role="tabpanel" aria-labelledby="months-tab2">
                        {{-- contant 1 --}}
                        @if (!empty($successM))
                            <div class="alert alert-success">
                                <button type="button" class="close" wire:click="clearMessage">x</button>
                                {{ $successM }}
                            </div>
                        @endif
                        @if (!empty($errorM))
                            <div class="alert alert-danger">
                                <button type="button" class="close" wire:click="clearMessage">x</button>
                                {{ $errorM }}
                            </div>
                        @endif
                        <div id='calendar-container' wire:ignore>
                            <div id='calendar'></div>
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
            var calendarEl = document.getElementById('calendar');
            var data = @this.events;
            var calendar = new Calendar(calendarEl, {
                events: JSON.parse(data),
            });
            calendar.render();
        });
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush
