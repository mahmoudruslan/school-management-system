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
        <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
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
                                                                    <button  class="btn btn-info" type="button" data-toggle="modal" data-target="#edit{{$section ->id}}">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            {{-- start edit sections --}}
                                                            <div class="modal fade" id="edit{{$section ->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                                                                {{__('sections.edit_section')}}</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <form action="{{route('Sections.update','test')}}" method="POST">
                                                                                {{method_field('patch')}}
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <input type="text" name="name_ar" class="form-control" value="{{$section->name_ar}}" placeholder="{{__('sections.section_name_ar')}}">
                                                                                    </div>

                                                                                    <div class="col">
                                                                                        <input type="text" name="name_en" class="form-control" value="{{$section->name_en}}" placeholder="{{__('sections.section_name_en')}}">
                                                                                        <input type="hidden" name="id" class="form-control" value="{{$section->id}}" >

                                                                                    </div>

                                                                                </div>
                                                                                <br>


                                                                                <div class="col">
                                                                                    <label for="inputName" class="control-label">{{__('sections.select_grade')}}</label>
                                                                                    <select name="grade_id" class="custom-select" onchange="console.log($(this).val())">
                                                                                        <!--placeholder-->
                                                                                        <option value="{{$classroom->gradess->id}}" selecteddisabled>{{$classroom->gradess['name_'.app()->getLocale()]}}</option>
                                                                                        @foreach ($grades as $grade)
                                                                                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <br>
                                                                                <div class="col">
                                                                                    <label for="inputName"
                                                                                            class="control-label">{{__('sections.select_classroom')}}</label>
                                                                                    <select name="classroom_id" class="custom-select">

                                                                                            <option>{{$section->classrooms['name_'.app()->getLocale()]}}</option>
                                                                                    </select>
                                                                                </div><br>
                                                                                <div class="col">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckChecked" checked>
                                                                                        <label class="form-check-label" for="flexCheckChecked">
                                                                                        {{__('sections.status')}}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                                            {{-- select teacher --}}
                                                                                {{-- <div class="col">
                                                                                    <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                                                                                    <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                                                                        @foreach($teachers as $teacher)
                                                                                            <option value="">dfgdsfg</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div> --}}


                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary"
                                                                                        data-dismiss="modal">{{__('sections.close')}}</button>
                                                                                <button type="submit"
                                                                                        class="btn btn-danger">{{__('sections.submit')}}</button>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    {{-- end edit section --}}
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
                                                                                <form action="{{ route('Sections.destroy', 'test') }}" method="POST">
                                                                                    {{ method_field('Delete') }}
                                                                                    @csrf
                                                                                    <input id="id" type="hidden" name="id" class="form-control" value="50">
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
    {{-- start add sections --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                    {{__('sections.add_section')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('Sections.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <input type="text" name="name_ar" class="form-control"
                                    placeholder="{{__('sections.section_name_ar')}}">
                        </div>

                        <div class="col">
                            <input type="text" name="name_en" class="form-control"
                                    placeholder="{{__('sections.section_name_en')}}">
                        </div>

                    </div>
                    <br>


                    <div class="col">
                        <label for="inputName" class="control-label">{{__('sections.select_grade')}}</label>
                        <select name="grade_id" class="custom-select"
                                onchange="console.log($(this).val())">
                            <!--placeholder-->
                            <option value="" selected
                                    disabled>{{__('sections.select_grade')}}
                            </option>
                            @foreach ($grades as $grade)
                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName"
                                class="control-label">{{__('sections.select_classroom')}}</label>
                        <select name="classroom_id" class="custom-select">

                        </select>
                    </div><br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{__('sections.select_teacher')}}</label>
                        <select name="teacher_id[]" class="custom-select" multiple aria-label="multiple select example">
                            <option selected>{{__('sections.select_teacher')}}</option>
                            @foreach($teachers as $teacher)

                            <option value="{{$teacher->id}}">{{$teacher->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>



                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                {{__('sections.status')}}
                            </label>
                        </div>
                    </div>
                                                {{-- select teacher --}}
                    {{-- <div class="col">
                        <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                            @foreach($teachers as $teacher)
                                <option value="">dfgdsfg</option>
                            @endforeach
                        </select>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{__('sections.close')}}</button>
                    <button type="submit"
                            class="btn btn-danger">{{__('sections.submit')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end add section --}}

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
