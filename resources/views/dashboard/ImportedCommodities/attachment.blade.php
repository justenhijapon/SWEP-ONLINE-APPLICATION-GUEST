@extends('layouts.modal-content',['form_id'=> 'edit_form', 'slug'=>$data->slug])

@section('modal-header')
    {{$data->name}} - {{$data->slug}} | <span class="label label-primary pull-right">Attachment</span>

@endsection

@section('modal-body')
    <div class="row">
        @if(empty($data->application_form_path))
            {!! \App\Core\Helpers\__form2::file('application_form_path', [
               'label'=>'Application Form (Notarized)',
               'cols'=>'4',
               'id'=>'img_url_application_form_path',
               'required'=>'required',
            ], $data->slug) !!}
        @endif

        @if(empty($data->affidavit_path))
            {!! \App\Core\Helpers\__form2::file('affidavit_path', [
                 'label' => 'Affidavit',
                 'id'=>'img_url_affidavit_path',
                 'cols' => '4',
                 'rows'=>'2',
            ]) !!}
        @endif

        @if(empty($data->bill_landing_path))
            {!! \App\Core\Helpers\__form2::file('bill_landing_path', [
                 'label' => 'Bill of Landing',
                 'id'=>'img_url_bill_landing_path',
                 'cols' => '4',
                 'rows'=>'2',
            ]) !!}
        @endif

        @if(empty($data->commercial_invoice_path))
            {!! \App\Core\Helpers\__form2::file('commercial_invoice_path', [
                 'label' => 'Commercial Invoice',
                 'id'=>'img_url_commercial_invoice_path',
                 'cols' => '4',
                 'rows'=>'2',
            ]) !!}
        @endif

        @if(empty($data->packing_list_path))
            {!! \App\Core\Helpers\__form2::file('packing_list_path', [
                 'label' => 'Packing List',
                 'id'=>'img_url_packing_list_path',
                 'cols' => '4',
                 'rows'=>'2',
            ]) !!}
        @endif

        @if(empty($data->cert_origin_path))
            {!! \App\Core\Helpers\__form2::file('cert_origin_path', [
                 'label' => 'Certificate of Origin',
                 'id'=>'img_url_cert_origin_path',
                 'cols' => '4',
                 'rows'=>'2',
            ]) !!}
        @endif

        @if(empty($data->cert_analysis_path))
            {!! \App\Core\Helpers\__form2::file('cert_analysis_path', [
                 'label' => 'Certificate of Analysis',
                 'id'=>'img_url_cert_analysis_path',
                 'cols' => '4',
                 'rows'=>'2',
            ]) !!}
        @endif

        @if(empty($data->notarized_gmo_non_gmo_path))
            {!! \App\Core\Helpers\__form2::file('notarized_gmo_non_gmo_path', [
                 'label' => 'Notarized Declaration of GMO and Non-GMO',
                 'id'=>'img_url_notarized_gmo_non_gmo_path',
                 'cols' => '4',
                 'rows'=>'2',
            ]) !!}
        @endif

        @if(empty($data->important_declaration_path))
            {!! \App\Core\Helpers\__form2::file('important_declaration_path', [
                 'label' => 'Import Declaration (once available)',
                 'id'=>'img_url_important_declaration_path',
                 'cols' => '4',
                 'rows'=>'2',
            ]) !!}
        @endif

    </div>
@endsection

@section('modal-footer')
    <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection

@section('script')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var nameContainer = document.getElementById("name-container");
            var nameValue = `{!! $data->slug !!}`.trim(); // Ensure it is properly retrieved

            if (nameValue) {
                nameContainer.style.display = "none"; // Hide textbox if name is not null
            } else {
                nameContainer.style.display = "block"; // Show textbox if name is null
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            // Ensure correct form ID is used
            $("#edit_form").submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var slug = "{{$data->slug}}";
                var uri = "{{ route('dashboard.ImportedCommodities.update', 'slug') }}".replace('slug', slug);

                var formData = new FormData(this);
                formData.append('_method', 'PATCH');

                $.ajax({
                    url: uri,
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        succeed(form, false, true);
                        active = res.slug;
                        temp_tbl.draw(false);
                        notify('Data updated successfully', 'success');
                    },
                    error: function (res) {
                        errored(form, res);
                    }
                });
            });

            var existingImgUrl_application_form_path = "/show_file_custom/imported_commodities/{{$data->slug}}/application_form_path";
            var existingImgUrl_affidavit_path = "/show_file_custom/imported_commodities/{{$data->slug}}/affidavit_path";
            var existingImgUrl_bill_landing_path = "/show_file_custom/imported_commodities/{{$data->slug}}/bill_landing_path";
            var existingImgUrl_commercial_invoice_path = "/show_file_custom/imported_commodities/{{$data->slug}}/commercial_invoice_path";
            var existingImgUrl_packing_list_path = "/show_file_custom/imported_commodities/{{$data->slug}}/packing_list_path";
            var existingImgUrl_cert_origin_path = "/show_file_custom/imported_commodities/{{$data->slug}}/cert_origin_path";
            var existingImgUrl_cert_analysis_path = "/show_file_custom/imported_commodities/{{$data->slug}}/cert_analysis_path";
            var existingImgUrl_notarized_gmo_non_gmo_path = "/show_file_custom/imported_commodities/{{$data->slug}}/notarized_gmo_non_gmo_path";
            var existingImgUrl_important_declaration_path = "/show_file_custom/imported_commodities/{{$data->slug}}/important_declaration_path";

            function initializeFileInput(elementId, existingFileUrl) {
                $.ajax({
                    url: existingFileUrl,
                    type: 'HEAD', // Use HEAD request to check if file exists
                    success: function () {
                        $("#" + elementId).fileinput({
                            theme: "fa",
                            allowedFileExtensions: ["pdf", "jpeg", "jpg", "png", "txt"],
                            maxFileCount: 1,
                            showUpload: false,
                            showCaption: false,
                            overwriteInitial: true,
                            initialPreview: [existingFileUrl],
                            initialPreviewAsData: true,
                            previewFileType: "any", // Allow any file type preview
                            initialPreviewConfig: [
                                { type: "pdf", size: 1000, caption: "Packing List", key: 1 }
                            ],
                            fileType: "any",
                            browseClass: "btn btn-primary btn-md",
                            showRemove: true, // Allow users to remove uploaded file
                        });
                    },
                    error: function () {
                        $("#" + elementId).fileinput({
                            theme: "fa",
                            allowedFileExtensions: ["pdf", "jpeg", "jpg", "png", "txt"],
                            maxFileCount: 1,
                            showUpload: false,
                            showCaption: false,
                            overwriteInitial: true,
                            initialPreview: [], // No preview
                            fileType: "any",
                            browseClass: "btn btn-primary btn-md",
                            showRemove: true,
                        });
                        console.log('File not found for ' + elementId);
                    }
                });
            }

            // Initialize file input
            initializeFileInput("img_url_application_form_path", existingImgUrl_application_form_path);
            initializeFileInput("img_url_affidavit_path", existingImgUrl_affidavit_path);
            initializeFileInput("img_url_bill_landing_path", existingImgUrl_bill_landing_path);
            initializeFileInput("img_url_commercial_invoice_path", existingImgUrl_commercial_invoice_path);
            initializeFileInput("img_url_packing_list_path", existingImgUrl_packing_list_path);
            initializeFileInput("img_url_cert_origin_path", existingImgUrl_cert_origin_path);
            initializeFileInput("img_url_cert_analysis_path", existingImgUrl_cert_analysis_path);
            initializeFileInput("img_url_notarized_gmo_non_gmo_path", existingImgUrl_notarized_gmo_non_gmo_path);
            initializeFileInput("img_url_important_declaration_path", existingImgUrl_important_declaration_path);
        });
    </script>

@endsection
