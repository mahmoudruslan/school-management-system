@extends('admin_dashboard.layout.master')
@section('title')
    {{__('Student Information')}}

@endsection

@section('content')
    <!-- start error messages -->
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error')}}
        </div>
    @endif
    <!-- end error messages -->
    <!-- row -->
    <div class="card card-body card-statistics h-100">
        <div class="tab nav-border">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02" role="tab" aria-controls="home-02" aria-selected="true">
                        {{__('Student Information')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02" role="tab" aria-controls="profile-02" aria-selected="false">
                        {{__('Student Attachments')}}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="home-02" role="tabpanel" aria-labelledby="home-02-tab">
                    <!-- but your table hair-->
                    <table class="table-hover  table-bordered">
                        <tbody>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Name")}}</h6></td>
                            <td class="col-md-6"><h6>{{$student['name_'.app()->getLocale()]}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Email")}}</h6></td>
                            <td class="col-md-6"><h6>{{__($student->email)}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Gender")}}</h6></td>
                            <td class="col-md-6"><h6>{{__($student->gender)}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Nationality")}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->nationalities['name_'.app()->getLocale()]}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Date of birth")}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->date_of_birth}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Religion")}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->religions['name_'.app()->getLocale()]}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Entry Status")}}</h6></td>
                                <td class="col-md-6"><h6>{{__($student->entry_status)}}</h6></td>

                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Grade")}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->grades['name_'.app()->getLocale()]}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Classroom")}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->classrooms['name_'.app()->getLocale()] ?? ''}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Section")}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->sections['name_'.app()->getLocale()] ?? ''}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Blood Type")}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->bloodTypes->name ?? ''}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__('Father\'s Name')}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->parents['name_father_'.app()->getLocale()]}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__('Mother\'s Name')}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->parents['name_mother_'.app()->getLocale()]}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Academic Year")}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->academic_year}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Address")}}</h6></td>
                            <td class="col-md-6"><h6>{{$student->address}}</h6></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <!--but your table gallery-->


                            <!-- The grid: four columns -->
                            <div class="row">
                            @foreach($student->images as $image)
                                <div class="column">
                                    <button data-toggle="modal" data-target="#delete_img{{$image->id}}.{{$image->filename}}.{{$student->id}}" type="submit" class="mybutton btn btn-sm btn-danger">
                                        <span><i class="fa fa-trash"></i></span>
                                    </button>
                                    <img class="myimg" style="width: 100%;height: 100%"
                                         src="{{URL::asset('attachments/Students/'.$student->name_ar.'/'.$image->filename)}}"
                                         alt="" onclick="myFunction(this);">
                                    <div class="desc">{{$image->filename}}</div>
                                </div>
                                    @include('admin_dashboard.pages.students.delete-image')
                            @endforeach
                            </div>
                            <!-- The expanding image container -->
                            <div class="show-container mt-10">
                                <!-- Close the image -->
                                <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
                                <!-- Expanded image -->
                                <img id="expandedImg" style="width:80%">
                                <!-- Image text -->
                                <div id="imgtext"></div>
                            </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
            <a href="{{route('graduated.index')}}" type="button" class="button">{{__('Back')}}</a>
        </div>
    </div>

@endsection
@section('js')
<script>
    function myFunction(imgs) {
        // Get the expanded image
        var expandImg = document.getElementById("expandedImg");
        // Get the image text
        var imgText = document.getElementById("imgtext");
        // Use the same src in the expanded image as the image being clicked on from the grid
        expandImg.src = imgs.src;
        // Use the value of the alt attribute of the clickable image as text inside the expanded image
        imgText.innerHTML = imgs.alt;
        // Show the container element (hidden with CSS)
        expandImg.parentElement.style.display = "block";
    }
</script>
@endsection
