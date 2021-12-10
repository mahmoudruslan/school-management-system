@extends('layouts.master')

@section('title')
    {{__('Sections List')}}
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
    <div class="card-body">
        <a class="button x-small" href="{{route('Sections.create')}}">
            {{__('Add Section')}}</a>
    </div>
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
                                                        <th>اسم القسم</th>
                                                        <th>الحالة</th>
                                                        <th>العمليات</th>
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
                                                                    <button style="color: white" type="button" data-toggle="modal" class="btn btn-danger" data-target="#delete{{$section ->id}}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    <a href="{{route('Sections.edit',$section ->id)}}"  class="btn btn-info" type="button">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            {{-- start delete_modal_section --}}
                                                            <div class="modal fade" id="delete{{$section ->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                                {{ __('Are you sure you want to delete the Section?') }}
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <form action="{{ route('Sections.destroy','test') }}" method="POST">
                                                                                {{ method_field('Delete') }}
                                                                                @csrf
                                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{$section ->id}}">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                                    {{ __('Close') }}
                                                                                </button>
                                                                                <button type="submit" class="btn btn-danger">
                                                                                    {{ __('Delete') }}
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        {{-- end delete_modal_section --}}
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

