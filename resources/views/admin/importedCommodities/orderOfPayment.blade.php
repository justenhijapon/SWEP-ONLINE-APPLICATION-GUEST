@extends('admin-layouts.modal-content', ['form_id'=> 'OrderPayment_form', 'slug'=>$data->slug])

@section('modal-header')
    <div>
        <code>{{$data->slug}}</code> | Order of Payment
    </div>

@endsection

@section('content')

@endsection

@section('modal-body')
    <style>
        text-uppercase{
            text-transform: capitalize !important;
        }
    </style>
    <div class="row text-capitalize">
        <div class="col-md-12">
            <code class="pull-right">Fields with asterisks(*) are required</code>
        </div>


        {!! \App\Core\Helpers\__form2::textbox('reference_no', [
            'label'=>'Reference No. STD:',
            'cols'=>'4',
            'class'=>'text-uppercase',
            'id'=>'slug',
            'placeholder' => '',
            'required'=>'required',
        ], $data->reference_no) !!}
        <div class="col-md-12"></div>

        {!! \App\Core\Helpers\__form2::textbox('fullname', [
            'label'=>'To:',
            'cols'=>'6',
            'class'=>'text-uppercase',
            'id'=>'slug',
            'placeholder' => '',
//            'required'=>'required',
        ], $data->fullname) !!}


        {!! \App\Core\Helpers\__form2::textbox('company', [
            'label'=>'Company:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
//            'required'=>'required',
        ], $data->company) !!}

        {!! \App\Core\Helpers\__form2::textbox('amount', [
            'label'=>'Amount:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
//            'required'=>'required',
        ], $data->amount) !!}

        {!! \App\Core\Helpers\__form2::textbox('amount_in_word', [
            'label'=>'Amount in word:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
//            'required'=>'required',
        ], $data->amount_in_word) !!}

        {!! \App\Core\Helpers\__form2::textbox('lkg_bags', [
            'label'=>'Lkg-Bags:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
//            'required'=>'required',
        ], $data->lkg_bags) !!}

        {!! \App\Core\Helpers\__form2::textbox('metric_tons', [
            'label'=>'Metric Tons:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
//            'required'=>'required',
        ], $data->metric_tons) !!}

        {!! \App\Core\Helpers\__form2::textbox('boc_entry_no', [
            'label'=>'BOC Entry No.:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
//            'required'=>'required',
        ], $data->boc_entry_no) !!}

        {!! \App\Core\Helpers\__form2::textbox('boc_entry_note', [
            'label'=>'Certified Correct:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
//            'required'=>'required',
        ], $data->boc_entry_note) !!}

        {!! \App\Core\Helpers\__form2::textbox('certified_correct', [
            'label'=>'Approved By:',
            'cols'=>'6',
            'id'=>'slug',
            'placeholder' => '',
//            'required'=>'required',
        ], $data->certified_correct) !!}

    </div>
@endsection

@section('modal-footer')
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
@endsection



@section('scripts')
{{--    <script>--}}
{{--        $("#edit_my_form").submit(function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var form = $(this);--}}
{{--            var slug = form.attr('data');--}}
{{--            var uri = "{{ route('dashboard.bio_energy.update', 'slug') }}";--}}
{{--            uri = uri.replace('slug', slug);--}}

{{--            var formData = new FormData(this);--}}

{{--            $.ajax({--}}
{{--                url: uri,--}}
{{--                data: formData,--}}
{{--                type: 'POST',--}}
{{--                contentType: false,--}}
{{--                processData: false,--}}
{{--                headers: {--}}
{{--                    'X-HTTP-Method-Override': 'PATCH',--}}
{{--                    {!! __html::token_header() !!}--}}
{{--                },--}}

{{--                success: function (res) {--}}
{{--                    succeed(form, false, true);--}}
{{--                    active = res.slug;--}}
{{--                    bio_energy_tbl.draw(false);--}}
{{--                    notify('Data change success', 'success');--}}
{{--                },--}}
{{--                error: function (res) {--}}
{{--                    errored(form, res);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--        var existingFileUrl = "/show_file/bio_energy/{{$bioEnergy->slug}}";--}}

{{--        $.ajax({--}}
{{--            url: existingFileUrl,--}}
{{--            type: 'GET',--}}
{{--            success: function () {--}}
{{--                $("#img_url").fileinput({--}}
{{--                    theme: "fa",--}}
{{--                    allowedFileExtensions: ["jpeg", "jpg", "png", "PDF"],--}}
{{--                    maxFileCount: 1,--}}
{{--                    showUpload: false,--}}
{{--                    showCaption: false,--}}
{{--                    overwriteInitial: true,--}}
{{--                    initialPreview: [existingFileUrl],--}}
{{--                    initialPreviewAsData: true,--}}
{{--                    initialPreviewFileType: 'pdf',--}}
{{--                    fileType: "pdf",--}}
{{--                    browseClass: "btn btn-primary btn-md",--}}
{{--                });--}}
{{--            },--}}
{{--            error: function () {--}}
{{--                $("#img_url").fileinput({--}}
{{--                    theme: "fa",--}}
{{--                    allowedFileExtensions: ["jpeg", "jpg", "png", "PDF"],--}}
{{--                    maxFileCount: 1,--}}
{{--                    showUpload: false,--}}
{{--                    showCaption: false,--}}
{{--                    overwriteInitial: true,--}}
{{--                    initialPreview: [],--}}
{{--                    fileType: "pdf",--}}
{{--                    browseClass: "btn btn-primary btn-md",--}}
{{--                });--}}
{{--                console.log('File not found');--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection

