@extends('admin_dashboard.layout.master')

@section('title')
{{ __('admin control panel') }}
@endsection
@section('content')
    <!--=================================Main content ===================================-->
    <!-- main-content -->
    {{-- <div class="content-wrapper"> --}}
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fas fa-users highlight-icon"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('number of students') }}</p>
                            <h4>{{ \App\Models\Student::count() }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('students.index') }}"
                            target="_blank"><span class="text-danger">{{__('Show data')}}</span></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-info">
                                <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('No. Of graduates') }}</p>
                            <h4>{{ $g_count }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('graduated.index') }}"
                            target="_blank"><span class="text-danger">{{__('Show data')}}</span></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-warning">
                                <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('number of teachers') }}</p>
                            <h4>{{ \App\Models\Teacher::count() }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{ route('teachers.index') }}"
                            target="_blank"><span class="text-danger">{{__('Show data')}}</span></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-primary">
                                <i class="fas fa-dollar highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('students in debt') }}</p>
                            <h4>{{$sum}}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="tab nav-border" style="position: relative;">
                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block w-100">
                                <h4 class="mb-0">{{ __('The last operations performed on the system') }}</h4>
                            </div>
                            <div class="d-block d-md-flex nav-tabs-custom">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active show" id="students-tab" data-toggle="tab" href="#students"
                                            role="tab" aria-controls="students" aria-selected="true">{{__('Students')}}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers"
                                            role="tab" aria-controls="teachers" aria-selected="false">{{__('Payments')}}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents"
                                            role="tab" aria-controls="parents" aria-selected="false">{{__('Arrest receipts')}}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="fee_invoices-tab" data-toggle="tab"
                                            href="#fee_invoices" role="tab" aria-controls="fee_invoices"
                                            aria-selected="false">{{__('Invoices')}}
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">

                            {{-- students Table --}}
                            <div class="tab-pane fade active show" id="students" role="tabpanel"
                                aria-labelledby="students-tab">
                                <div class="table-responsive mt-15">
                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                        <thead>
                                            <tr class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{__("Name")}}</th>
                                                <th>{{__("Gender")}}</th>
                                                <th>{{__("Grade")}}</th>
                                                <th>{{__("Classroom")}}</th>
                                                <th>{{__("Section")}}</th>
                                                <th>{{__("Date")}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td>{{$student['name_'.app()->getLocale()]}}</td>
                                                    <td>{{__($student->gender)}}</td>
                                                    <td>{{$student->grades['name_'.app()->getLocale()]}}</td>
                                                    <td>{{$student->classrooms['name_'.app()->getLocale()]}}</td>
                                                    <td>{{$student->sections['name_'.app()->getLocale()] ??  ''}}</td>
                                                    <td>{{$student->updated_at}}</td>
                                                @empty
                                                    <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- teachers Table --}}
                            <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                                <div class="table-responsive mt-15">
                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                        <thead>
                                            <tr class="table-info text-danger">
                                                <th class="alert-danger">#</th>
                                                <th class="alert-danger">{{__("Student Name")}}</th>
                                                <th class="alert-danger">{{__("Amount")}}</th>
                                                <th class="alert-danger">{{__("Date")}}</th>
                                                <th class="alert-danger">{{__("Description")}}</th>
                                            </tr>
                                        </thead>

                                        @forelse(\App\Models\Payment::latest()->take(5)->get() as $payment)
                                            <tbody>
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td>{{$payment->students['name_'.app()->getLocale()]}}</td>
                                                    <td>{{$payment->amount}}</td>
                                                    <td>{{$payment->date}}</td>
                                                    <td>{{$payment->description}}</td>
                                                @empty
                                                    <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                </tr>
                                            </tbody>
                                        @endforelse
                                    </table>
                                </div>
                            </div>

                            {{-- parents Table --}}
                            <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                                <div class="table-responsive mt-15">
                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                        <thead>
                                            <tr class="table-info text-danger">
                                                <th class="alert-danger">#</th>
                                                <th class="alert-danger">{{__("Student Name")}}</th>
                                                <th class="alert-danger">{{__("Amount")}}</th>
                                                <th class="alert-danger">{{__("Date")}}</th>
                                                <th class="alert-danger">{{__("Description")}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse(\App\Models\StudentReceipt::latest()->take(5)->get() as $receipt)
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td>{{$receipt->students['name_'.app()->getLocale()]}}</td>
                                                    <td>{{$receipt->debit}}</td>
                                                    <td>{{$receipt->date}}</td>
                                                    <td>{{$receipt->description}}</td>
                                                @empty
                                                    <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- sections Table --}}
                            <div class="tab-pane fade" id="fee_invoices" role="tabpanel"
                                aria-labelledby="fee_invoices-tab">
                                <div class="table-responsive mt-15">
                                    <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                        <thead>
                                            <tr class="table-info text-danger">
                                                <th>#</th>
                                                <th>{{__("Student Name")}}</th>
                                                <th>{{__("Date")}}</th>
                                                <th>{{__("Fee Name")}}</th>
                                                <th>{{__("Amount")}}</th>
                                                <th>{{__("Description")}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse(\App\Models\FeeInvoice::latest()->take(10)->get() as $feeInvoice)
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td>{{$feeInvoice->students['name_'.app()->getLocale()]}}</td>
                                                    <td>{{$feeInvoice->date}}</td>
                                                    <td>{{$feeInvoice->fees['name_'.app()->getLocale()]}}</td>
                                                    <td>{{$feeInvoice->fees->amount}}</td>
                                                    <td>{{$feeInvoice->description}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="alert-danger" colspan="9">لاتوجد بيانات</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <livewire:admin-calender />

    <!--=================================wrapper -->

    <!--=================================footer -->

    {{-- </div> --}}
    <!-- main content wrapper end-->
    </div>


    <!--=================================footer -->
@endsection
