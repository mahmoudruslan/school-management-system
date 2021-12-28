<div class="modal fade" id="delete{{$teacher ->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Warning')}}:
                    {{ __('Are you sure you want to delete the teacher?') }}
                </h5>
            </div>
            <div class="modal-footer">
                <form action="{{ route('Teachers.destroy','test') }}" method="POST">
                    {{ method_field('Delete') }}
                    @csrf
                    <input type="hidden" name="id"  value="{{$teacher ->id}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('Close') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
