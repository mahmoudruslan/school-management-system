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
                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#student-information" role="tab" aria-controls="home-02" aria-selected="true">
                        {{__('Student Information')}}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="home-03-tab" data-toggle="tab" href="#parent-data" role="tab" aria-controls="profile-02" aria-selected="false">
                        {{__("Parent's data")}}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#student-attachment" role="tab" aria-controls="profile-02" aria-selected="false">
                        {{__('Student Attachments')}}
                    </a>
                </li>

            </ul>
            <div class="tab-content">
                @include('admin_dashboard.pages.students.student_information')
                @include('admin_dashboard.pages.students.parent_data')
                @include('admin_dashboard.pages.students.student_attachment')




        </div><br>
            <a href="{{url()->previous()}}" type="button" class="button">{{__('Back')}}</a>
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
