@extends('student_dashboard.layout.master')
@section('title')
    {{ __('Student Result') }}
@stop

@section('content')
    <!-- start error messages -->
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    {{-- myTable --}}
    @if (!$student_result->isEmpty())
        @if ($debit > $credit)
            <div class="alert alert-danger" role="alert">
                {{ __('Fees must be paid first') }}
            </div>
        @else
            <div class="accordion gray plus-icon round">
                <?php $x = 0; ?>
                <div class="acd-group">
                    <a href="#"
                        class="acd-heading">{{ $student_result->first()->grades['name_' . app()->getLocale()] }}</a>
                    <div class="acd-des">
                        {{-- start my according classrooms --}}
                        @foreach ($classrooms as $result)
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header text-center" id="headingTwo">
                                        <button class="btn btn-light collapsed" data-toggle="collapse"
                                            data-target="#collapseOne{{ $x }}" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            <h5 class="mb-0">
                                                {{ $result->classrooms['name_' . app()->getLocale()] }}
                                            </h5>
                                        </button>
                                    </div>
                                    <div id="collapseOne{{ $x }}" class="collapse"
                                        aria-labelledby="headingTwo" data-parent="#accordion">
                                        <?php $x++; ?>
                                        <div class="card-body">
                                            {{-- first term table --}}
                                            @include('admin_dashboard.pages.students.result.first_term_table')
                                            {{-- first term table --}}
                                            @include('admin_dashboard.pages.students.result.second_term_table')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- end my according classrooms --}}
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="alert alert-danger" role="alert">
            {{ __('No results') }}
        </div>
    @endif
@endsection
