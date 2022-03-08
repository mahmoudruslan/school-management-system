<div class="tab-pane fade" id="student-attachment" role="tabpanel" aria-labelledby="profile-02-tab">
    <div class="card card-statistics">
        <div class="card-body">
            <form method="POST" action="{{ route('save.attachments', $student->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-3" style="display: inline-block">
                    <div class="form-group">
                        <input accept="image/*" name="photos[]" type="file" class="custom-file-input" id="customFile"
                            multiple required>
                        <label class="custom-file-label" for="customFile">{{ __('Attachments') }}: <span
                                class="text-danger">*</span></label>
                        <input type="hidden" name="name_ar" value="{{ $student->name_ar }}">
                        <input type="hidden" name="model" value="Student">
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary mt-2 p-1">
                    {{ __('Submit') }}
                </button>
            </form><br><br><br>
            <!-- The grid: four columns -->
            <div class="row">
                @foreach ($student->images as $image)
                    <div class="column">
                        <button data-toggle="modal"
                            data-target="#delete_img{{ $image->id }}.{{ $image->filename }}.{{ $student->id }}"
                            type="submit" class="mybutton btn btn-sm btn-danger">
                            <span><i class="fa fa-trash"></i></span>
                        </button>
                        <img class="myimg" style="width: 100%;height: 100%"
                            src="{{ URL::asset('attachments/Students/' . $student->name_ar . '/' . $image->filename) }}"
                            alt="" onclick="myFunction(this);">
                        <div class="desc">{{ $image->filename }}</div>
                    </div>
                    @include('pages.students.delete-image')
                @endforeach
            </div>
            <!-- The expanding image container -->
            <div class="show-container mt-10">
                <!-- Close the image -->
                <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
                <!-- Expanded image -->
                <img id="expandedImg" style="width:80%">
                <!-- Image text -->
                <div id="imgtext"></div>
            </div>
            <br>
        </div>
    </div>
</div>
