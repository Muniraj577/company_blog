<script src="{{ asset('newjs/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
{{-- <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
<script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('admin/js/datatables.min.js') }}"></script>
<script src="{{ asset('admin/js/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/js/jszip.min.js') }}"></script>
<script src="{{ asset('admin/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('js/nepali.datepicker.min.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('newjs/jquery-ui.js') }}"></script>
<script src="{{ asset('jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('jquery-validation/dist/additional-methods.min.js') }}"></script>
<script src="{{ asset('custom-validation/validation.js') }}"></script>
<script src="{{ asset('bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>

<script>
    var update = function() {
        document.getElementById("display_time")
            .innerHTML = moment().format('YYYY-MM-DD h:mm a');
    }
    $(function() {
        selectRefresh();
        var mainInput = document.getElementsByClassName("nepaliDatePicker");
        mainInput.nepaliDatePicker({
            language: "english",
            onChange: function() {
                let nepalidate = $(".nepaliDatePicker").val();
                let dateObj = NepaliFunctions.ParseDate(nepalidate);
                let engDate = NepaliFunctions.BS2AD(dateObj.parsedDate);
                let year = engDate.year;
                let month = NepaliFunctions.Get2DigitNo(engDate.month);
                let day = NepaliFunctions.Get2DigitNo(engDate.day);
                let engValue = year + '-' + month + '-' + day;
                $(".datetime").val(engValue);
            },
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 200
        });
    });

    function nepaliPicker(nep_class) {
        var main_input = document.getElementsByClassName(nep_class);
        main_input.nepaliDatePicker({
            language: "english",
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 200
        });
    }


    function neptoeng(nep_class, id_name) {
        var mainInput = document.getElementsByClassName(nep_class);
        mainInput.nepaliDatePicker({
            language: "english",
            onChange: function() {
                let nepalidate = $("." + nep_class).val();
                let dateObj = NepaliFunctions.ParseDate(nepalidate);
                let engDate = NepaliFunctions.BS2AD(dateObj.parsedDate);
                let year = engDate.year;
                let month = NepaliFunctions.Get2DigitNo(engDate.month);
                let day = NepaliFunctions.Get2DigitNo(engDate.day);
                let engValue = year + '-' + month + '-' + day;
                $("#" + id_name).val(engValue);
            },
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 200
        });
    }

    function engtonep(this_date, idName) {
        let dateTime = $(this_date).val();
        if (dateTime) {
            let dateObj = new Date(dateTime);
            let year = dateObj.getUTCFullYear();
            let month = dateObj.getUTCMonth() + 1;
            let day = dateObj.getUTCDate(); // + 1 for 'dd-mm-yyyy'
            let nepaliDate = NepaliFunctions.AD2BS({
                year: year,
                month: month,
                day: day
            });
            let nepaliYear = nepaliDate.year;
            let nepaliMonth = ("0" + nepaliDate.month).slice(-2);
            let nepaliDay = ("0" + nepaliDate.day).slice(-2);
            let nepaliValue = nepaliYear + '-' + nepaliMonth + '-' + nepaliDay;
            $("#" + idName).val(nepaliValue);
        } else {
            $("#" + idName).val('');
        }

    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function datepicker(idName) {
        $("#" + idName).datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: true,
            todayHighlight: true,
        });
    }


    function selectRefresh() {
        $('.select2').select2();

    }

    function showImg(img, previewId) {
        readInputURL(img, previewId);
    }

    function readInputURL(input, idName) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#" + idName).attr('src', e.target.result).width(100).height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function dataTablePosition() {
        $('.buttons-collection').detach().appendTo('.dataTables_filter');
    }

    function deleteData(id, url, el) {
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: {
                "id": id,
                "data": {
                    _token: "{{ csrf_token() }}"
                }

            },
            success: function(data) {
                el.closest('tr').remove();
                $("#" + data.tableId).DataTable();
                toastr.error(data.msg);
            },
        });

    }

    function onlynumbers(event) {

        let key = window.event ? event.keyCode : event.which;
        // event.keyCode == 39 (is for single quote)
        // event.keyCode == 37 for decimal
        if (event.keyCode == 8 || event.keyCode == 46 ||
            event.keyCode == 37) {
            return true;
        } else if (key < 48 || key > 57) {
            return false;
        } else return true;

    }

    function onlyintnumbers(event) {
        let key = window.event ? event.keyCode : event.which;
        console.log(key);
        if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37) {
            return true;
        } else if (key < 48 || key > 57) {
            return false;
        } else return true;

    }

    function numberonly(thes) {
        console.log(thes.val());
        if (/\D/g.test(thes.val())) {

            // Filter non-digits from input value.
            thes.val(thes.val().replace(/\D/g, ''));
            // return false;
        }


    }

    $('input.qty').on('paste', function(event) {
        if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
            event.preventDefault();
        }
    })

    function onpasteString(event) {
        if (event.clipboardData.getData('Text').match(/[^\d]/)) {
            event.preventDefault();
            $.alert({
                title: 'Alert !',
                content: 'Only numbers can be pasted',
                icon: 'fa fa-exclamation-triangle',
                theme: 'modern',
            });
        }
    }

    function unauthorize() {
        $.alert({
            title: 'Alert !',
            content: 'You are not authorized for this operation',
            theme: 'modern',
            icon: 'fa fa-fa-exclamation-triangle',
        });
    }

    function alertMessage() {

        $.alert({
            title: 'Alert!',
            icon: 'fa fa-warning',
            content: 'The purchase has already been paid, you cannot edit this purchase. Please make a new purchase.',
            escapeKey: true,
            backgroundDismiss: true,
        });
    }

    function alertPayMessage() {
        $.alert({
            title: 'Alert!',
            icon: 'fa fa-warning',
            content: 'The Payment is already cleared.',
            escapeKey: true,
            backgroundDismiss: true,
        });
    }

    function printUrl(url) {
        var printwindow = window.open(url, '_blank');
        printwindow.print();
    }

    var validate_email = function(email) {
        var pattern = /^([a-zA-A0-9_.-])+@([a-zA-Z0-9_.-])+([a-zA-Z])+/;
        var is_email_valid = false;
        if (email.match(pattern) != null) {
            is_email_valid = true;
        }
        return is_email_valid;
    }

    $(document).on("keyup", "#email_id", function(event) {
        var keypressed = event.which;
        var input_val = $(this).val();
        var is_success = true;
        if (keypressed == 9) {
            console.log('pressed 9')
            is_success = validate_email(input_val);
            if (!is_success) {
                $(this).focus();
            }
        }
    });


    $(document).on("focusout", "#email_id", function() {
        var input_val = $(this).val();
        var is_success = validate_email(input_val);

        if (!is_success) {
            $("#email_id").focus();
        }
    });


    var today = new Date();
    var today_date = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today
        .getDate()).slice(-2);
    $(document).ready(function() {
        setInterval(update, 1000);
        var nep_date = $('#led_eng_date').val(today_date);
        engtonep(nep_date, "led_date");

        $('.spinner').hide();
    });



    function validateEmail(email) {
        const re =
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function validate(event, email) {
        const $result = $("#result");
        const email_address = $(email).val();
        var keypressed = event.which;
        if (keypressed == 9) {
            if (validateEmail(email_address)) {
                $result.text("");
                return true;
            } else {
                $result.css("color", "red");
                $result.text("Email is not valid. Please enter valid email address");
                event.preventDefault();
                $(email).focus();
            }
        }

        return false;
    }

    function getIntlPhone() {
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            preferredCountries: ['np', 'in'],
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            utilsScript: "/assets/plugins/intltel/js/utils.js"
        });

        input.addEventListener('countrychange', function(e) {

            var iso2 = iti.getSelectedCountryData().iso2;
            var dialCode = iti.getSelectedCountryData().dialCode;
            $("#dialcode").val(dialCode);
            $("#iso2_code").val(iso2);
        });
    }

    function timepick(time) {
        $(time).timepicker({
            minuteStep: 1,
            icons: {
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down'
            }
        });
        // $(".glyphicon-chevron-up").removeClass("glyphicon glyphicon-chevron-up").addClass("fa fa-chevron-up");
        // $(".glyphicon-chevron-down").removeClass("glyphicon glyphicon-chevron-down").addClass("fa fa-chevron-down");
    }

    function checknumber(num) {
        var rege = "/^\d+$/;"
        if (num.match(/^\d+$/)) {
            alert("Matched");
        } else {
            alert("Not Matched");
        }
    }
</script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-container",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch (type) {
        case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;
    
        case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;
    
        case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;
    
        case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;
        }
    @endif
</script>
@yield('scripts')
