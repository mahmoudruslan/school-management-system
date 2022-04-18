<div class="modal fade" id="edit{{$grade ->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('Edit Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('grades.update', 'test')}}" method="post">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">{{ __('Grade Name_ar') }}:</label>
                            <input value="{{ $grade->name_ar }}" type="text" name="name_ar" class="form-control">
                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $grade->id }}">
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">{{ __('Grade Name_en') }}:</label>
                            <input value="{{ $grade->name_en }}" type="text" class="form-control" name="name_en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ __('Notes') }}:</label>
                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $grade->notes}}</textarea>
                    </div>
                    <br><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                    </div>
                </form>
                <!-- end add_form -->
            </div>
        </div>
    </div>
</div>
