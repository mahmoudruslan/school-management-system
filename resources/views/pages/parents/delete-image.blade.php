<div class="modal fade" id="delete_img{{$image->id}}.{{$image->filename}}.{{$parent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('delete.attachments',$image->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="model" value="TheParent">
                    <input type="hidden" name="filename" value="{{$image->filename}}">
                    <input type="hidden" name="name_ar" value="{{$parent->name_father_ar}}">
                    <h5 style="font-family: 'Cairo', sans-serif;">{{__('Warning')}}:</h5>
                    <h6>{{__('Are you sure you want to delete this attachment?')}}</h6>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button  class="btn btn-danger">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
