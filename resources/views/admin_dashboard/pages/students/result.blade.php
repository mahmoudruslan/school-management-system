@extends('admin_dashboard.layout.master')
@section('title')
    {{ __('Student Results') }}
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
                                                {{ $result->classrooms->name_ar }}
                                            </h5>
                                        </button>
                                    </div>
                                    <div id="collapseOne{{ $x }}" class="collapse"
                                        aria-labelledby="headingTwo" data-parent="#accordion">
                                        <?php $x++; ?>

                                        <div class="card-body">
                                            {{-- start my table --}}
                                            <div class="d-block d-md-flex justify-content-between">
                                                <div class="d-block">
                                                </div>
                                            </div>
                                            <div class="table-responsive mt-15">
                                                <table class="table table-hover table-sm table-bordered p-5"
                                                    data-page-length="50" style="text-align: center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>{{ __('Subject Name') }}</th>
                                                            <th>{{ __('Degree') }}</th>
                                                            <th>{{ __('From') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($student_result->where('classroom_id', $result->classrooms->id) as $result_term)
                                                            <tr>
                                                                <th class="p-15" scope="row">
                                                                    {{ $result_term->subjects['name_' . app()->getLocale()] . '-' . __($result_term->term) }}
                                                                </th>
                                                                <td class="p-15">{{ $result_term->degree }}</td>
                                                                <td class="p-15">{{ $result_term->from }}</td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <th class="p-15 alert-danger" scope="row">{{ __('المجموع') }}
                                                            </th>
                                                            <td class="p-15 alert-danger">
                                                                {{ $student_result->where('classroom_id', $result->classrooms->id)->sum('degree') }}
                                                            </td>
                                                            <td class="p-15 alert-danger">
                                                                {{ $student_result->where('classroom_id', $result->classrooms->id)->sum('from') }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{-- end my table --}}
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
