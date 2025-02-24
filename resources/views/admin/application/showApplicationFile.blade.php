@extends('admin.application.attachments.showApplicationFile', ['form_id'=> 'showApplicationFile_modal', 'slug'=>$data->slug])

@section('modal-header')

@endsection

@section('content')

@endsection

@section('modal-body')
     <div class="row">
          <div class="col-md-12">
               <iframe style="border: 0px !important;" width="100%" height="800" src="/show_file_custom/imported_commodities/{{$data->slug}}/application_form_path"></iframe>
          </div>
     </div>
@endsection

@section('modal-footer')

@endsection



@section('scripts')


@endsection