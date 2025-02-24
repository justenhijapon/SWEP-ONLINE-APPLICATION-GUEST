@isset($form_id)
    <form style="border: 0px!important;" id= "{{$form_id}}"
          @if(isset($slug))
              data="{{$slug}}"
          @endif

          @if(isset($uri))
              uri="{{$uri}}"
            @endif
    >
        @csrf
        @endisset

        @php($style = '')
        @isset($decolor)
            @php($style = '')
        @endisset
        <div class="modal-body no-margin no-padding" style="background-color: {{$style}}; border: 0px !important; border-radius: 5px !important;">
            @yield('modal-body')
        </div>

        @isset($form_id)
    </form>
@endisset

@yield('scripts')