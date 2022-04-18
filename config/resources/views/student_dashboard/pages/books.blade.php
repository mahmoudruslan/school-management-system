@extends('student_dashboard.layout.master')

@section('title')
    {{ __('Books') }}
@stop

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
                <div class="col-xl-12 mb-30">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50" style="text-align: center">
                                <thead>
                                    <tr class="alert-success">
                                        <th>{{ __('Book name') }}</th>
                                        <th>{{ __('Teacher Name') }}</th>
                                        <th>{{ __('Processes') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->admin['name_' . app()->getLocale()] }}</td>

                                            @foreach ($book->images as $img)
                                                <td>{{ $img->id }}</td>
                                            @endforeach
                                            <td>
                                                <form class="d-inline"
                                                    action="{{ route('books.download', $book->file_name) }}"
                                                    method="GET">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="file_name" value="{{ $book->file_name }}">
                                                    <input type="hidden" name="title" value="{{ $book->title }}">
                                                    <button type="submit" class="btn btn-primary btn-sm" role="button"><i
                                                            class="fas fa-download"></i></button>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
