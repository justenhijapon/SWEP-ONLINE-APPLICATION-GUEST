@extends('layouts.admin-master')
@section('content')
	<div class="row wrapper border-bottom white-bg page-heading" style="padding-bottom: 5px">
		<div class="col-lg-10">
			<h2 style="">Imported Commodities</h2>
{{--			<div class="pull-right no-padding">--}}
{{--				<code class="no-padding">Fields with asterisks(*) are required</code>--}}
{{--			</div>--}}
		</div>
	</div>

	<section class="content">
		<div class="ibox">
{{--			<div class="box-header with-border ibox-content" style="padding: 5px">--}}
{{--				<div class="col-md-12">--}}
{{--					<div class="row">--}}
{{--						<div class="col-md-8">--}}
{{--							<div class="pull-right">--}}
{{--								<code>Fields with asterisks(*) are required</code>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
			@csrf
			<form id="importedCommoditiesForm" method="POST" autocomplete="off" enctype="multipart/form-data">

				<div class="col-md-12 ibox-content">
					<div class="row">

						<div class="col-md-9">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4>Application For Clearance for the Release of Imported Commodities under Tariff Heading 1702 (Other Sugars) and 1704 (Sugar Confectionery)</h4>
								</div>
								<div class="panel-body">
									<div class="row">

										{!! \App\Core\Helpers\__form2::textbox('date', [
												'label'=>'<span style="color: ' . (empty($data->date) ? 'red' : 'grey') . ';">Application Date:*</span>',
												'type'=>'date',
												'cols'=>'4',
												'id'=>'date',
												'placeholder' => '',
												'required'=>'required',
											], $data->date) !!}

										<div class="col-md-4" style="margin-top: 30px">
											<div class=" no-padding">
												<p>Application Reference No.:<span><code style="font-size: medium" class="no-padding"> {{$data->slug}}</code></span></p>
											</div>
											{!! $revokedDates ?? '' !!}
										</div>

										<div class="col-md-4" style="padding-bottom: 10px">
											<div class="pull-right no-padding">
												<code class="no-padding">Fields with asterisks(*) are mandatory</code>
											</div>
										</div>

										{!! \App\Core\Helpers\__form2::textbox('name', [
										'label'=>'<span style="color: ' . (empty($data->name) ? 'red' : 'grey') . ';">Name:*</span>',
										'cols'=>'4',
										'id'=>'name',
										'placeholder' => '',
										'required'=>'required',
										],$data->name) !!}

										{!! \App\Core\Helpers\__form2::textbox('designation', [
											'label'=>'<span style="color: ' . (empty($data->designation) ? 'red' : 'grey') . ';">Applicant Designation:*</span>',
											'cols'=>'4',
											'id'=>'designation',
											'placeholder' => '',
											'required'=>'required',
										], $data->designation) !!}

										{!! \App\Core\Helpers\__form2::textbox('company', [
												'label'=>'<span style="color: ' . (empty($data->company) ? 'red' : 'grey') . ';">Company Name:*</span>',
												'cols'=>'4',
												'id'=>'company',
												'placeholder' => '',
												'required'=>'required',
											], $data->company) !!}

										{!! \App\Core\Helpers\__form2::textbox('tin', [
												'label'=>'<span style="color: ' . (empty($data->tin) ? 'red' : 'grey') . ';">Consignee TIN No.:*</span>',
												'cols'=>'4',
												'id'=>'tin',
												'placeholder' => '',
												'required'=>'required',
											], $data->tin) !!}

										{!! \App\Core\Helpers\__form2::textbox('contact_no', [
												'label'=>'<span style="color: ' . (empty($data->contact_no) ? 'red' : 'grey') . ';">Contact No.:*</span>',
												'cols'=>'4',
                                                'class'=>'form-control-message',
												'id'=>'contact_no',
												'placeholder' => '',
												'required'=>'required',
											], $data->contact_no) !!}

										{!! \App\Core\Helpers\__form2::textbox('email', [
												'label'=>'<span style="color: ' . (empty($data->email) ? 'red' : 'grey') . ';">Email:*</span>',
												'cols'=>'4',
												'type'=>'email',
												'id'=>'email',
												'placeholder' => '',
												'required'=>'required',
											], $data->email) !!}

										{!! \App\Core\Helpers\__form2::textbox('address', [
												'label'=>'<span style="color: ' . (empty($data->address) ? 'red' : 'grey') . ';">Address:*</span>',
												'cols'=>'4',
												'id'=>'adress',
												'placeholder' => '',
												'required'=>'required',
											], $data->address) !!}

										{!! \App\Core\Helpers\__form2::textbox('quantity_mt', [
												'label'=>'<span style="color: ' . (empty($data->quantity_mt) ? 'red' : 'grey') . ';">Quantity in Mt:*</span>',
												'cols'=>'4',
												'id'=>'quantity_mt',
												'placeholder' => '',
												'required'=>'required',
											], $data->quantity_mt) !!}

										{!! \App\Core\Helpers\__form2::textbox('bill_landing_no', [
												'label'=>'<span style="color: ' . (empty($data->bill_landing_no) ? 'red' : 'grey') . ';">Bill of Landing No.:*</span>',
												'cols'=>'4',
												'id'=>'bill_landing_no',
												'placeholder' => '',
												'required'=>'required',
											], $data->bill_landing_no) !!}

										{!! \App\Core\Helpers\__form2::textbox('country_origin', [
												'label'=>'<span style="color: ' . (empty($data->country_origin) ? 'red' : 'grey') . ';">Country of Origin:*</span>',
												'cols'=>'4',
												'id'=>'country_origin',
												'placeholder' => '',
												'required'=>'required',
											], $data->country_origin) !!}

										{!! \App\Core\Helpers\__form2::textbox('prod_description', [
												'label'=>'<span style="color: ' . (empty($data->prod_description) ? 'red' : 'grey') . ';">Product Description:*</span>',
												'cols'=>'8',
												'id'=>'prod_description',
												'placeholder' => '',
												'required'=>'required',
											], $data->prod_description) !!}

										{!! \App\Core\Helpers\__form2::textbox('port_discharge', [
												'label'=>'<span style="color: ' . (empty($data->port_discharge) ? 'red' : 'grey') . ';">Port of Discharge:*</span>',
												'cols'=>'4',
												'id'=>'port_discharge',
												'placeholder' => '',
												'required'=>'required',
											], $data->port_discharge) !!}

										{!! \App\Core\Helpers\__form2::textbox('purpose_importation', [
												'label'=>'<span style="color: ' . (empty($data->purpose_importation) ? 'red' : 'grey') . ';">Purpose of Importation:*</span>',
												'cols'=>'8',
												'id'=>'purpose_importation',
												'placeholder' => '',
												'required'=>'required',
											], $data->purpose_importation) !!}



{{--										<div class="col-sm-8" style="padding-bottom: 10px; margin-top: 20px">--}}

{{--											<span class="pull-right" style="padding-right: 20px">--}}
{{--												<button type="button" class="btn btn-success btn-lg btn-outline view_btn" data="{{$data->slug}}" data-toggle="modal" data-target="#view_modal"><i class="fa fa-print"></i> Print Application Form</button>--}}
{{--											</span>--}}
{{--										</div>--}}


										<div class="col-md-12">
											@php
												$attachmentFields = [
															'bill_landing_path' => 'Bill of Landing',
															'commercial_invoice_path' => 'Commercial Invoice',
															'packing_list_path' => 'Packing List',
															'cert_origin_path' => 'Certificate of Origin',
															'cert_analysis_path' => 'Certificate of Analysis',
															'notarized_gmo_non_gmo_path' => 'Notarized GMO/Non-GMO',
															'important_declaration_path' => 'Important Declaration',
															'application_form_path' => 'Application Form',
															'affidavit_path' => 'Affidavit'
																		 ];

                                                                     $attachmentsCount = 0;
                                                                foreach ($attachmentFields as $field => $label) {
                                                                    if (!empty($data->$field) && $data->$field !== null) {
                                                                        $attachmentsCount++;
                                                                    }
                                                                }

											@endphp


											<div class="panel panel-primary">
												<div class="panel-heading">
													<h4>REQUIRED ATTACHED DOCUMENTS &nbsp;&nbsp;<span><code>{{$attachmentsCount}}/9</code></span></h4>
												</div>
												<div class="panel-body">
													<div class="row">

														@php

															$files = [
                                                                'application_form_path' => 'Application Form (Notarized)*',
                                                                'affidavit_path' => 'Affidavit*',
                                                                'bill_landing_path' => 'Bill of Landing*',
                                                                'commercial_invoice_path' => 'Commercial Invoice*',
                                                                'packing_list_path' => 'Packing List*',
                                                                'cert_origin_path' => 'Certificate of Origin*',
                                                                'cert_analysis_path' => 'Certificate of Analysis*',
                                                                'notarized_gmo_non_gmo_path' => 'Notarized Declaration of GMO and Non-GMO*',
                                                                'important_declaration_path' => 'Import Declaration (once available)',
                                                            ];

														 	$requiredFiles = array_keys(array_filter($files, function ($key) {
																return $key !== 'important_declaration_path'; // Exclude important_declaration_path
															}, ARRAY_FILTER_USE_KEY));
														@endphp

														@foreach ($files as $columnName => $label)
															@php
																$fileExists = !empty($data->$columnName); // Check if the column has a value
                                                                $fileUrl = route('show_file_custom', [
                                                                    'tableName' => 'imported_commodities',
                                                                    'slug' => $data->slug,
                                                                    'columnName' => $columnName
                                                                ]);

                                                                $fileName = $fileExists ? basename($data->$columnName) : ''; // Extract file name
															@endphp

{{--																								{!! \App\Core\Helpers\__form2::file($columnName, [--}}
{{--															                                        'label' => $label,--}}
{{--															                                        'cols' => '4',--}}
{{--															                                        'id' => 'img_url_' . $columnName, // Ensure a unique ID--}}
{{--															                                        'class' => 'file-input',--}}
{{--															                                        'data-file-url' => $fileUrl--}}
{{--															                                    ]) !!}--}}

															<div class="col-md-4">
																<div class="form-group">
																	<label style="color: {{ $fileExists ? 'dark-grey' : 'red' }};">
																		{{ $label }}
																	</label>
																	<div class="input-group input-group-sm">
																		<input type="file" class="form-control" name="{{$columnName}}" id="img_url_{{$columnName}}">
																		@if($fileExists)
																			<input type="text" style="width: 20%" class="form-control" name="{{$columnName}}" id="img_url_{{$columnName}}" value="{{ $fileExists ? $fileName : '' }}" readonly>
																			<button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#filePreviewModal" data-file-url="{{$fileUrl}}">
																				File preview
																			</button>
																		@endif
																	</div>
																</div>
															</div>
													@endforeach
													</div>
												</div>
											</div>
										</div>
										<style>
											#btnSubmitApplication {
												cursor: pointer !important;
												opacity: 1 !important;
											}

											#btnSubmitApplication:disabled {
												cursor: not-allowed !important;
												opacity: 0.5 !important;
											}
										</style>

										<div class="col-md-12" align="right">
											<div class="box-footer">
												<button type="button" class="btn btn-success btn-lg btn-outline view_btn" data="{{$data->slug}}" data-toggle="modal" data-target="#view_modal" style="margin-right: 20px;"><i class="fa fa-print"></i> Print Application Form</button>
												<a href="{{asset('/files/applications/Affidavit_of_GMO.pdf')}}" class="btn btn-info btn-lg btn-outline" target="_blank"  style="margin-right: 20px;"><i class="fa fa-print"></i> Print Affidavit Form</a>
												<span style="margin-right: 20px">
													<button type="submit" id="btnSaveDraft" class="btn btn-lg btn-outline btn-primary"
															@if($data->submission == 1) disabled style="cursor: not-allowed;" @endif>
													Save as Draft
												</button>
												</span>
												<span class="pull-right" style="padding-right: 20px">
													<button id="btnSubmitApplication" type="submit" class="btn btn-lg btn-outline btn-danger" style="margin-right: 20px;"
															@if($data->submission == 1) disabled @endif>
														Submit Application <i class="fa fa-arrow-circle-right"></i>
													</button>
												</span>

											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
{{--						<div class="col-md-4">--}}
{{--							<div class="row">--}}
{{--								<div class="col-md-12">--}}
{{--									<h4 style="color: darkslategray">REQUIRED ATTACHED DOCUMENTS</h4>--}}
{{--									<ul>--}}
{{--										<li><p class="text-bold">Application Form (Notarized)</p></li>--}}
{{--										<li><p class="text-bold">Affidavit</p></li>--}}
{{--										<li><p class="text-bold">Bill of Landing</p></li>--}}
{{--										<li><p class="text-bold">Commercial Invoice</p></li>--}}
{{--										<li><p class="text-bold">Packing List</p></li>--}}
{{--										<li><p class="text-bold">Certificate of Origin</p></li>--}}
{{--										<li><p class="text-bold">Certificate of Analysis</p></li>--}}
{{--										<li><p class="text-bold">Notarized Declaration of GMO and Non-GMO</p></li>--}}
{{--										<li><p class="text-bold">Import Declaration (once available)</p></li>--}}
{{--									</ul>--}}
{{--								</div><br>--}}
{{--							</div>--}}
{{--						</div>--}}

						<div class="col-md-3">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4 align="center">APPLICATION STATUS</h4>
								</div>
								<div class="panel-body" style="padding-top: 2px">
									<div class="row">
										@include('dashboard.ImportedCommodities.timeline')
									</div>
								</div>
							</div>
						</div>


					</div>
				</div>
			</form>
		</div>

	</section>



	<iframe hidden id="printIframe" src=""></iframe>

	{!! __html::modal_loader() !!}
@endsection

@section('modals')
	<!-- File Preview Modal -->
	<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-labelledby="filePreviewLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="height: 800px">
				<div class="modal-header">
					<h5 class="modal-title" id="filePreviewLabel">File Preview</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<iframe id="filePreviewIframe" src="" width="100%" height="700" frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="view_modal">
		<div class="modal-dialog" role="document" style="max-width:45% !important;">
			<div class="modal-content">

			</div>
		</div>
	</div>
@endsection


@section('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', function () {

			$('#filePreviewModal').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget); // Button that triggered the modal
				var fileUrl = button.data('file-url'); // Extract file URL from data attribute
				$('#filePreviewIframe').attr('src', fileUrl);
			});

			$('#filePreviewModal').on('hidden.bs.modal', function () {
				$('#filePreviewIframe').attr('src', ''); // Reset iframe when modal is closed
			});
		});
	</script>

	<script>

		$(document).ready(function () {
			function toggleSubmitButton() {
				let requiredFiles = @json($requiredFiles);
				let submission = @json($data->submission ?? 0); // Ensure safe fallback

				let allFilesUploaded = requiredFiles.every(function (name) {
					let fileInput = $("input[name='" + name + "']");
					let existingFile = fileInput.siblings("input[type='text']").val(); // Check preloaded file

					return (fileInput.length > 0 && fileInput[0].files.length > 0) || existingFile;
				});

				let submitButton = $("#btnSubmitApplication");

				if (submission === 1) {
					submitButton.prop("disabled", true);
					submitButton.css("cursor", "not-allowed");
					submitButton.attr("title", "You have already submitted your application.");
				} else if (allFilesUploaded) {
					submitButton.prop("disabled", false);
					submitButton.css("cursor", "pointer");
					submitButton.removeAttr("title");
				} else {
					submitButton.prop("disabled", true);
					submitButton.css("cursor", "not-allowed");
					submitButton.attr("title", "To enable Submit, upload the required attachment(s).");
				}
			}

			// Run check on page load (to check preloaded files and submission status)
			toggleSubmitButton();

			// Run check when any file input changes
			$(".file-input").on("change", function () {
				toggleSubmitButton();
			});

			// Initialize Bootstrap tooltip (if Bootstrap is used)
			$("#btnSubmitApplication").tooltip();
		});


	</script>



{{--	<script>--}}
{{--		$(document).ready(function () {--}}
{{--			let fileInputs = $(".file-input");--}}

{{--			if (fileInputs.length === 0) {--}}
{{--				console.error("❌ No file input elements found! Check your Blade template.");--}}
{{--				return;--}}
{{--			}--}}

{{--			$(".file-input").each(function () {--}}
{{--				var $this = $(this);--}}
{{--				var existingFileUrl = $this.data("file-url");--}}

{{--				if (!existingFileUrl) {--}}
{{--					console.warn("⚠️ No file URL found for:", $this.attr("id"));--}}
{{--					return;--}}
{{--				}--}}

{{--				console.log("✅ Initializing file input for:", $this.attr("id"), "with URL:", existingFileUrl);--}}

{{--				var fileType = existingFileUrl.match(/\.pdf$/i) ? "pdf" : "image";--}}

{{--				$this.fileinput({--}}
{{--					theme: "fa",--}}
{{--					allowedFileExtensions: ["pdf", "jpeg", "jpg", "png"],--}}
{{--					maxFileCount: 1,--}}
{{--					showUpload: false,--}}
{{--					showCaption: false,--}}
{{--					overwriteInitial: true,--}}
{{--					initialPreview: existingFileUrl ? [existingFileUrl] : [],--}}
{{--					initialPreviewAsData: true,--}}
{{--					initialPreviewFileType: fileType,--}}
{{--					browseClass: "btn btn-primary btn-md",--}}
{{--					initialPreviewConfig: fileType === "pdf" ? [{ type: "pdf", caption: "PDF Preview", key: 1 }] : [],--}}
{{--				});--}}
{{--			});--}}


{{--			// Fetch file paths via AJAX and update the inputs--}}
{{--			$.ajax({--}}
{{--				url: "/api/get-file-paths/{{$data->slug}}",--}}
{{--				type: "GET",--}}
{{--				success: function (data) {--}}
{{--					console.log("✅ Received File Paths:", data); // Debugging--}}
{{--					Object.keys(data).forEach(function (key) {--}}
{{--						let fileInputId = "img_url_" + key;--}}
{{--						let fileUrl = data[key];--}}

{{--						if (!$("#" + fileInputId).length) {--}}
{{--							console.error("❌ File input not found for:", fileInputId);--}}
{{--							return;--}}
{{--						}--}}

{{--						console.log("📂 Updating file input:", fileInputId, "with URL:", fileUrl);--}}

{{--						$("#" + fileInputId).fileinput('destroy').fileinput({--}}
{{--							theme: "fa",--}}
{{--							allowedFileExtensions: ["pdf", "jpeg", "jpg", "png", "txt"],--}}
{{--							maxFileCount: 1,--}}
{{--							showUpload: false,--}}
{{--							showCaption: false,--}}
{{--							overwriteInitial: true,--}}
{{--							initialPreview: fileUrl ? [fileUrl] : [],--}}
{{--							initialPreviewAsData: true,--}}
{{--							initialPreviewFileType: fileUrl.endsWith(".pdf") ? "pdf" : "image",--}}
{{--							browseClass: "btn btn-primary btn-md",--}}
{{--							initialPreviewConfig: fileUrl.endsWith(".pdf") ? [{--}}
{{--								type: "pdf",--}}
{{--								caption: "PDF Preview",--}}
{{--								downloadUrl: fileUrl,--}}
{{--								key: 1--}}
{{--							}] : [],--}}
{{--							previewFileIconSettings: {--}}
{{--								'pdf': '<i class="fa fa-file-pdf text-danger"></i>',--}}
{{--								'jpg': '<i class="fa fa-file-image text-warning"></i>',--}}
{{--								'png': '<i class="fa fa-file-image text-primary"></i>'--}}
{{--							},--}}
{{--							previewTemplates: {--}}
{{--								pdf: '<div class="kv-preview-data file-preview-other-frame">' +--}}
{{--										'<iframe src="{data}" class="kv-preview-data file-preview-pdf" style="width:100%; height:400px;"></iframe>' +--}}
{{--										'</div>'--}}
{{--							}--}}
{{--						});--}}
{{--					});--}}
{{--				},--}}
{{--				error: function () {--}}
{{--					console.error("❌ Failed to fetch file paths.");--}}
{{--				}--}}
{{--			});--}}
{{--		});--}}

{{--	</script>--}}

	<script type="text/javascript">
		modal_loader = $(".loader_container").html();
		$(document).ready(function() {


			@if(\Illuminate\Support\Facades\Request::has('success_message'))
			notify('{{\Illuminate\Support\Facades\Request::get('success_message')}}', 'success');
			window.history.pushState({}, document.title, '/dashboard/home');
			@endif

			$("#btnSaveDraft").click(function (e) {
				e.preventDefault();
				submitForm(false); // Pass false to indicate it's a draft
			});

			$("#btnSubmitApplication").click(function (e) {
				e.preventDefault();
				submitForm(true); // Pass true to update submission_status
			});

			function submitForm(isFinalSubmission) {
				var form = $("#importedCommoditiesForm")[0];
				var formData = new FormData(form);
				var slug = "{{$data->slug}}";
				var uri = "{{ route('dashboard.ImportedCommodities.update', 'slug') }}".replace('slug', slug);

				formData.append('_method', 'PATCH');

				// Only update submission_status when clicking "Submit Application"
				if (isFinalSubmission) {
					formData.append("submission", "1");
					formData.append("revoked", "0"); // Ensure revoked is set to 0

					// Get the correct local time in YYYY-MM-DD HH:MM:SS format
					var now = new Date();
					var year = now.getFullYear();
					var month = String(now.getMonth() + 1).padStart(2, '0');
					var day = String(now.getDate()).padStart(2, '0');
					var hours = String(now.getHours()).padStart(2, '0');
					var minutes = String(now.getMinutes()).padStart(2, '0');
					var seconds = String(now.getSeconds()).padStart(2, '0');

					var localDatetime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
					formData.append("submission_date", localDatetime);
				}

				$.ajax({
					url: uri,
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					headers: {
						"X-CSRF-TOKEN": "{{ csrf_token() }}"
					},
					success: function (res) {
						if (isFinalSubmission) {
							swal({
								title: "Application successfully submitted!",
								text: "Thank you for your submission! We will review your application, and you can expect a response within 3 working days.",
								type: "success",
								button: "OK"
							},function() {
								// Redirect immediately after clicking OK
								window.location.href = "/dashboard/home";
							});
						} else {
							window.location.href = "/dashboard/home?success_message=Data successfully saved!";
						}
					},
					error: function (res) {
						console.log(res);
						errored($("#importedCommoditiesForm"), res);
					}
				});
			}


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