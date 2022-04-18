</body>
<!-- jquery -->

<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path = '{{ asset('assets/js') }}/';
</script>

<!--start toastr pakage -->
@toastr_js
<!--end toastr pakage -->

<!--related livewire calender -->
@livewireScripts
@stack('scripts')

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script>
    //for all grade and classroom and section select
    $(document).ready(function() {
        $('select[name="grade_id"]').on('change', function() {
            let grade_id = $(this).val();
            if (grade_id) {


                $.ajax({
                    url: "{{ URL::to('admin/get_classes') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('select[name="classroom_id"]').empty();
                        $('select[name="classroom_id"]').append(
                            '<option selected disabled >{{ __('Choose Classroom') }}...</option>'
                            );
                        $.each(data, function(key, value) {
                            $('select[name="classroom_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
    $(document).ready(function() {
        $('select[name="classroom_id"]').on('change', function() {
            let classroom_id = $(this).val();
            if (classroom_id) {
                $.ajax({
                    url: "{{ URL::to('admin/get_sections') }}/" + classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $('select[name="section_id"]').append(
                            '<option selected disabled >{{ __('Choose Section') }}...</option>'
                            );
                        $.each(data, function(key, value) {
                            $('select[name="section_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
    //for new grade and classroom and section
    $(document).ready(function() {
        $('select[name="grade_id_new"]').on('change', function() {
            let grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    url: "{{ URL::to('admin/get_classes') }}/" + grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="classroom_id_new"]').empty();
                        $('select[name="classroom_id_new"]').append(
                            '<option selected disabled >{{ __('Choose Classroom') }}...</option>'
                            );
                        $.each(data, function(key, value) {
                            $('select[name="classroom_id_new"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });

    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
    $(function() {
        $("#checked_all").click(function() {
                    $("input").attr("checked","checked");
                });
        $("#btn_return_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#return_all').modal('show')
                $('input[id="return_all_id"]').val(selected);
            }
        });
    });
</script>
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

@livewireScripts

</html>
