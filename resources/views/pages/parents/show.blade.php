@extends('layouts.master')
@section('title')
    {{__("Parent's Information")}}

@stop

@section('content')
    <!-- row -->
    <div class="card card-body card-statistics h-100">
        <div class="tab nav-border">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02" role="tab" aria-controls="home-02" aria-selected="true">
                        {{__("Parent's Information")}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02" role="tab" aria-controls="profile-02" aria-selected="false">
                        {{__("Parent's Attachments")}}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="home-02" role="tabpanel" aria-labelledby="home-02-tab">
                    <!-- but your table hair-->
                    <table class="table-hover  table-bordered">
                        <tbody>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Email")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->email}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Father's Name")}}</h6></td>
                            <td class="col-md-6"><h6>{{__($parent['name_father_'.app()->getLocale()])}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Mother's Name")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent['name_mother_'.app()->getLocale()]}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Father's Religion")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->fatherReligions['name_'.app()->getLocale()]}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Mother's Religion")}}</h6></td>
                            <td class="col-md-6"><h6>{{ $parent->motherReligions['name_'.app()->getLocale()] }}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Father's Nationality")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->fatherNationality['name_'.app()->getLocale()]}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Mother's Nationality")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->motherNationality['name_'.app()->getLocale()]}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Father's Phone")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->phone_father}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Mother's Phone")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->phone_mother}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Father's Job")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent['job_father_'.app()->getLocale()]}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Mother's Job")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent['job_mother_'.app()->getLocale()]}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Father's National Id")}}</h6></td>
                            <td class="col-md-6"><h6>{{__($parent->national_id_father)}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Mother's National Id")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->national_id_mother}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Father's Passport Number")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->passport_id_father}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Mother's Passport Number")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->passport_id_mother}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Father's Blood Type")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->fatherBloodType->name}}</h6></td>
                        </tr>

                        <tr>
                            <td class="col-md-2"><h6>{{__("Mother's Blood Type")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->motherBloodType->name}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Father's Address")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->address_father}}</h6></td>
                        </tr>
                        <tr>
                            <td class="col-md-2"><h6>{{__("Mother's Address")}}</h6></td>
                            <td class="col-md-6"><h6>{{$parent->address_mother}}</h6></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                    <div class="card card-statistics">
                        <div class="card-body">
                            <!--but your table gallery-->
                            <form method="POST" action="{{route('save.attachments',$parent->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-3" style="display: inline-block">
                                    <div class="form-group">
                                        <input accept="image/*" name="photos[]" type="file" class="custom-file-input" id="customFile" multiple required>
                                        <label class="custom-file-label" for="customFile">{{__('Attachments')}}: <span class="text-danger">*</span></label>
                                        <input type="hidden" name="name_ar" value="{{$parent->name_father_ar}}">
                                        <input type="hidden" name="model" value="TheParent">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-secondary mt-2 p-1">
                                    {{__('Submit')}}
                                </button>
                            </form><br><br><br>
                            <!-- The grid: four columns -->
                            <div class="row">
                                @foreach($parent->images as $image)
                                    <div class="column">
                                        <button data-toggle="modal" data-target="#delete_img{{$image->id}}.{{$image->filename}}.{{$parent->id}}" type="submit" class="mybutton btn btn-sm btn-danger">
                                            <span><i class="fa fa-trash"></i></span>
                                        </button>
                                        <img class="myimg" style="width: 100%;height: 100%"
                                             src="{{URL::asset('attachments/TheParents/'.$parent->name_father_ar.'/'.$image->filename)}}"
                                             alt="" onclick="myFunction(this);">
                                        <div class="desc">{{$image->filename}}</div>
                                    </div>
                                    @include('pages.parents.delete-image')
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
            <a href="{{route('Parents.index')}}" type="button" class="button">{{__('Back')}}</a>
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
