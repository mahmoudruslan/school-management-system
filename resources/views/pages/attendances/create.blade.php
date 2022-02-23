@extends('layouts.master')

@section('title')
    {{__('Attendances')}}
@stop
@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    {{-- start according gray --}}
    <div class="accordion gray plus-icon round">
        <?php $x=0;?>
        @foreach ($grades as $grade)
            <div class="acd-group">
                <a href="#" class="acd-heading">{{$grade['name_'.app()->getLocale()]}}</a>
                <div class="acd-des">
                    {{-- start my according classrooms --}}
                    @foreach ($grade->classrooms as $classroom)
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header text-center" id="headingTwo">
                                    <button class="btn btn-light collapsed" data-toggle="collapse" data-target="#collapseOne{{$x}}" aria-expanded="false" aria-controls="collapseTwo">
                                        <h5 class="mb-0">
                                            {{$classroom['name_'.app()->getLocale()]}}
                                        </h5>
                                    </button>
                                </div>
                                <div id="collapseOne{{$x}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <?php $x++;?>

                                    <div class="card-body">
                                        {{-- start my table --}}
                                        <div class="d-block d-md-flex justify-content-between">
                                            <div class="d-block">
                                            </div>
                                        </div>
                                        <div class="table-responsive mt-15">
                                            <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                                <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>{{__('Section Name')}}</th>
                                                        <th>{{__('Status')}}</th>
                                                        <th>{{__('Processes')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($classroom->sections as $section)
                                                        <tr>
                                                            <td>{{$loop->index}}</td>
                                                            <td>{{$section['name_'.app()->getLocale()]}}</td>
                                                            <td>
                                                                <span class="badge {{$section->status == 'Active'? 'badge-success' : 'badge-danger'}}">{{__($section->status)}}</span>
                                                            </td>
                                                            <td>
                                                                <form action="{{route('Attendances.show',$section->id)}}" method="">
                                                                    @csrf
                                                                    <input name="teacher_id" type="hidden" value="{{$teacher_id}}">
                                                                    <button class="btn btn-warning" type="submit">
                                                                        <i class="fa fa-eye"></i> {{__('Show students')}}
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
        @endforeach
    </div>
    {{-- end my according gray --}}
@endsection

