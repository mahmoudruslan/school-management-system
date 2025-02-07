<div class="tab-pane fade" id="parent-data" role="tabpanel" aria-labelledby="home-03-tab">
    @php
        $lang = app()->getLocale();
    @endphp
    <!-- but your table hair-->
    <table class="table-hover table-bordered">
        <tbody>
            <tr>
                <td class="col-md-2"><h6>{{__("Father's Name")}}</h6></td>
                <td class="col-md-6"><h6>{{__($student->parents['father_name_'.$lang])}}</h6></td>
            </tr>
            <tr>
                <td class="col-md-2"><h6>{{__("Mother's Name")}}</h6></td>
                <td class="col-md-6"><h6>{{$student->parents['mother_name_'.$lang]}}</h6></td>
            </tr>
            <tr>
                <td class="col-md-2"><h6>{{__("Father's Nationality")}}</h6></td>
                <td class="col-md-6"><h6>{{$student->parents->nationality['name_'.$lang]}}</h6></td>
            </tr>
            <tr>
                <td class="col-md-2"><h6>{{__("Father's Phone")}}</h6></td>
                <td class="col-md-6"><h6>{{$student->parents->father_phone}}</h6></td>
            </tr>
            <tr>
                <td class="col-md-2"><h6>{{__("Father's Job")}}</h6></td>
                <td class="col-md-6"><h6>{{$student->parents['father_job_'.$lang]}}</h6></td>
            </tr>

            <tr>
                <td class="col-md-2"><h6>{{__("Father's National Id")}}</h6></td>
                <td class="col-md-6"><h6>{{__($student->parents->father_nationality_id)}}</h6></td>
            </tr>
            <tr>
                <td class="col-md-2"><h6>{{__("Mother's National Id")}}</h6></td>
                <td class="col-md-6"><h6>{{$student->parents->mother_national_id}}</h6></td>
            </tr>
        </tbody>
    </table>
</div>