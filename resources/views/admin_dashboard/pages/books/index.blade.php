@extends('admin_dashboard.layout.master')

@section('title')
    {{ __('Books') }}
@stop

@section('content')
    <!-- row -->

    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card-body">
                        <a href="{{ route('books.create') }}" class="button"
                            type="button">{{ __('Add book') }}</a>
                        <br><br>
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Book name') }}</th>
                                        <th>{{ __('Teacher Name') }}</th>
                                        <th>{{ __('Grade') }}</th>
                                        <th>{{ __('Classroom') }}</th>
                                        <th>{{ __('Section') }}</th>
                                        <th>{{ __('Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->admin['name_' . app()->getLocale()] }}</td>
                                            <td>{{ $book->grades['name_' . app()->getLocale()] }}</td>
                                            <td>{{ $book->classrooms['name_' . app()->getLocale()] }}</td>
                                            <td>{{ $book->sections['name_' . app()->getLocale()] }}</td>
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
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_book{{ $book->id }}"
                                                    title="{{ __('Delete') }}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @include('admin_dashboard.pages.books.destroy')
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
