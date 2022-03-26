<div class="tab-pane fade active show" id="student-information" role="tabpanel" aria-labelledby="home-02-tab">
    <!-- but your table hair-->
    <table class="table-hover">
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
                <td class="col-md-6"><h6>{{__($student->religion)}}</h6></td>
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
                <td class="col-md-2"><h6>{{__("Joining Date")}}</h6></td>
                <td class="col-md-6"><h6>{{$student->joining_date}}</h6></td>
            </tr>

            <tr>
                <td class="col-md-2"><h6>{{__("Address")}}</h6></td>
                <td class="col-md-6"><h6>{{$student->student_address}}</h6></td>
            </tr>
            
        </tbody>
    </table>
</div>