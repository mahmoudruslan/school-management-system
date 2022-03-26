@extends('admin_dashboard.layout.master')

@section('title')
    {{ __('Add book') }}
@stop

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card-body">
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ __('Book name') }}</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="grade_id">{{ trans('Grade') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="grade_id">
                                            <option selected disabled>{{ trans('Choose Grade') }}...</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}">
                                                    {{ $grade['name_' . app()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="classroom_id">{{ trans('Classroom') }} : <span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="classroom_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{ trans('Section') }} : </label>
                                        <select class="custom-select mr-sm-2" name="section_id">
                                        </select>
                                    </div>
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="formFileMultiple"
                                            class="form-label">{{ __('Attachments') }}</label>
                                        <input class="form-control" type="file" id="formFileMultiple" name="file_name"
                                            required>
                                        <input type="hidden" name="teacher_id" value="2">
                                    </div>
                                </div>
                            </div><br>
                            <button class="button"
                                type="submit">{{ __('Submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
