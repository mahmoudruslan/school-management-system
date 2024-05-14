@extends('admin_dashboard.layout.master')
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

    <?php $x = 0; ?>
    @forelse ($results_grades as $student_result)
        <div class="accordion gray plus-icon round">

            <div class="acd-group">
                <a href="#" class="acd-heading">{{ $student_result->grade['name_' . app()->getLocale()] }}
                    {{ $student_result->academic_year }}</a>
                <div class="acd-des">
                    {{-- start my according classrooms --}}
                    @forelse ($results_classrooms->where('grade_id', $student_result->grade_id) as $result_classroom)
                        <!--calssroom to evrey result-->
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header text-center" id="headingTwo">
                                    <button class="btn btn-light collapsed" data-toggle="collapse"
                                        data-target="#collapseOne{{ $x }}" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        <h5 class="mb-0">
                                            {{ $result_classroom->classroom['name_' . app()->getLocale()] }}<!--name of classroom-->
                                        </h5>
                                    </button>
                                </div>
                                <div id="collapseOne{{ $x }}" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
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
                        @empty
                        <tr>{{ __('No results') }}</tr>
                    @endforelse
                    {{-- end my according classrooms --}}
                </div>
            </div>
        </div>
        @empty
        <tr>{{ __('No results') }}</tr>
    @endforelse

@endsection
