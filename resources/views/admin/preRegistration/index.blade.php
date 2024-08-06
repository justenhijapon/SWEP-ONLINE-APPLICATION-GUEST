@extends('admin-layouts.main-layout')

@section('content')
    <section class="content-header">
        <h1>
            Pre Registration
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pre Registration</li>
        </ol>
    </section>

    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        Pre Registration
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div id="tbl_loader" class="loader" style="padding-top: 10%; padding-bottom: 10%">
                    <img src="{{ asset('images/load_anim.gif') }}">
                </div>
                <div id="preRegistrationTableContainer" hidden="">
                    <table class="table table-bordered table-condensed table-striped" id="preRegistrationTable" style="width: 100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
            </div>
        </div>
    </section>
@endsection

@section('modals')
    <div class="modal fade" tabindex="-1" role="dialog" id="view_modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        active = '';
        preRegistrationTbl =  $("#preRegistrationTable").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax" : '{{ route("admin.preRegistration.index") }}',
            "columns": [
                { "data": "slug"},
                { "data": "last_name"},
                { "data": "first_name"},
                { "data": "middle_name"},
                { "data": "phone"},
                { "data": "status"},
                { "data": "action" }
            ],
            "columnDefs":[
                {
                    "targets" : 6,
                    "orderable" : false,
                    "class" : 'action'
                },
                {
                    "targets": 3,
                    // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
                }
            ],
            "order" : [[2, 'desc']],
            "responsive": false,
            "initComplete": function( settings, json ) {
                $('#tbl_loader').fadeOut(function(){
                    $("#preRegistrationTableContainer").fadeIn();
                });
                dt_press_enter('#preRegistrationTableFilter', preRegistrationTbl);
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src=''></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#preRegistrationTable #"+active).addClass('success');
                }
            }
        });

        $("body").on("click",".view_btn", function () {
            target_modal = $(this).attr('data-target');
            tr_id = $(this).attr('data');
            uri  = "{{route('admin.preRegistration.show', 'slug')}}";
            uri = uri.replace('slug',tr_id);
            $(target_modal+" .modal-content").html('<div class="loader-demo-box">\n' +
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

        $("body").on("click",".approved", function () {
            tr_id = $(this).attr('data');
            uri  = "{{route('admin.preRegistration.approved', 'id')}}";
            uri = uri.replace('id',tr_id);
            $.ajax({
                url : uri,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    swal({
                        title: "Success!",
                        text: "Successfully Approved.",
                        type: "success"
                    });
                },
                error: function(response){
                    console.log(res);
                }
            })
        })
    });
</script>
@endsection