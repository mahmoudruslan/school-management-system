<!-- إرجاع مجموعة طلاب -->
<div class="modal fade" id="return_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('Return the students') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('return.students')}}" method="GET">
                @csrf
                {{ method_field('Delete') }}
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                </h5>
                <div class="modal-body">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        {{__('Warning')}}:{{ __('The student will return to the stage in which he was, and the registration status will remain for re-entry') }}.
                    </h5>
                    <input class="text" type="hidden" id="return_all_id" name="ids" value=''>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('Close') }}
                    </button>
                    <button type="submit" class="btn btn-info">{{ trans('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- إرجاع طالب -->
<div class="modal fade" id="return_all{{$student->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('Return the students') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('return.students')}}" method="GET" class="d-inline-block">
                @csrf
                <div class="modal-body">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{__('Warning')}}:{{ __('The student will return to the stage in which he was, and the registration status will remain for re-entry') }}.
                    </h5>
                    <input type="hidden" name="ids" value="{{$student->id}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-info">{{__('Return')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
