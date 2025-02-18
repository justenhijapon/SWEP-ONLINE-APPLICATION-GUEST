@extends('layouts.admin-master')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">My Transactions</h4>
            <div id="loading">
                <div class="circle-loader" style="margin-top: 200px; margin-bottom: 200px"></div>
            </div>
            <iframe hidden id="printIframe" src="">

            </iframe>
            <div id="my_payments_table_container" style="display: none">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="my_payments_table" class="table dataTable no-footer table-condensed" role="grid" aria-describedby="order-listing_info" style="width: 100% !important;">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Transaction ID</th>
                                    <th>Application Type</th>
                                    <th>Name|Details</th>
                                    <th>Product Description</th>
                                    <th>Purpose of Importation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! __html::modal_loader() !!}
@endsection

@section('modals')
    {!! __html::blank_modal('edit_modal','lg') !!}
    <div class="modal fade" tabindex="-1" role="dialog" id="view_modal">
        <div class="modal-dialog" role="document" style="max-width:45% !important;">
            <div class="modal-content">

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        modal_loader = $(".loader_container").html();

        $(document).ready(function() {


            // modal_loader = $(".loader_container").html();
            temp_tbl = $("#my_payments_table").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route("dashboard.ImportedCommodities.index") }}?status=Active',
                "pageLength": 5,
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, 'All']],
                "columns": [
                    {"data": "date"},
                    {"data": "slug"},
                    {"data": "application_type"},
                    {"data": "name"},
                    {"data": "name"},
                    {"data": "slug"},
                    {"data": "status"},
                    {"data": "action"},
                ],
                "order": [[0, "desc"]],
                "columnDefs": [
                    {
                        "className": "action_column",
                        "targets": [5],
                    },
                    {
                        "visible": false,
                        "targets": [0],
                    }
                ],
                "language": {
                    "processing": "<div class='flip-square-loader mx-auto'></div>",
                },
                "initComplete": function (settings, json) {
                    console.log("#" + settings.sTableId + "_container");
                    $("#loading").fadeOut(function () {
                        $("#" + settings.sTableId + "_container").fadeIn();
                    });

                }
            });

            $('#my_payments_table_filter input[type="search"]').unbind();
            $('#my_payments_table_filter input[type="search"]').bind('keyup', function (e) {
                if (e.keyCode == 13) {
                    temp_tbl.search(this.value).draw();
                }
            });

            {{--$(".select_filter").change(function(){--}}
            {{--    var status = $(".select_filter[name='status']").val();--}}
            {{--    var transaction_type = $(".select_filter[name='transaction_type']").val();--}}
            {{--    temp_tbl.ajax.url('{{ route("dashboard.ImportedCommodities.index") }}?status='+status+'&transaction_type='+transaction_type).load();--}}

            {{--    $(".select_filter").each(function(){--}}
            {{--        if($(this).val() != 'All'){--}}
            {{--            $(this).addClass('border-info');--}}
            {{--        }else{--}}
            {{--            $(this).removeClass('border-info');--}}
            {{--        }--}}
            {{--    })--}}
            {{--})--}}

            $("body").on("click", ".view_btn", function () {
                target_modal = $(this).attr('data-target');

                tr_id = $(this).attr('data');
                uri = "{{route('dashboard.ImportedCommodities.show', 'slug')}}";
                uri = uri.replace('slug', tr_id);
                $(target_modal + " .modal-content").html('<div class="loader-demo-box">\n' +
                    '                    <div class="square-box-loader">\n' +
                    '                        <div class="square-box-loader-container">\n' +
                    '                            <div class="square-box-loader-corner-top"></div>\n' +
                    '                            <div class="square-box-loader-corner-bottom"></div>\n' +
                    '                        </div>\n' +
                    '                        <div class="square-box-loader-square"></div>\n' +
                    '                    </div>\n' +
                    '                </div>');
                $.ajax({
                    url: uri,
                    type: 'GET',
                    success: function (res) {
                        $(target_modal).find('.modal-content').html(res);
                    },
                    error: function (res) {
                        console.log(res);
                    }
                })

            })


            $("body").on('click', '.print_btn', function () {
                tr_id = $(this).attr('data');
                var printRoute = "{{route('printTransactionIc')}}";
                var newPrintRoute = printRoute + "?transactionId=" + tr_id;
                $("#printIframe").attr('src', newPrintRoute);
                setTimeout(printIframe, 500);
            })


            function printIframe() {
                $("#printIframe").get(0).contentWindow.print();
            }


            $("body").on("click", ".edit_btn", function () {
                btn = $(this);
                slug = btn.attr('data');
                uri = "{{route('dashboard.ImportedCommodities.edit','slug')}}";
                uri = uri.replace('slug', slug);
                loading_modal(btn);
                $.ajax({
                    url: uri,
                    type: 'GET',
                    success: function (response) {
                        populate_modal(btn, response);

                    },
                    error: function (response) {
                        console.log(response);
                    }
                })

            });

        {{--    $('body').on('submit', "#edit_form", function (e) {--}}
        {{--        e.preventDefault();--}}
        {{--        form = $(this);--}}
        {{--        slug = form.attr('data');--}}
        {{--        formdata = form.serialize();--}}
        {{--        uri = "{{route('dashboard.ImportedCommodities.update','slug')}}";--}}
        {{--        uri = uri.replace('slug', slug);--}}
        {{--        loading_btn(form);--}}
        {{--        $.ajax({--}}
        {{--            url: uri,--}}
        {{--            data: formdata,--}}
        {{--            type: 'PATCH',--}}
        {{--            success: function (response) {--}}
        {{--                succeed(form, true, true);--}}
        {{--                active = response.slug;--}}
        {{--                temp_tbl.draw();--}}
        {{--            },--}}
        {{--            error: function (response) {--}}
        {{--                errored(form, response);--}}
        {{--            }--}}
        {{--        })--}}
        {{--    });--}}

        {{--    $("#img_url").fileinput({--}}
        {{--        theme: "fa",--}}
        {{--        allowedFileExtensions: ["pdf", "jpeg", "jpg", "png", "txt"],--}}
        {{--        maxFileCount: 1,--}}
        {{--        showUpload: false,--}}
        {{--        showCaption: false,--}}
        {{--        overwriteInitial: true,--}}
        {{--        fileType: "pdf",--}}
        {{--        browseClass: "btn btn-primary btn-md",--}}
        {{--    });--}}
        {{--    $(".kv-file-remove").hide();--}}

        })



</script>
@endsection