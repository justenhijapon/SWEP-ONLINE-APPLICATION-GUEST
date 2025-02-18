@extends('layouts.modal-content',['form_id'=> 'edit_form', 'slug'=>$data->slug])

@section('modal-header')
	{{$data->slug}} | <span class="label label-primary">Attachement</span>
@endsection

@section('modal-body')
	<div class="row">
		{!! \App\Core\Helpers\__form2::textbox('name', [
           'label'=>'Name:*',
           'cols'=>'4',
           'rows'=>'2',
           'id'=>'name',
           'placeholder' => '',
           'required'=>'required',
        ], $data->slug) !!}

		{!! \App\Core\Helpers\__form2::file('packing_list_path', [
             'label' => 'Packing List',
             'id'=>'img_url_packing_list_path',
             'cols' => '4',
             'rows'=>'8',
        ]) !!}
	</div>
@endsection

@section('modal-footer')
	<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection

@section('script')
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

			var existingImgUrl = "/show_file_custom/imported_commodities/{{$data->slug}}/packing_list_path";

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
			initializeFileInput("img_url_packing_list_path", existingImgUrl);
		});
	</script>

@endsection
