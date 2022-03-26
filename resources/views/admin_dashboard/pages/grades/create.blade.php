<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('Add Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name_ar" class="mr-sm-2">{{ __('Grade Name_ar') }}:</label>
                            <input id="name_ar" type="text" name="name_ar" class="form-control" required>

                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">{{ __('Grade Name_en') }}:</label>
                            <input type="text" class="form-control" name="name_en" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ __('Notes') }}:</label>
                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <br><br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                    </div>
                </form>
                <!-- end add_form -->
            </div>
        </div>
    </div>
</div>
