<!-- حذف مجموعة طلاب -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('Permanent delete') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('Graduated.destroy','test')}}" method="POST">
                @csrf
                {{ method_field('Delete') }}
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                </h5>
                <div class="modal-body">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        {{__('Warning')}}
                        :{{ __('The student will be permanently deleted and all attachments will be deleted') }}.
                    </h5>
                    <input class="text" type="hidden" id="delete_all_id" name="ids" value=''>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- حذف طالب واحد -->

<div class="modal fade" id="exampleModal{{$student->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('Graduated.destroy','test')}}" method="POST">
                {{ method_field('Delete') }}
                @csrf
                <div class="modal-body">
                <input type="hidden" name="ids" value='{{$student->id}}'>
                    <h5>
                        {{__('Warning')}}:{{ __('The student will be permanently deleted and all attachments will be deleted') }}.
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
