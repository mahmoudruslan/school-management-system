@extends('admin_dashboard.layout.master')
@section('title')
    {{ __('Teacher informations') }}
@endsection

@section('content')
    <!-- start error messages -->
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <!-- end error messages -->
    @php
        $lang = app()->getLocale();
    @endphp
    <!-- row -->
    <div class="card card-body card-statistics h-100">
        <div class="tab nav-border">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#student-information"
                        role="tab" aria-controls="home-02" aria-selected="true">
                        {{ __('Teacher informations') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="teacher-information" role="tabpanel"
                    aria-labelledby="home-02-tab">
                    <!-- but your table hair-->
                    <table class="table-hover table-bordered">
                        <tbody>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('Name') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ $admin['name_' . $lang] }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('Email') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ __($admin->email) }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('Gender') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ __($admin->gender) }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('Joining Date') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ $admin->joining_date }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('Religion') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ $admin->religion == 1 ? __('Muslim') : __('Christian') }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('Role') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ __($admin->roles['name_' . $lang]) }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('phone number') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ $admin->phone }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('Joining Date') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ $admin->joining_date }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('Specialization') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ $admin->specializations['name_' . $lang] }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('Notes') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ $admin->note }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">
                                    <h6>{{ __('Address') }}</h6>
                                </td>
                                <td class="col-md-6">
                                    <h6>{{ $admin->address }}</h6>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div><br>
            <a href="{{ url()->previous() }}" type="button" class="button">{{ __('Back') }}</a>
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
