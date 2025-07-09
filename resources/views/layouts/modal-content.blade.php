@isset($form_id)
	<form id= "{{$form_id}}"
		@if(isset($slug))
			data="{{$slug}}"
		@endif
	>
	@csrf
@endisset

<div class="modal-header">
	<h4 class="modal-title">
    <button type="button" style="text-align: right" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
      @yield('modal-header')
    </h4>
</div>

<div class="modal-body">
  	@yield('modal-body')
</div>


<div class="modal-footer">
	@yield('modal-footer')
</div>


@isset($form_id)
	</form>
@endisset
{{--@include('admin-layouts.js-plugins')--}}
@include('layouts.js-plugins')
@yield('scripts')