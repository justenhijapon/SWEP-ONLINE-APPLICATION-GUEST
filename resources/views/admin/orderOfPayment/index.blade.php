@extends('admin-layouts.main-layout')

@section('content')
    <section class="content-header">
        <h1>
           Order of Payment List
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Order of Payment</li>
        </ol>
    </section>

    <section class="content">
        <div class="panel panel-default">

            <div class="panel-body">
                <div id="tbl_loader" align="center" class="loader" style="padding-top: 10%; padding-bottom: 10%;">
                    <img src="{{ asset('images/load_anim.gif') }}">
                </div>


                <div id="applicationTableContainer" hidden="" class="d-flex flex-wrap">
                    <table class="table table-bordered table-condensed table-striped" id="applicationTable" style="width: 100%">
                        <thead>
                        <tr>
                            <th width="10%">Reference No.</th>
{{--                            <th width="10%">Application Type</th>--}}
                            <th width="10%">Name|Details</th>
                            <th width="20%">Business Name</th>
                            <th width="20%">Purpose of Importation</th>
                            <th width="10%">Application Status</th>
                            <th width="20%" class="action">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('modals')
    {!! __html::blank_modal('edit_modal', '', 'style="width: 45%"') !!}
    {!! __html::blank_modal('showApplicationFile_modal', '', 'style="width: 60%"') !!}
    {!! __html::blank_modal('OrderPayment_form', '', 'style="width: 45%"') !!}

    <div id="filePreviewModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">File Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 800px;">
                    <iframe id="filePreviewIframe" src="" style="width:100%; height:750px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <div id="add_modal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 80%";>
            <div class="modal-content" style="margin-top: 100px">
                <form id="add_form">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
{{--                        <h4 class="modal-title">Add Application</h4>--}}
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Transaction Type
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            {!! __form::a_textbox( 4,'Slug','slug', 'text', 'Slug','', '')!!}
                                            {!! __form::a_textbox( 8,'Name','name', 'text', 'Name','', '')!!}
                                            {!! __form::a_textbox( 6,'Group','group', 'text', 'Group','', '')!!}
                                            {!! __form::a_textbox( 6,'Unit','unit', 'text', 'Unit','', '')!!}
                                            {!! __form::a_textbox( 4,'Fee Per Unit','feePerUnit', 'double', 'Fee Per Unit','', '')!!}
                                            {!! __form::a_textbox( 4,'Regular Fee','regularFee', 'double', 'Regular Fee','', '')!!}
                                            {!! __form::a_textbox( 4,'Expedite Fee','expediteFee', 'double', 'Expedite Fee','', '')!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" ><i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        function printPreview(event, element) {
            event.preventDefault(); // Prevent default link behavior

            var printWindow = window.open(element.href, '_blank', 'width=1100,height=600');

            if (printWindow) {
                printWindow.focus(); // Bring the window to the front
                printWindow.onload = function () {
                    setTimeout(function () {
                        printWindow.print();
                    }, 500); // Slight delay to allow full rendering
                };
            }
        }
    </script>

    <script>
        $(document).on('click', '.prevent-close', function(event) {
            event.stopPropagation(); // Prevent dropdown from closing
        });
    </script>
    <script>
        $(document).on("click", ".revoked_btn", function () {
            var slug = $(this).attr("data"); // Get the slug from the button

            if (confirm("Are you sure you want to revoke this record?")) {
                $.ajax({
                    url: "/update-status", // Update with your route
                    type: "POST",
                    data: {
                        slug: slug,
                        status: 0, // Update received value to 0
                        _token: "{{ csrf_token() }}" // Laravel CSRF token
                    },
                    success: function (response) {
                        succeed(form, true, true); // Call the success function

                        // Refresh DataTables without reloading the page
                        $('#yourDataTableID').DataTable().ajax.reload();
                    },
                    error: function () {
                        alert("Something went wrong.");
                    }
                });
            }
        });

    </script>
    <script>
        // $(document).ready(function () {
        //     // Assume receivedValue is retrieved from your backend
        //     var receivedValue = 1; // Replace this with the actual value from your database
        //
        //     if (receivedValue === 1) {
        //         $("#receivedBtn").removeClass("btn-info").addClass("btn-success").prop("disabled", true);
        //     }
        // });
        $(document).ready(function () {
            var receivedValue = {{ $data->received ?? 0 }}; // Fetch from backend
            var revokedValue = {{ $data->revoked ?? 0 }}; // Fetch from backend

            if (revokedValue === 1) {
                $("#receivedBtn").removeClass("btn-info btn-success")
                    .addClass("btn-danger")
                    .text("Revoked")
                    .prop("disabled", true);
            } else if (receivedValue === 1) {
                $("#receivedBtn").removeClass("btn-info")
                    .addClass("btn-success")
                    .text("Received")
                    .prop("disabled", true);
            }
        });

    </script>
    <script type="text/javascript">
        $(document).on('click', '.view-file-link', function (e) {
            e.preventDefault();

            var fileUrl = $(this).data('url'); // Get file URL
            $('#filePreviewIframe').attr('src', fileUrl); // Set iframe src
            $('#filePreviewModal').modal('show'); // Show modal
        });

        $(document).ready(function(){
            active = '';
            orderOfPayment_tbl =  $("#applicationTable").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax" : '{{ route("admin.orderOfPayment.index") }}',
                "columns": [
                    { "data": "slug"},
                    { "data": "fullname"},
                    // { "data": "application_type"},
                    { "data": "company"},
                    { "data": "slug"},
                    { "data": "slug"},
                    { "data": "action" }
                ],
                "buttons": [
                    {!! __js::dt_buttons() !!}
                ],
                "columnDefs":[
                    {
                        "targets" : 0,
                        "orderable" : false,
                        "class" : 'action'
                    },

                    {
                        "targets": 1,
                        // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
                    }
                ],
                // "order" : [[2, 'desc']],
                "responsive": false,
                "initComplete": function( settings, json ) {
                    $('#tbl_loader').fadeOut(function(){
                        $("#applicationTableContainer").fadeIn();
                    });
                    dt_press_enter('#applicationTable_filter', orderOfPayment_tbl);
                },
                "language":
                    {
                        "processing": "<center><img  style='width: 70px' src='{{ asset('images/loader.gif') }}'></center>",
                    },
                "drawCallback": function(settings){
                    $('[data-toggle="tooltip"]').tooltip();
                    $('[data-toggle="modal"]').tooltip();
                    if(active != ''){
                        $("#applicationTable #"+active).addClass('success');
                    }
                }
            });

            $("body").on("click",".order_payment_btn", function(){
                btn = $(this);
                slug = btn.attr('data');
                uri = "{{route('admin.orderOfPayment.edit','slug')}}";
                uri = uri.replace('slug',slug);
                loading_modal(btn);
                $.ajax({
                    url : uri,
                    type: 'GET',
                    success:function(response){
                        populate_modal(btn,response);
                    },
                    error: function(response){
                        errored_modal(btn,response);
                    }
                })

            })


        });


    </script>
{{--    <script>--}}
{{--        $('#edit_modal').on('hidden.bs.modal', function () {--}}
{{--            $('.btn-group .btn').css('width', 'auto'); // Reset width when modal closes--}}
{{--        });--}}
{{--    </script>--}}

{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function () {--}}
{{--            // hanapin gamit ang eksaktong name sa HTML output--}}
{{--            const metricTonsInput = document.querySelector('input[name="metric_tons"]');--}}
{{--            const amountInput = document.querySelector('input[name="amount"]');--}}

{{--            if (!metricTonsInput || !amountInput) {--}}
{{--                console.error("Cant find the input fields. Check name/id sa HTML output.");--}}
{{--                return;--}}
{{--            }--}}

{{--            metricTonsInput.addEventListener('input', function () {--}}
{{--                let metricTons = parseFloat(metricTonsInput.value) || 0;--}}
{{--                let amount = metricTons * 60;--}}
{{--                amountInput.value = amount.toFixed(2);--}}
{{--            });--}}
{{--            console.log(metricTonsInput, amountInput);--}}

{{--        });--}}
{{--    </script>--}}

{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function () {--}}
{{--            const metricTonsInput = document.getElementById('metric_tons');--}}
{{--            const amountInput = document.getElementById('amount');--}}

{{--            if (!metricTonsInput || !amountInput) {--}}
{{--                console.error("Hindi makita ang mga input fields.");--}}
{{--                return;--}}
{{--            }--}}

{{--            function computeAmount() {--}}
{{--                let metricTons = parseFloat(metricTonsInput.value) || 0;--}}
{{--                let amount = metricTons * 60;--}}
{{--                amountInput.value = amount.toFixed(2);--}}
{{--                console.log("metricTons:", metricTons, "→ amount:", amount);--}}
{{--            }--}}

{{--            // initial compute (pag load pa lang)--}}
{{--            computeAmount();--}}

{{--            // update every time nagta-type ka--}}
{{--            metricTonsInput.addEventListener('input', computeAmount);--}}
{{--        });--}}
{{--    </script>--}}

{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function () {--}}
{{--            const metricTonsInput = document.getElementById('metric_tons');--}}
{{--            const amountInput = document.getElementById('amount');--}}

{{--            if (!metricTonsInput || !amountInput) {--}}
{{--                console.error("Hindi makita ang mga input fields.");--}}
{{--                return;--}}
{{--            }--}}

{{--            function computeAmount() {--}}
{{--                let metricTons = parseFloat(metricTonsInput.value) || 0;--}}
{{--                let amount = metricTons * 60;--}}
{{--                amountInput.value = amount.toFixed(2);--}}
{{--                console.log("metricTons:", metricTons, "→ amount:", amount);--}}
{{--            }--}}

{{--            // initial compute (pag load pa lang)--}}
{{--            computeAmount();--}}

{{--            // update every time nagta-type ka--}}
{{--            metricTonsInput.addEventListener('input', computeAmount);--}}
{{--        });--}}
{{--    </script>--}}






@endsection