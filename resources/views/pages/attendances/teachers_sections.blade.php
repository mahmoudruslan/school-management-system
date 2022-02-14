
<div id="collapseOne{{$x}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
    <div class="card-body">
        <!-- start table -->
        <div class="d-block d-md-flex justify-content-between">
            <div class="d-block"></div>
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
                @foreach ($sections as $section)
                    @if($classroom->id == $section->classroom_id)
                        <tr>
                            <td>{{$loop->index}}</td>
                            <td>{{$section['name_'.app()->getLocale()]}}</td>
                            <td>
                                <span class="badge {{$section->status == 'Active'? 'badge-success' : 'badge-danger'}}">
                                    {{__($section->status)}}
                                </span>
                            </td>
                            <td>
                                <form action="{{route('Attendances.ShowSectionStudents',$section->id)}}" method="">
                                    @csrf
                                    <input name="teacher_id" type="hidden" value="{{$teacher_id}}">
                                    <button class="btn btn-warning" type="submit">
                                        <i class="fa fa-eye"></i> {{__('Show students')}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- end table -->
    </div>
</div>
