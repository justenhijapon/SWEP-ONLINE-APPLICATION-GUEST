@extends('layouts.admin-master')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Imported Commodities</h2>
        </div>
    </div>

    <section class="content">
        <div class="ibox">
            <div class="box-header with-border ibox-content" style="padding: 5px">
               <div class="col-md-12">
                   <div class="row">
                       <div class="col-md-8">
                           <div class="pull-right">
                               <code>Fields with asterisks(*) are required</code>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            @csrf
            <form id="importedCommoditiesForm" method="POST" autocomplete="off" enctype="multipart/form-data">

                <div class="col-md-12 ibox-content">
                    <div class="row">

                        <div class="col-md-8">
                            <h4 style="color: darkslategray">Application For Clearance for the Release of Imported Commodities under Tariff Heading 1702 (Other Sugars) and 1704 (Sugar Confectionery)</h4>
                        </div><br>

                        <div class="col-md-8">
                            <div class="row">
                                {!! \App\Core\Helpers\__form2::textbox('name', [
                                'label'=>'Name:*',
                                'cols'=>'4',
                                'id'=>'name',
                                'placeholder' => '',
                                'required'=>'required',
                                ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('designation', [
                                    'label'=>'Applicant Designation:*',
                                    'cols'=>'4',
                                    'id'=>'designation',
                                    'placeholder' => '',
                                    'required'=>'required',
                                ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('company', [
                                        'label'=>'Company Name:*',
                                        'cols'=>'4',
                                        'id'=>'company',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('tin', [
                                        'label'=>'Consignee TIN No.:*',
                                        'cols'=>'4',
                                        'id'=>'tin',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('contact_no', [
                                        'label'=>'Contact No.:*',
                                        'cols'=>'4',
                                        'id'=>'contact_no',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('email', [
                                        'label'=>'Email:*',
                                        'cols'=>'4',
                                        'type'=>'email',
                                        'id'=>'email',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('adress', [
                                        'label'=>'Address:*',
                                        'cols'=>'4',
                                        'id'=>'adress',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('quantity_mt', [
                                        'label'=>'Quantity in Mt:*',
                                        'cols'=>'4',
                                        'id'=>'quantity_mt',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('bill_landing_no', [
                                        'label'=>'Bill of Landing No.:*',
                                        'cols'=>'4',
                                        'id'=>'bill_landing_no',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('country_origin', [
                                        'label'=>'Country of Origin:*',
                                        'cols'=>'4',
                                        'id'=>'country_origin',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('prod_description', [
                                        'label'=>'Product Description:*',
                                        'cols'=>'8',
                                        'id'=>'prod_description',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('port_discharge', [
                                        'label'=>'Port of Discharge:*',
                                        'cols'=>'4',
                                        'id'=>'port_discharge',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                                {!! \App\Core\Helpers\__form2::textbox('purpose_importation', [
                                        'label'=>'Purpose of Importation:*',
                                        'cols'=>'8',
                                        'id'=>'purpose_importation',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ]) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 style="color: darkslategray">REQUIRED DOCUMENTS</h4>
                                    <ul>
                                        <li><p class="text-bold">Application Form</p></li>
                                        <li><p class="text-bold">Affidavit</p></li>
                                        <li><p class="text-bold">Bill of Landing</p></li>
                                        <li><p class="text-bold">Commercial Invoice</p></li>
                                        <li><p class="text-bold">Packing List</p></li>
                                        <li><p class="text-bold">Certificate of Origin</p></li>
                                        <li><p class="text-bold">Certificate of Analysis</p></li>
                                        <li><p class="text-bold">Notarized Declaration of GMO and Non-GMO</p></li>
                                        <li><p class="text-bold">Import Declaration (once available)</p></li>
                                    </ul>

                                </div><br>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="box-footer">
                                <button id="btnBioEnergySubmit" type="submit" class="btn btn-primary pull-right">Generate</button>
                            </div>
                        </div>

                    </div>

                </div>

            </form>
        </div>
    </section>


@endsection
@section('modals')
@endsection
@section('scripts')

{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            var elem = document.querySelector('.js-switch');--}}
{{--            var switchery = new Switchery(elem, { color: '#1AB394' });--}}
{{--        });--}}
{{--    </script>--}}

    <script type="text/javascript">

        $("#importedCommoditiesForm").submit(function(e){
            e.preventDefault();
             form = $(this);
            formData = form.serialize();
            $.ajax({
                url : "{{route('dashboard.ImportedCommodities.store')}}",
                data: formData,
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $('.content-wrapper').html(res);
                    swal({
                        title: 'Success!',
                        text: 'New Application successfully added!',
                        icon: 'success',
                        confirmButtonText: 'Done'
                    })
                },
                error: function (res) {
                    swal({
                        title: "Empty!",
                        text: res.responseJSON.message.message,
                        type: "error"
                    });
                    console.log(res);
                    errored(form,res);
                }
            })
        })

        {{--$("#bioEnergyForm").submit(function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    let form = $(this);--}}
        {{--    let formData = new FormData(this);--}}
        {{--    loading_btn(form);--}}
        {{--    $.ajax({--}}
        {{--        url: "{{route('dashboard.ImportedCommodities.store')}}",--}}
        {{--        type: 'POST',--}}
        //         data: new FormData(this),
        //         processData: false,
        //         contentType: false,
        {{--        headers: {--}}
        {{--            {!! __html::token_header() !!}--}}
        {{--        },--}}
        {{--        success: function (res) {--}}
        {{--            $('form').trigger("reset");--}}
        {{--            $('#btnBioEnergySubmit').removeAttr("disabled");--}}
        {{--            $('#btnBioEnergySubmit').prop("disabled", false);--}}
        {{--            $('#btnBioEnergySubmit').html('<i class="fa fa-save"></i> Save');--}}
        //             Swal.fire({
        //                 title: 'Success!',
        //                 text: 'New Application successfully added!',
        //                 icon: 'success',
        //                 confirmButtonText: 'Done'
        //             })
        {{--        },--}}
        {{--        error: function (res) {--}}
        {{--            errored(form,res)--}}
        {{--        }--}}

        {{--    })--}}
        {{--})--}}


        $("#img_url").fileinput({
            theme: "fa",
            allowedFileExtensions: ["pdf", "jpeg", "jpg", "png", "txt"],
            maxFileCount: 1,
            showUpload: false,
            showCaption: false,
            overwriteInitial: true,
            fileType: "pdf",
            browseClass: "btn btn-primary btn-md",
        });
        $(".kv-file-remove").hide();



    </script>

    {{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            var elem = document.querySelector('.js-switch');--}}
{{--            var switchery = new Switchery(elem, { color: '#1AB394' });--}}
{{--        });--}}
{{--    </script>--}}

{{--    <script type="text/javascript">--}}
{{--        var baseContent = '{{$sucrose_contents['base_percentage']}}';--}}
{{--        var belowPrice = '{{$sucrose_contents['below_price']}}';--}}
{{--        var abovePrice = '{{$sucrose_contents['above_price']}}';--}}
{{--        var zeroContent = '{{$sucrose_contents['zero_content']}}';--}}

{{--        autonum_settings = {--}}
{{--            currencySymbol : ' PHP',--}}
{{--            decimalCharacter : '.',--}}
{{--            digitGroupSeparator : ',',--}}
{{--        };--}}

{{--        var nf = new Intl.NumberFormat('en-US', {--}}
{{--            style: 'currency',--}}
{{--            currency: 'PHP',--}}
{{--            minimumFractionDigits: 2,--}}
{{--            maximumFractionDigits: 2--}}
{{--        });--}}

{{--        function isNumberKey(evt) {--}}
{{--            var charCode = (evt.which) ? evt.which : event.keyCode--}}
{{--            if (charCode > 31 && (charCode < 48 || charCode > 57))--}}
{{--                return false;--}}

{{--            return true;--}}
{{--        }--}}

{{--        function delay(callback, ms) {--}}
{{--            var timer = 0;--}}
{{--            return function() {--}}
{{--                var context = this, args = arguments;--}}
{{--                clearTimeout(timer);--}}
{{--                timer = setTimeout(function () {--}}
{{--                    callback.apply(context, args);--}}
{{--                },500);--}}
{{--            };--}}
{{--        }--}}

{{--        $('input[name="volume"]').keyup(delay(function (e) {--}}
{{--            lgktc = $(this).val();--}}
{{--            $.ajax({--}}
{{--                url: '{{route('dashboard.get_settings')}}?lkgtc_multiplier='+lgktc,--}}
{{--                type: 'GET',--}}
{{--                success: function(res){--}}
{{--                    $("#amount").val(res.amount);--}}
{{--                },--}}
{{--                error:function (res) {--}}
{{--                    console.log(res);--}}
{{--                }--}}
{{--            })--}}
{{--        }, 500));--}}

{{--        new AutoNumeric("#amount",autonum_settings);--}}

{{--        $("body").on('change', '#transaction_type', function() {--}}
{{--            var t = $(this);--}}
{{--            var option = $("#transaction_type option[value='"+t.val()+"']");--}}
{{--            var type = option.attr('type');--}}
{{--            var amount = option.attr('amount');--}}
{{--            if(amount == 0){--}}
{{--                amount = option.attr('regularFee');--}}
{{--            }--}}

{{--            var stringAmount = '';--}}
{{--            if(option.attr('transactionCode') != 'PRE'){--}}
{{--                $("#divBtnAddProduct").slideUp();--}}
{{--                $("#divLabAnalysis").slideUp();--}}
{{--                $("#volume").removeAttr('disabled');--}}
{{--                if(amount != 0){--}}
{{--                    stringAmount = "<div><p><strong>Fee:</strong> " + nf.format(amount) + (type != 'STATIC'||type != 'APPLICATION'?' / ' + type:'') +"</p></div>";--}}
{{--                }--}}
{{--            }--}}

{{--            $("#amountString").html(stringAmount);--}}
{{--            $(".dynamics input").each(function () {--}}
{{--                $(this).val('');--}}
{{--            })--}}
{{--            $(".dynamics").each(function(){--}}
{{--                $(this).slideUp();--}}
{{--            })--}}

{{--            if(type != 'STATIC'){--}}
{{--                if(type != 'APPLICATION'){--}}
{{--                    $("#volume_container").slideDown();--}}
{{--                    $("#volume_container_amount").slideDown();--}}
{{--                }--}}
{{--            }--}}

{{--            if(option.attr('transactionCode') == 'PRE'){--}}
{{--                $.ajax({--}}
{{--                    url : "{{route('dashboard.payments.getLabAnalysis')}}",--}}
{{--                    type: 'GET',--}}
{{--                    success: function (res) {--}}
{{--                        $("#divLabAnalysis").html(res);--}}
{{--                    },--}}
{{--                    error: function (res) {--}}
{{--                        console.log(res);--}}
{{--                        errored(form,res);--}}
{{--                    }--}}
{{--                })--}}
{{--                $("#divBtnAddProduct").slideDown();--}}
{{--                $("#divLabAnalysis").slideDown();--}}
{{--                $("#divRen").slideDown();--}}
{{--                $("#switch_container").slideDown();--}}
{{--                $("#tonne_container").slideDown();--}}
{{--                $("#volume").attr("disabled", "disabled");--}}
{{--                $("#divProduct").slideDown();--}}

{{--            }--}}
{{--            else if(option.attr('transGroup') == 'LAB'){--}}
{{--                if(option.attr('regularFee') != 0){--}}
{{--                    $("#divTransactionTypesLabAnalysis").html('');--}}
{{--                }--}}
{{--                else {--}}
{{--                    var url = "{{route('dashboard.payments.getLabAnalysisTypes', 'transactionCode') }}";--}}
{{--                    var newUrl = url.replace('transactionCode', option.attr('transactionCode'))--}}
{{--                    $.ajax({--}}
{{--                        url : newUrl,--}}
{{--                        type: 'GET',--}}
{{--                        success: function (res) {--}}
{{--                            $("#divTransactionTypesLabAnalysis").html(res);--}}
{{--                        },--}}
{{--                        error: function (res) {--}}
{{--                            console.log(res);--}}
{{--                            errored(form,res);--}}
{{--                        }--}}
{{--                    })--}}
{{--                }--}}
{{--            }--}}
{{--        })--}}

{{--        function addLabAnalysisToListRegular(){--}}
{{--            $('#transactionTypesLabAnalysis :selected').each(function(i, sel){--}}
{{--                var names = $(sel).attr('labName');--}}
{{--                var regFee = $(sel).attr('regularFee');--}}
{{--                var tr = '<tr id='+$(sel).val()+'>' +--}}
{{--                    '<td width="15%"><label class="text-success">Regular</label> <input type="text" hidden id="isExpedite[]" name="isExpedite[]" value="FALSE"> <input type="text" hidden name="tdLabSlugs[]" id="tdLabSlugs[]" class="form-control" value="'+$(sel).val()+'" readonly></td>'+--}}
{{--                    '<td width="55%"><label>'+names+'</label><input type="text" hidden name="tdLabNames[]" id="tdLabNames[]" class="form-control" value="'+names+'" readonly></td>'+--}}
{{--                    '<td width="15%"><label>'+regFee+'</label><input type="text" hidden name="tdLabFees[]" id="tdLabFee[]" class="form-control" value="'+regFee+'" readonly></td>'+--}}
{{--                    '<td><a href="javascript:void(0)" class="btn btn-danger deleteRow"><i class=\'fa fa-trash-o\' ></i></a></td>'+--}}
{{--                    '</tr>';--}}
{{--                $('#tbTransactionTypesLabAnalysis > tbody').append(tr);--}}
{{--            });--}}
{{--        }--}}

{{--        function addLabAnalysisToListExpedite(){--}}
{{--            $('#transactionTypesLabAnalysis :selected').each(function(i, sel){--}}
{{--                var names = $(sel).attr('labName');--}}
{{--                var regFee = $(sel).attr('expediteFee');--}}
{{--                var tr = '<tr id='+$(sel).val()+'>' +--}}
{{--                    '<td width="15%"><label class="text-danger">Expedite</label> <input type="text" hidden id="isExpedite[]" name="isExpedite[]" value="TRUE"> <input type="text" hidden name="tdLabSlugs[]" id="tdLabSlugs[]" class="form-control" value="'+$(sel).val()+'" readonly></td>'+--}}
{{--                    '<td width="55%"><label>'+names+'</label><input type="text" hidden name="tdLabNames[]" id="tdLabNames[]" class="form-control" value="'+names+'" readonly></td>'+--}}
{{--                    '<td width="15%"><label>'+regFee+'</label><input type="text" hidden name="tdLabFees[]" id="tdLabFee[]" class="form-control" value="'+regFee+'" readonly></td>'+--}}
{{--                    '<td><a href="javascript:void(0)" class="btn btn-danger deleteRow"><i class=\'fa fa-trash-o\' ></i></a></td>'+--}}
{{--                    '</tr>';--}}
{{--                $('#tbTransactionTypesLabAnalysis > tbody').append(tr);--}}
{{--            });--}}
{{--        }--}}

{{--        $("body").on('click', '#tbTransactionTypesLabAnalysis tbody .deleteRow', function() {--}}
{{--            $(this).parent().parent().remove();--}}
{{--        });--}}



{{--        function addProductToList(){--}}
{{--            var r = $("#LabAnalysis");--}}
{{--            var option1 = $("#LabAnalysis option[id='"+r.val()+"']");--}}
{{--            if(option1.attr('sucrose') == 0 || (option1.attr('sucrose') > 0 && $("#volume").val() > 0)){--}}
{{--                if(option1.attr('sucrose') == 0){--}}
{{--                    $("#volume_amount").val(zeroContent);--}}
{{--                    $("#volume").val(0)--}}
{{--                }--}}
{{--                var r = $("#LabAnalysis");--}}
{{--                var option1 = $("#LabAnalysis option[id='"+r.val()+"']");--}}
{{--                var names = option1.attr('name');--}}
{{--                $("#totalVolume").val(Number($("#totalVolume").val())+Number($("#volume").val()));--}}
{{--                $("#totalAmount").val(Number($("#totalAmount").val())+Number($("#volume_amount").val().replace("PHP","")));--}}
{{--                var table = $('#tbProduct')[0];--}}
{{--                if (table.rows[option1.attr('id')]) {--}}
{{--                    var tdVol = $('#tbProduct tr[id='+option1.attr('id')+'] td input[name="tdVolume[]"]').val();--}}
{{--                    var tdAmnt = $('#tbProduct tr[id='+option1.attr('id')+'] td input[name="tdAmount[]"]').val();--}}
{{--                    $("#totalVolume").val(Number($("#totalVolume").val())-Number(tdVol));--}}
{{--                    $("#totalAmount").val(Number($("#totalAmount").val())-Number(tdAmnt.replace("PHP","")));--}}
{{--                    $('#tbProduct tr[id='+option1.attr('id')+']').remove();--}}

{{--                }--}}

{{--                var tr = '<tr id='+option1.attr('id')+'>' +--}}
{{--                    '<td width="15%"><label>'+option1.attr("id")+'</label> <input type="text" hidden name="tdID[]" id="tdID[]" class="form-control" value="'+option1.attr('id')+'" readonly></td>'+--}}
{{--                    '<td width="55%"><label>'+names+'</label><input type="text" hidden name="tdNames[]" id="tdNames[]" class="form-control" value="'+names+'" readonly></td>'+--}}
{{--                    '<td width="15%"><label>'+$("#volume").val()+'</label><input type="text" hidden name="tdVolume[]" id="tdVolume[]" class="form-control" value='+$("#volume").val()+' readonly></td>'+--}}
{{--                    '<td class="text-lg-right" width="15%"><label>'+$("#volume_amount").val()+'</label><input type="text" hidden name="tdAmount[]" id="tdAmount[]" class="form-control" value='+$("#volume_amount").val().replace("PHP", "", ).replace(/\,/g,"")+' readonly></td>'+--}}
{{--                    '<td><a href="javascript:void(0)" class="btn btn-danger deleteRow"><i class=\'fa fa-trash-o\' ></i></a></td>'+--}}
{{--                    '</tr>';--}}
{{--                $('#tbProduct > tbody').append(tr);--}}
{{--            }--}}
{{--            else {--}}
{{--                swal({--}}
{{--                    title: "Empty!",--}}
{{--                    text: "Please provide volume.",--}}
{{--                    type: "error"--}}
{{--                });--}}
{{--            }--}}
{{--        }--}}

{{--        $('#tbProduct > tbody').on('click', '.deleteRow', function() {--}}
{{--            $(this).parent().parent().remove();--}}
{{--        });--}}

{{--        $("body").on('change', '#LabAnalysis', function() {--}}
{{--            var t = $(this);--}}
{{--            var option = $("#LabAnalysis option[value='"+t.val()+"']");--}}
{{--            var sucCont = option.attr('sucrose');--}}
{{--            var stringAmount = '';--}}
{{--            if(sucCont == 0){--}}
{{--                stringAmount = "<div><table class='table mb-lg-3'><tbody><tr><td width='50%'><strong>Sucrose Content: </strong></td><td>" + sucCont + "%</td></tr><tr><td width='50%'><strong> Fee: </strong></td width='50%'><td>" +  nf.format(parseFloat(zeroContent)) + " / APPLICATION </td></tr></tbody></table></div>";--}}
{{--                $("#volume_container").slideUp();--}}
{{--                $("#volume_container_amount").slideUp();--}}

{{--            }--}}
{{--            else if(sucCont > 0 && sucCont <= baseContent){--}}
{{--                stringAmount = "<div><table class='table mb-lg-3'><tbody><tr><td width='50%'><strong>Sucrose Content: </strong></td><td>" + sucCont + "%</td></tr><tr><td width='50%'><strong> Fee: </strong></td><td width='50%'>" + nf.format(parseFloat(belowPrice)) + " / LKG </td></tr></tbody></table></div>";--}}
{{--                $("#volume_container").slideDown();--}}
{{--                $("#volume_container_amount").slideDown();--}}
{{--            }--}}
{{--            else if (sucCont > 0 && sucCont > baseContent) {--}}
{{--                stringAmount = "<div><table class='table mb-lg-3'><tbody><tr><td width='50%'><strong>Sucrose Content: </strong></td><td>" + sucCont + "%</td></tr><tr><td width='50%'><strong> Fee: </strong></td><td width='50%'>" + nf.format(parseFloat(abovePrice)) + " / LKG </td></tr></tbody></table></div>";--}}
{{--                $("#volume_container").slideDown();--}}
{{--                $("#volume_container_amount").slideDown();--}}
{{--            }--}}
{{--            $("#volume").val('');--}}
{{--            $("#volume_amount").val('');--}}
{{--            $("#amountString").html(stringAmount);--}}
{{--        })--}}

{{--        $("#volume_container input[name='volume']").keyup(function () {--}}
{{--            var t = $("#transaction_type");--}}
{{--            var option = $("#transaction_type option[value='"+t.val()+"']");--}}
{{--            if(option.attr('transactionCode') == 'PRE'){--}}
{{--                var r = $("#LabAnalysis");--}}
{{--                var option1 = $("#LabAnalysis option[id='"+r.val()+"']");--}}
{{--                var sucCont = option1.attr('sucrose');--}}
{{--                var sucContPercent = sucCont * .100;--}}
{{--                if(sucCont > 0 && sucCont<=baseContent){--}}
{{--                    $("#volume_amount").val(($(this).val()*belowPrice)*sucContPercent);--}}
{{--                    new AutoNumeric("#volume_amount",autonum_settings);--}}
{{--                }--}}
{{--                else if (sucCont > 0 && sucCont>baseContent) {--}}
{{--                    $("#volume_amount").val(($(this).val()*abovePrice)*sucContPercent);--}}
{{--                    new AutoNumeric("#volume_amount",autonum_settings);--}}
{{--                }--}}
{{--            }--}}
{{--            else {--}}
{{--                $("#volume_amount").val($(this).val()*option.attr('amount'));--}}
{{--                new AutoNumeric("#volume_amount",autonum_settings);--}}
{{--            }--}}

{{--        })--}}

{{--        $("#order_of_payment_form").submit(function(e){--}}
{{--            e.preventDefault();--}}
{{--            form = $(this);--}}
{{--            formData = form.serialize();--}}
{{--            $.ajax({--}}
{{--                url : "{{route('dashboard.payments.validate_form')}}",--}}
{{--                data: formData,--}}
{{--                type: 'POST',--}}
{{--                success: function (res) {--}}
{{--                    $('.content-wrapper').html(res);--}}
{{--                },--}}
{{--                error: function (res) {--}}
{{--                    swal({--}}
{{--                        title: "Empty!",--}}
{{--                        text: res.responseJSON.message.message,--}}
{{--                        type: "error"--}}
{{--                    });--}}
{{--                    console.log(res);--}}
{{--                    errored(form,res);--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}

{{--        $("#transaction_types_group").change(function(){--}}
{{--            $("#volume_container").slideUp();--}}
{{--            $("#volume_container_amount").slideUp();--}}
{{--            $("#divBtnAddProduct").slideUp();--}}
{{--            $("#divLabAnalysis").html('');--}}
{{--            $("#divTransactionTypesLabAnalysis").html('');--}}
{{--            $("#amountString").html('');--}}
{{--            $("#divProduct").slideUp();--}}

{{--            var t = $(this);--}}
{{--            var option = $("#transaction_types_group option[value='"+t.val()+"']");--}}
{{--            var optionID = option.val();--}}
{{--            var url = "{{route('dashboard.payments.groupSelected', 'optionID') }}";--}}
{{--            var newUrl = url.replace('optionID', optionID)--}}
{{--            if(optionID != "LAB"){--}}
{{--                $("#divTransactionTypesLabAnalysis").slideUp();--}}
{{--            }--}}
{{--            $.ajax({--}}
{{--                url : newUrl,--}}
{{--                type: 'GET',--}}
{{--                success: function (res) {--}}
{{--                    $('#divTypeGroup').html(res);--}}
{{--                },--}}
{{--                error: function (res) {--}}
{{--                    console.log(res);--}}
{{--                    errored(form,res);--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}

{{--        $("#tonne_container input[name='metricTonne']").keyup(function () {--}}
{{--            $("#volume").val(($(this).val()*1000)/50);--}}

{{--            var t = $("#transaction_type");--}}
{{--            var option = $("#transaction_type option[value='"+t.val()+"']");--}}
{{--            if(option.attr('transactionCode') == 'PRE'){--}}
{{--                var r = $("#LabAnalysis");--}}
{{--                var option1 = $("#LabAnalysis option[id='"+r.val()+"']");--}}
{{--                var sucCont = option1.attr('sucrose');--}}
{{--                var sucContPercent = sucCont * .100;--}}
{{--                if(sucCont > 0 && sucCont<=baseContent){--}}
{{--                    $("#volume_amount").val(($("#volume").val()*belowPrice)*sucContPercent);--}}
{{--                    new AutoNumeric("#volume_amount",autonum_settings);--}}
{{--                }--}}
{{--                else if (sucCont > 0 && sucCont>baseContent) {--}}
{{--                    $("#volume_amount").val(($("#volume").val()*abovePrice)*sucContPercent);--}}
{{--                    new AutoNumeric("#volume_amount",autonum_settings);--}}
{{--                }--}}
{{--            }--}}
{{--            else {--}}
{{--                $("#volume_amount").val($(this).val()*option.attr('amount'));--}}
{{--                new AutoNumeric("#volume_amount",autonum_settings);--}}
{{--            }--}}
{{--        })--}}

{{--        $("#kg_container input[name='kilogram']").keyup(function () {--}}
{{--            $("#volume").val($(this).val()/50);--}}
{{--            var t = $("#transaction_type");--}}
{{--            var option = $("#transaction_type option[value='"+t.val()+"']");--}}
{{--            if(option.attr('transactionCode') == 'PRE'){--}}
{{--                var r = $("#LabAnalysis");--}}
{{--                var option1 = $("#LabAnalysis option[id='"+r.val()+"']");--}}
{{--                var sucCont = option1.attr('sucrose');--}}
{{--                var sucContPercent = sucCont * .100;--}}
{{--                if(sucCont > 0 && sucCont<=baseContent){--}}
{{--                    $("#volume_amount").val(($("#volume").val()*belowPrice)*sucContPercent);--}}
{{--                    new AutoNumeric("#volume_amount",autonum_settings);--}}
{{--                }--}}
{{--                else if (sucCont > 0 && sucCont>baseContent) {--}}
{{--                    $("#volume_amount").val(($("#volume").val()*abovePrice)*sucContPercent);--}}
{{--                    new AutoNumeric("#volume_amount",autonum_settings);--}}
{{--                }--}}
{{--            }--}}
{{--            else {--}}
{{--                $("#volume_amount").val($(this).val()*option.attr('amount'));--}}
{{--                new AutoNumeric("#volume_amount",autonum_settings);--}}
{{--            }--}}
{{--        })--}}

{{--        $( "#switch_container" ).click(function() {--}}
{{--            // Get the checkbox--}}
{{--            var checkBox = document.getElementById("switch");--}}

{{--            // If the checkbox is checked, display the output text--}}
{{--            if (checkBox.checked == true){--}}
{{--                $("#kilogram").val("0");--}}
{{--                $("#volume").val("0");--}}
{{--                $("#volume_amount").val("0");--}}
{{--                $("#kg_container").slideUp();--}}
{{--                $("#tonne_container").slideDown();--}}
{{--            } else {--}}
{{--                $("#metricTonne").val("0");--}}
{{--                $("#volume").val("0");--}}
{{--                $("#volume_amount").val("0");--}}
{{--                $("#kg_container").slideDown();--}}
{{--                $("#tonne_container").slideUp();--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection