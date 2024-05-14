@if ($student_results->where('classroom_id', $result_classroom->classroom->id)->where('term', '2')->count() > 0)
<div class="table-responsive mt-15">
    <table class="table table-hover table-sm table-bordered p-5"
        data-page-length="50" style="text-align: center">
        <thead>
            <tr class="text-dark">
                <th class="p-3 alert-secondary" colspan="3">
                    {{ __('Second semester') }}</th>
            </tr>
            <tr class="text-dark">
                <th>{{ __('Subject Name') }}</th>
                <th>{{ __('Degree') }}</th>
                <th>{{ __('From') }}</th>
            </tr>
        </thead>
        <tbody>
            <!--get results to this classroom and this term -->
            @php
                $term_results = $student_results->where('classroom_id', $result_classroom->classroom->id)->where('term', '2');
            @endphp
            @forelse ($term_results as $term_result)
                <tr>
                    <th class="p-15" scope="row">
                        {{ $term_result->subject['name_' . app()->getLocale()] }}
                    </th>

                    <td class="p-15">{{ $term_result->degree }}
                    </td>
                    <td class="p-15">
                        {{ $term_result->subject->degree / 2 }}</td>
                </tr>
                @empty
                <tr>{{ __('No results') }}</tr>
            @endforelse
            <tr>
                <th class="p-15 alert-success" scope="row">
                    {{ __('المجموع') }}
                </th>
                <td class="p-15 alert-success">
                    {{ $student_results->where('classroom_id', $result_classroom->classroom->id)->sum('degree') }}
                </td>
                <td class="p-15 alert-success">{{ $total }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endif