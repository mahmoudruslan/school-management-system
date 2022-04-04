<div class="d-block d-md-flex justify-content-between">
</div>
<div class="table-responsive mt-15">
    <table class="table table-hover table-sm table-bordered p-5" data-page-length="50" style="text-align: center">
        <thead>
            <tr class="text-dark">
                <th class="p-3 alert-secondary" colspan="3">{{ __('First semester') }}</th>
            </tr>
            <tr class="text-dark">
                <th>{{ __('Subject Name') }}</th>
                <th>{{ __('Degree') }}</th>
                <th>{{ __('From') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student_result->where('classroom_id', $result->classrooms->id)->where('term', 'First semester') as $result_term)
                <tr>
                    <th class="p-15" scope="row">
                        {{ $result_term->subjects['name_' . app()->getLocale()] }}</th>
                    <td class="p-15">{{ $result_term->degree }}</td>
                    <td class="p-15">{{ $result_term->subjects->degree / 2 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
