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
{{--			<form id="importedCommoditiesForm" method="POST" autocomplete="off" enctype="multipart/form-data">--}}

				<div class="col-md-12 ibox-content">
					<div class="row">
						<div class="col-md-9">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4>Application For Clearance for the Release of Other Sugar Commodity</h4>
								</div>
									<form id="importedCommoditiesForm" method="POST" autocomplete="off" enctype="multipart/form-data">
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

											{!! \App\Core\Helpers\__form2::textbox('company', [
												'label'=>'<span style="color: ' . (empty($data->company) ? 'red' : 'grey') . ';">Company (Consignee) Name:*</span>',
												'cols'=>'4',
												'id'=>'company',
												'placeholder' => '',
												'required'=>'required',
											], \Illuminate\Support\Str::title($data->company)) !!}

											{!! \App\Core\Helpers\__form2::textbox('tin', [
												'label'=>'<span style="color: ' . (empty($data->tin) ? 'red' : 'grey') . ';">TIN:*</span>',
												'cols'=>'4',
												'id'=>'tin',
												'placeholder' => '',
												'required'=>'required',
											], $data->tin) !!}

											{!! \App\Core\Helpers\__form2::textbox('address', [
												'label'=>'<span style="color: ' . (empty($data->address) ? 'red' : 'grey') . ';">Business Address:*</span>',
												'cols'=>'4',
												'id'=>'address',
												'placeholder' => '',
												'required'=>'required',
											], \Illuminate\Support\Str::title($data->address)) !!}

											{!! \App\Core\Helpers\__form2::textbox('commodity', [
												'label'=>'<span style="color: ' . (empty($data->commodity) ? 'red' : 'grey') . ';">Commodity:*</span>',
												'cols'=>'4',
												'id'=>'commodity',
												'placeholder' => '',
												'required'=>'required',
											],$data->commodity) !!}

											{!! \App\Core\Helpers\__form2::textbox('h_s_code', [
												'label'=>'<span style="color: ' . (empty($data->h_s_code) ? 'red' : 'grey') . ';">H.S. Code:*</span>',
												'cols'=>'4',
												'id'=>'h_s_code',
												'placeholder' => '',
												'required'=>'required',
											],$data->h_s_code) !!}

											{!! \App\Core\Helpers\__form2::textbox('volume', [
												'label'=>'<span style="color: ' . (empty($data->volume) ? 'red' : 'grey') . ';">Volume (Net Weight in Kilograms):*</span>',
												'cols'=>'4',
												'id'=>'volume',
												'placeholder' => '',
												'required'=>'required',
											],$data->volume) !!}

											{!! \App\Core\Helpers\__form2::textbox('quantity_mt', [
												'label'=>'<span style="color: ' . (empty($data->quantity_mt) ? 'red' : 'grey') . ';">Quantity:*</span>',
												'cols'=>'4',
												'id'=>'quantity_mt',
												'placeholder' => '',
												'required'=>'required',
											],$data->quantity_mt) !!}

											{!! \App\Core\Helpers\__form2::textbox('packaging', [
												'label'=>'<span style="color: ' . (empty($data->packaging) ? 'red' : 'grey') . ';">Packaging (Ex: Can, Drum, Bag, Carton, Etc.):*</span>',
												'cols'=>'4',
												'id'=>'packaging',
												'placeholder' => '',
												'required'=>'required',
											],$data->packaging) !!}

											{!! \App\Core\Helpers\__form2::textbox('bill_landing_no', [
												'label'=>'<span style="color: ' . (empty($data->bill_landing_no) ? 'red' : 'grey') . ';">Bill of Lading No.:*</span>',
												'cols'=>'4',
												'id'=>'bill_landing_no',
												'placeholder' => '',
												'required'=>'required',
											], $data->bill_landing_no) !!}

											{!! \App\Core\Helpers\__form2::textbox('vessel_name', [
												'label'=>'<span style="color: ' . (empty($data->vessel_name) ? 'red' : 'grey') . ';">Vessel Name:*</span>',
												'cols'=>'4',
												'id'=>'vessel_name',
												'placeholder' => '',
												'required'=>'required',
											],$data->vessel_name) !!}

											{!! \App\Core\Helpers\__form2::textbox('country_origin', [
												'label'=>'<span style="color: ' . (empty($data->country_origin) ? 'red' : 'grey') . ';">Country of Origin:*</span>',
												'cols'=>'4',
												'id'=>'country_origin',
												'placeholder' => '',
												'required'=>'required',
											], $data->country_origin) !!}

											{!! \App\Core\Helpers\__form2::textbox('port_entry', [
												'label'=>'<span style="color: ' . (empty($data->port_entry) ? 'red' : 'grey') . ';">Port of Entry:*</span>',
												'cols'=>'4',
												'id'=>'port_entry',
												'placeholder' => '',
												'required'=>'required',
											],$data->port_entry) !!}

											{!! \App\Core\Helpers\__form2::textbox('name', [
												'label'=>'<span style="color: ' . (empty($data->name) ? 'red' : 'grey') . ';">Company Representative:*</span>',
												'cols'=>'4',
												'id'=>'name',
												'placeholder' => '',
												'required'=>'required',
											],\Illuminate\Support\Str::title($data->name)) !!}

											{!! \App\Core\Helpers\__form2::textbox('designation', [
												'label'=>'<span style="color: ' . (empty($data->designation) ? 'red' : 'grey') . ';">Designation:*</span>',
												'cols'=>'4',
												'id'=>'designation',
												'placeholder' => '',
												'required'=>'required',
											], $data->designation) !!}

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
//												'label'=>'Email:*',
												'cols'=>'4',
												'type'=>'email',
												'id'=>'email',
												'placeholder' => '',
												'required'=>'required',
											], $data->email) !!}


											<div class="col-md-12">
												@php
													$attachmentFields = [
														'bill_landing_path' => 'Bill of Lading',
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
																	'bill_landing_path' => 'Bill of Lading*',
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

																<div class="col-md-4">
																	<div class="form-group">
																		<label style="color: {{ $fileExists ? 'dark-grey' : 'red' }};">
																			{{ $label }}
																		</label>
																		<div class="input-group input-group-sm">
																			<input type="file" class="form-control" name="{{$columnName}}" id="img_url_{{$label}}">
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
													<button type="button" class="btn btn-success btn-lg btn-outline view_btn" id="printSaveBtn" data="{{$data->slug}}" data-toggle="modal" data-target="#view_modal" style="margin-right: 20px;"><i class="fa fa-print"></i> Print Application Form</button>
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
									</form>
							</div>
						</div>

						<div class="col-md-3">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 align="center">STATUS OF APPLICATION</h3>
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
{{--			</form>--}}

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

			// Handle Submit Button Click
			$("#applicationForm").on("submit", function (event) {
				let submitButton = $("#btnSubmitApplication");
				submitButton.prop("disabled", true); // Prevent multiple submissions
				submitButton.css("cursor", "not-allowed");
			});

			// Handle Unprocessable Content (422 Error)
			$(document).ajaxError(function (event, jqxhr, settings, thrownError) {
				if (jqxhr.status === 422) {
					$("#btnSubmitApplication").prop("disabled", true);
					$("#btnSubmitApplication").css("cursor", "not-allowed");
				}
			});

			// Handle "Save as Draft" button click
			$("#btnSaveDraft").on("click", function () {
				$("#btnSubmitApplication").prop("disabled", false); // Keep submit button enabled
			});

			// Initialize Bootstrap tooltip (if Bootstrap is used)
			$("#btnSubmitApplication").tooltip();
		});


	</script>

	<script type="text/javascript">
		modal_loader = $(".loader_container").html();
		$(document).ready(function() {


			@if(\Illuminate\Support\Facades\Request::has('success_message'))
			notify('{{\Illuminate\Support\Facades\Request::get('success_message')}}', 'success');
			window.history.pushState({}, document.title, '/dashboard/home');
			@endif

			$("#btnSaveDraft").click(function (e) {
				e.preventDefault();
				submitForm(false, true); // Save as draft and reload
			});

			$("#printSaveBtn").click(function (e) {
				e.preventDefault();
				submitForm(false, false, function () {
					// Callback: Show Print Preview Modal after saving successfully
					$("#printPreviewModal").modal("show");
				}, true); // Flag to prevent reload on error
			});

			$("#btnSubmitApplication").click(function (e) {
				e.preventDefault();

				Swal.fire({
					title: "Warning",
					text: "Before you proceed, please note that once you submit your application, you will no longer be able to edit it. The 'Save as Draft' and 'Submit Application' buttons will be disabled. Do you want to continue?",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: "Submit",
					cancelButtonText: "Cancel",
					confirmButtonColor: "#d33",
					cancelButtonColor: "#6c757d",
				}).then((result) => {
					if (result.isConfirmed) {
						$("#btnSubmitApplication, #btnSaveDraft").prop("disabled", true);
						submitForm(true, true);
					}
				});
			});

			function submitForm(isFinalSubmission, shouldReload, callback = null) {
				var form = $("#importedCommoditiesForm")[0];
				var formData = new FormData(form);
				var slug = "{{$data->slug}}";
				var uri = "{{ route('dashboard.ImportedCommodities.update', 'slug') }}".replace('slug', slug);

				formData.append('_method', 'PATCH');

				if (isFinalSubmission) {
					formData.append("submission", "1");
					formData.append("revoked", "0");

					var now = new Date();
					var localDatetime = now.getFullYear() + "-" +
							String(now.getMonth() + 1).padStart(2, '0') + "-" +
							String(now.getDate()).padStart(2, '0') + " " +
							String(now.getHours()).padStart(2, '0') + ":" +
							String(now.getMinutes()).padStart(2, '0') + ":" +
							String(now.getSeconds()).padStart(2, '0');

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
								title: "Acknowledged",
								text: "Rest assured that we will process your application immediately.",
								type: "success",
								button: "OK"
							}, function() {
								window.location.href = "/dashboard/home";
							});
						} else if (shouldReload) {
							window.location.href = "/dashboard/home?success_message=Data successfully saved!";
						} else {
							// notify("Data successfully saved!", "success");
							if (callback) callback(); // Execute callback (e.g., show print modal)
						}
					},
					error: function (res) {
						console.log(res);
						errored($("#importedCommoditiesForm"), res);

						$("#btnSubmitApplication, #btnSaveDraft").prop("disabled", false);

						// if (res.status === 422) {
						// 	location.reload();
						// }
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

				// Display the loader inside the modal before fetching content
				$(target_modal + " .modal-content").html(`
					<div id="loading" class="loader" style="padding-top: 10%; padding-bottom: 10%; padding-left: 40%;">
						<img src="{{ asset('images/load_anim.gif') }}">
					</div>`);

				// Show the modal first before making the AJAX request
				$(target_modal).modal('show');

				setTimeout(function () {
					$.ajax({
						url: uri,
						type: 'GET',
						success: function (res) {
							$(target_modal).find('.modal-content').html(res);
						},
						error: function (res) {
							console.log(res);
						}
					});
				}, 500); // Delay AJAX request by 500ms
			});

			{{--$("body").on("click", ".view_btn", function () {--}}
			{{--	target_modal = $(this).attr('data-target');--}}

			{{--	tr_id = $(this).attr('data');--}}
			{{--	uri = "{{route('dashboard.ImportedCommodities.show', 'slug')}}";--}}
			{{--	uri = uri.replace('slug', tr_id);--}}
			{{--	$(target_modal + " .modal-content").html('<div class="loader-demo-box">\n' +--}}
			{{--			'                    <div class="square-box-loader">\n' +--}}
			{{--			'                        <div class="square-box-loader-container">\n' +--}}
			{{--			'                            <div class="square-box-loader-corner-top"></div>\n' +--}}
			{{--			'                            <div class="square-box-loader-corner-bottom"></div>\n' +--}}
			{{--			'                        </div>\n' +--}}
			{{--			'                        <div class="square-box-loader-square"></div>\n' +--}}
			{{--			'                    </div>\n' +--}}
			{{--			'                </div>');--}}
			{{--	$.ajax({--}}
			{{--		url: uri,--}}
			{{--		type: 'GET',--}}
			{{--		success: function (res) {--}}
			{{--			$(target_modal).find('.modal-content').html(res);--}}
			{{--		},--}}
			{{--		error: function (res) {--}}
			{{--			console.log(res);--}}
			{{--		}--}}
			{{--	})--}}
			{{--})--}}

			$("body").on('click', '.download_OP_btn', function () {
				let slug = $(this).attr('data-slug'); // Get slug from the button attribute
				let downloadRoute = "{{ route('downloadOrderOfPayment', ':slug') }}".replace(':slug', slug);
				window.location.href = downloadRoute; // Trigger the file download
			});


			$("body").on('click', '.print_btn', function () {
				tr_id = $(this).attr('data');
				var printRoute = "{{route('printTransactionIc')}}";
				var newPrintRoute = printRoute + "?transactionId=" + tr_id;
				$("#printIframe").attr('src', newPrintRoute);
				setTimeout(printIframe, 500);
			})

			{{--$("body").on('click', '.print_OP_btn', function () {--}}
			{{--	let slug = $(this).attr('data-slug'); // Ensure button has 'data-slug' attribute--}}
			{{--	let printRoute = "{{ route('printOrderOfPayment', ':slug') }}".replace(':slug', slug);--}}
			{{--	$("#printIframe").attr('src', printRoute);--}}
			{{--	setTimeout(printIframe, 500);--}}
			{{--});--}}

			function printIframe() {
				$("#printIframe").get(0).contentWindow.print();
			}





		})



	</script>

@endsection