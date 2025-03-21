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
                                    <h4 style="color: darkslategray">REQUIRED ATTACHED DOCUMENTS</h4>
                                    <ul>
                                        <li><p class="text-bold">Application Form (Notarized)</p></li>
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
            let form = $(this);
            // var formData = new FormData(this)
            formData = form.serialize();
            $.ajax({
                url : "{{route('dashboard.ImportedCommodities.store')}}",
                data: formData,
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $('form').trigger("reset");
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


@endsection