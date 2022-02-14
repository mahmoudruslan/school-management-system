<!-- teacher's classrooms -->

@foreach ($sectionGrade->grades->classrooms as $classroom)
    <div id="accordion">
        <div class="card">
            <?php $x++?>
        <?php $x += rand();?>
        @foreach ($sections->unique('classroom_id') as $section)

    @if ($section->classroom_id == $classroom->id)
        <div class="card-header text-center" id="headingTwo">
            <button class="btn btn-light collapsed" data-toggle="collapse" data-target="#collapseOne{{$x}}"
                    aria-expanded="false" aria-controls="collapseTwo">
                <h5 class="mb-0">
                    {{$classroom['name_'.app()->getLocale()]}}
                </h5>
            </button>
        </div>
        
    @endif
@endforeach
<!-- teachers_sections -->
            @include('pages.attendances.teachers_sections')
        </div>
    </div>
@endforeach

