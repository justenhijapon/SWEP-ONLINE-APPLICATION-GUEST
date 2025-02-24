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
								{!! \App\Core\Helpers\__form2::textbox('address', [
                                        'label'=>'Address:*',
                                        'cols'=>'4',
                                        'id'=>'adress',
                                        'placeholder' => '',
                                        'required'=>'required',
                                    ], $data->address) !!}
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


								@php
									$files = [
                                        'application_form_path' => 'Application Form (Notarized)',
                                        'affidavit_path' => 'Affidavit',
                                        'bill_landing_path' => 'Bill of Landing',
                                        'commercial_invoice_path' => 'Commercial Invoice',
                                        'packing_list_path' => 'Packing List',
                                        'cert_origin_path' => 'Certificate of Origin',
                                        'cert_analysis_path' => 'Certificate of Analysis',
                                        'notarized_gmo_non_gmo_path' => 'Notarized Declaration of GMO and Non-GMO',
                                        'important_declaration_path' => 'Import Declaration (once available)',
                                    ];
								@endphp

								@foreach ($files as $columnName => $label)
									@php
										$fileUrl = route('show_file_custom', [
                                            'tableName' => 'imported_commodities',
                                            'slug' => $data->slug,
                                            'columnName' => $columnName
                                        ]);
//                                        dd($fileUrl);
									@endphp

									{!! \App\Core\Helpers\__form2::file($columnName, [
                                        'label' => $label,
                                        'cols' => '4',
                                        'id' => 'img_url_' . $columnName, // Ensure a unique ID
                                        'class' => 'file-input',
                                        'data-file-url' => $fileUrl
                                    ]) !!}


{{--									<div class="col-md-4">--}}
{{--										<div class="form-group">--}}
{{--											<label>{{$label}}</label>--}}
{{--											<input type="file" class="form-control form-control-subject file-input" id="img_url_{{$columnName}}" data-file-url="{{$fileUrl}}">--}}
{{--											<input class="form-control form-control-subject" id="bill_landing_path" name="bill_landing_path" type="file">--}}
{{--										</div>--}}
{{--									</div>--}}

								@endforeach

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
								<button id="btnBioEnergySubmit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
								<span class="pull-right" style="padding-right: 20px">
									<button type="button" class="btn btn-primary btn-lg btn-outline view_btn" data="{{$data->slug}}" data-toggle="modal" data-target="#view_modal">Print Preview</button>
{{--							   <button type="button" class="btn btn-success btn-lg btn-outline print_btn" data="{{$data->slug}}" id="printBtn{{$data->slug}}"><i class="fa fa-print"></i> Print</button>--}}
							</span>
							</div>
						</div>

					</div>

				</div>

			</form>
		</div>
	</section>

	<iframe hidden id="printIframe" src="">

	</iframe>

	{!! __html::modal_loader() !!}
@endsection
@section('modals')
	<div class="modal fade" tabindex="-1" role="dialog" id="view_modal">
		<div class="modal-dialog" role="document" style="max-width:45% !important;">
			<div class="modal-content">

			</div>
		</div>
	</div>
@endsection
@section('scripts')



	<script>
		$(document).ready(function () {
			let fileInputs = $(".file-input");

			if (fileInputs.length === 0) {
				console.error("❌ No file input elements found! Check your Blade template.");
				return;
			}

			$(".file-input").each(function () {
				var $this = $(this);
				var existingFileUrl = $this.data("file-url");

				if (!existingFileUrl) {
					console.warn("⚠️ No file URL found for:", $this.attr("id"));
					return;
				}

				console.log("✅ Initializing file input for:", $this.attr("id"), "with URL:", existingFileUrl);

				var fileType = existingFileUrl.match(/\.pdf$/i) ? "pdf" : "image";

				$this.fileinput({
					theme: "fa",
					allowedFileExtensions: ["pdf", "jpeg", "jpg", "png"],
					maxFileCount: 1,
					showUpload: false,
					showCaption: false,
					overwriteInitial: true,
					initialPreview: existingFileUrl ? [existingFileUrl] : [],
					initialPreviewAsData: true,
					initialPreviewFileType: fileType,
					browseClass: "btn btn-primary btn-md",
					initialPreviewConfig: fileType === "pdf" ? [{ type: "pdf", caption: "PDF Preview", key: 1 }] : [],
				});
			});


			// Fetch file paths via AJAX and update the inputs
			$.ajax({
				url: "/api/get-file-paths/{{$data->slug}}",
				type: "GET",
				success: function (data) {
					console.log("✅ Received File Paths:", data); // Debugging
					Object.keys(data).forEach(function (key) {
						let fileInputId = "img_url_" + key;
						let fileUrl = data[key];

						if (!$("#" + fileInputId).length) {
							console.error("❌ File input not found for:", fileInputId);
							return;
						}

						console.log("📂 Updating file input:", fileInputId, "with URL:", fileUrl);

						$("#" + fileInputId).fileinput('destroy').fileinput({
							theme: "fa",
							allowedFileExtensions: ["pdf", "jpeg", "jpg", "png", "txt"],
							maxFileCount: 1,
							showUpload: false,
							showCaption: false,
							overwriteInitial: true,
							initialPreview: fileUrl ? [fileUrl] : [],
							initialPreviewAsData: true,
							initialPreviewFileType: fileUrl.endsWith(".pdf") ? "pdf" : "image",
							browseClass: "btn btn-primary btn-md",
							initialPreviewConfig: fileUrl.endsWith(".pdf") ? [{
								type: "pdf",
								caption: "PDF Preview",
								downloadUrl: fileUrl,
								key: 1
							}] : [],
							previewFileIconSettings: {
								'pdf': '<i class="fa fa-file-pdf text-danger"></i>',
								'jpg': '<i class="fa fa-file-image text-warning"></i>',
								'png': '<i class="fa fa-file-image text-primary"></i>'
							},
							previewTemplates: {
								pdf: '<div class="kv-preview-data file-preview-other-frame">' +
										'<iframe src="{data}" class="kv-preview-data file-preview-pdf" style="width:100%; height:400px;"></iframe>' +
										'</div>'
							}
						});
					});
				},
				error: function () {
					console.error("❌ Failed to fetch file paths.");
				}
			});
		});

	</script>

	<script type="text/javascript">
		modal_loader = $(".loader_container").html();
		$(document).ready(function() {

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
						notify('Data save successfully', 'success');
					},
					error: function (res) {
						errored(form, res);
					}
				});
			});



			// Hide file remove button
			$(".kv-file-remove").hide();


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


		})



	</script>

@endsection