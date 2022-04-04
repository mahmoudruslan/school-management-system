@extends('admin_dashboard.layout.master')

@section('title')
    {{__('Results')}}
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
                                        <h5>
                                            <form action="{{route('results.create2')}}" method="get">
                                                <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                                                <input type="hidden" name="grade_id" value="{{$classroom->grade_id}}">
                                                <button type="submit" class="btn btn-light">{{$classroom['name_'.app()->getLocale()]}}</button>
                                            </form>

                                        </h5>
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

