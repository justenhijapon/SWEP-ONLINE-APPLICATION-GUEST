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
                                ],$data->name) !!}
								{!! \App\Core\Helpers\__form2::textbox('designation', [
                                    'label'=>'Applicant Designation:*',
                                    'cols'=>'4',
                                    'id'=>'designation',
                                    'placeholder' => '',
                                    'required'=>'required',
                                ], $data->designation) !!}
								{!! \App\Core\Helpers\__form2::textbox('company', [
                                        'label'=>'Company Name:*',
                                        'cols'=>'4',
                                        'id'=>'company',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->company) !!}
								{!! \App\Core\Helpers\__form2::textbox('tin', [
                                        'label'=>'Consignee TIN No.:*',
                                        'cols'=>'4',
                                        'id'=>'tin',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->tin) !!}
								{!! \App\Core\Helpers\__form2::textbox('contact_no', [
                                        'label'=>'Contact No.:*',
                                        'cols'=>'4',
                                        'id'=>'contact_no',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->contact_no) !!}
								{!! \App\Core\Helpers\__form2::textbox('email', [
                                        'label'=>'Email:*',
                                        'cols'=>'4',
                                        'type'=>'email',
                                        'id'=>'email',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->email) !!}
								{!! \App\Core\Helpers\__form2::textbox('adress', [
                                        'label'=>'Address:*',
                                        'cols'=>'4',
                                        'id'=>'adress',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->adress) !!}
								{!! \App\Core\Helpers\__form2::textbox('quantity_mt', [
                                        'label'=>'Quantity in Mt:*',
                                        'cols'=>'4',
                                        'id'=>'quantity_mt',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->quantity_mt) !!}
								{!! \App\Core\Helpers\__form2::textbox('bill_landing_no', [
                                        'label'=>'Bill of Landing No.:*',
                                        'cols'=>'4',
                                        'id'=>'bill_landing_no',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->bill_landing_no) !!}
								{!! \App\Core\Helpers\__form2::textbox('country_origin', [
                                        'label'=>'Country of Origin:*',
                                        'cols'=>'4',
                                        'id'=>'country_origin',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->country_origin) !!}
								{!! \App\Core\Helpers\__form2::textbox('prod_description', [
                                        'label'=>'Product Description:*',
                                        'cols'=>'8',
                                        'id'=>'prod_description',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->prod_description) !!}
								{!! \App\Core\Helpers\__form2::textbox('port_discharge', [
                                        'label'=>'Port of Discharge:*',
                                        'cols'=>'4',
                                        'id'=>'port_discharge',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->port_discharge) !!}
								{!! \App\Core\Helpers\__form2::textbox('purpose_importation', [
                                        'label'=>'Purpose of Importation:*',
                                        'cols'=>'8',
                                        'id'=>'purpose_importation',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->purpose_importation) !!}
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

	<script type="text/javascript">

		$("#importedCommoditiesForm").submit(function (e) {
			e.preventDefault();
			var form = $(this);
			var slug = "{{$data->slug}}";
			var uri = "{{ route('dashboard.ImportedCommodities.update', 'slug') }}";
			uri = uri.replace('slug', slug);

			var formData = new FormData(this);
			formData.append('_method', 'PATCH'); // Laravel requires PATCH for updates

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

		var existingImgUrlITB = "/show_file_custom/imported_commodities/{{$data->slug}}/packing_list_path";

		function initializeFileInput(elementId, existingFileUrl) {
			$.ajax({
				url: existingFileUrl,
				type: 'GET',
				success: function () {
					// If the file exists, show the preview
					$("#" + elementId).fileinput({
						theme: "fa",
						allowedFileExtensions: ["pdf", "jpeg", "jpg", "png", "txt"],
						maxFileCount: 1,
						showUpload: false,
						showCaption: false,
						overwriteInitial: true,
						initialPreview: [existingFileUrl],
						initialPreviewAsData: true,
						initialPreviewFileType: 'image',
						initialPreviewConfig: [
							{ type: "pdf", size: 1000, caption: "PDF Document", key: 1 } // Customize as needed
						],
						fileType: "pdf",
						browseClass: "btn btn-primary btn-md",
					});
				},
				error: function () {
					// If the file doesn't exist, initialize fileinput without preview
					$("#" + elementId).fileinput({
						theme: "fa",
						allowedFileExtensions: ["pdf", "jpeg", "jpg", "png", "txt"],
						maxFileCount: 1,
						showUpload: false,
						showCaption: false,
						overwriteInitial: true,
						initialPreview: [], // No preview
						fileType: "pdf",
						browseClass: "btn btn-primary btn-md",
					});
					console.log('File not found for ' + elementId);
				}
			});
		}

		// Initialize file inputs for ITB and PBD
		initializeFileInput("packing_list_path", existingImgUrlITB);
		// initializeFileInput("img_url_pbd", existingImgUrlPBD);

		// Hide file remove button
		$(".kv-file-remove").hide();



		{{--$(document).ready(function () {--}}
		{{--	var existingFileUrl = "/show_file/imported_commodities/{{$data->slug}}";--}}

		{{--	$.ajax({--}}
		{{--		url: existingFileUrl,--}}
		{{--		type: 'HEAD', // Check if the file exists--}}
		{{--		success: function () {--}}
		{{--			$("#packing_list_path").fileinput({--}}
		{{--				theme: "fa",--}}
		{{--				allowedFileExtensions: ["pdf"],--}}
		{{--				maxFileCount: 1,--}}
		{{--				showUpload: false,--}}
		{{--				showCaption: true,--}}
		{{--				overwriteInitial: true,--}}
		{{--				initialPreview: [existingFileUrl],--}}
		{{--				initialPreviewAsData: true,--}}
		{{--				initialPreviewFileType: 'pdf',--}}
		{{--				browseClass: "btn btn-primary btn-md",--}}
		{{--			});--}}
		{{--		},--}}
		{{--		error: function () {--}}
		{{--			$("#packing_list_path").fileinput({--}}
		{{--				theme: "fa",--}}
		{{--				allowedFileExtensions: ["pdf"],--}}
		{{--				maxFileCount: 1,--}}
		{{--				showUpload: false,--}}
		{{--				showCaption: true,--}}
		{{--				overwriteInitial: true,--}}
		{{--				initialPreview: [],--}}
		{{--				browseClass: "btn btn-primary btn-md",--}}
		{{--			});--}}
		{{--			console.log('No existing file found.');--}}
		{{--		}--}}
		{{--	});--}}
		{{--});--}}



	</script>

@endsection