@extends('layouts.master')

@section('title')
    {{__('sections.List_sections')}}
@endsection
@section('content')

    <!-- start error messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- end error messages -->
    {{-- start according gray --}}
    <div class="card-body">
        <a class="button x-small" href="{{route('Sections.create')}}">
            {{__('sections.add_section')}}</a>
    </div>
    <div class="accordion gray plus-icon round">
        <?php $x=0;?>
        @foreach ($grades as $grade)
            <div class="acd-group">
                <a href="#" class="acd-heading">{{$grade->name}}</a>
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
                                                    <?php $i = 0;?>

                                                        @foreach ($classroom->sections as $section)
                                                        <?php $i++;?>
                                                            <tr>
                                                                <td>{{$i}}</td>

                                                                    <td>{{$section['name_'.app()->getLocale()]}}</td>

                                                                @if ($section-> status == 1)
                                                                    <td>
                                                                        <span class="badge badge-success">active</span>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <span class="badge badge-danger">not-active</span>
                                                                    </td>
                                                                @endif
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
                                                                                    {{ trans('sections.delete?') }}
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
                                                                                        {{ trans('sections.close') }}
                                                                                    </button>
                                                                                    <button type="submit" class="btn btn-danger">
                                                                                        {{ trans('sections.Delete') }}
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
@section('js')
<script>

    $(document).ready(function () {
        $('select[name="grade_id"]').on('change', function () {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "{{ URL::to('classrooms') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="classroom_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });

</script>
@endsection
