@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Profile</h1>
</section>

<section class="content">

  <div class="row">

    <div class="col-md-3">

      <div class="box box-default">
        <div class="box-body box-profile">

{{--          <form action="{{ route('dashboard.profile.upload') }}" method="POST" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <div class="text-center mb-3">--}}
{{--              <img id="preview" class="profile-user-img img-responsive img-circle" width="100" height="100"--}}
{{--                   src="{{ Auth::user()->user_profile_path ? url('show_file_custom_user/users/'. Auth::user()->slug. '/user_profile_path') : asset('images/avatar.jpeg') }}"--}}
{{--                   alt="User profile picture">--}}
{{--            </div>--}}

{{--            <div class="form-group text-center">--}}
{{--              <input type="file" name="profile_picture" accept="image/*" onchange="previewImage(event)" class="form-control-file mb-2">--}}
{{--              <button type="submit" class="btn btn-primary">Upload</button>--}}
{{--            </div>--}}

{{--          </form>--}}



          <style>
            .upload-box {
              border: 2px dashed #007bff;
              width: 200px;
              height: 200px;
              border-radius: 10px;
              overflow: hidden;
              position: relative;
              display: flex;
              justify-content: center;
              align-items: center;
              cursor: pointer;
              background-color: #fff;
              color: #007bff;
              font-family: sans-serif;
            }

            .upload-placeholder {
              z-index: 1;
              text-align: center;
            }

            .upload-icon {
              font-size: 2rem;
              line-height: 1;
            }

            .upload-box img {
              position: absolute;
              inset: 0; /* shorthand for top/right/bottom/left: 0 */
              width: 100%;
              height: 100%;
              object-fit: cover;
              object-position: center;
              border-radius: 10px;
            }

            .upload-box::after {
              content: "Click or Drag to Upload";
              position: absolute;
              inset: 0;
              background: rgba(0, 123, 255, 0.7); /* translucent blue */
              color: white;
              font-weight: bold;
              font-size: 14px;
              display: flex;
              justify-content: center;
              align-items: center;
              text-align: center;
              opacity: 0;
              transition: opacity 0.3s ease;
              border-radius: 10px;
              pointer-events: none;
              padding: 10px;
            }

            .upload-box:hover::after {
              opacity: 1;
            }

          </style>



          {{--          <img class="profile-user-img img-responsive img-circle" width="100" src="{{asset('images/avatar.jpeg')}}" alt="User profile picture">--}}

          {{--            <img class="profile-user-img img-responsive img-circle" width="100" src="{{ asset('images/avatar.jpeg') }}" alt="User profile picture">--}}
          {{--            <img id="preview" class="profile-user-img img-responsive img-circle" width="100" height="100"--}}
          {{--                 src="{{ Auth::user()->user_profile_path ? url('show_file_custom_user/users/'. Auth::user()->slug. '/user_profile_path') : asset('images/avatar.jpeg') }}"--}}
          {{--                 alt="User profile picture">--}}

          <div class="text-center" style="margin-left: 25%">
            <form action="{{ route('dashboard.profile.upload') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <label for="profile_picture" class="upload-box">
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" hidden onchange="previewImage(event)">
                <div id="uploadPreview" class="upload-placeholder">
                  @if(Auth::user()->user_profile_path)
                    <img src="{{ url('show_file_custom_user/users/' . Auth::user()->slug . '/user_profile_path') }}" alt="Current Profile Picture">
                  @else
                    <div class="upload-icon">+</div>
                    <div>Upload</div>
                  @endif
                </div>
              </label>
            </form>
          </div>


          <h3 class="profile-username text-center" style="margin-bottom: 0">
            {{ Auth::user()->first_name }}
            {{ Auth::user()->middle_name ? strtoupper(substr(Auth::user()->middle_name, 0, 1)) . '.' : '' }}
            {{ Auth::user()->last_name }}
          </h3>
          <p class="text-muted text-center">{{ Auth::check() ? Auth::user()->position : '' }}</p>

        </div>
      </div>

    </div>


    <div class="col-md-9">

      <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User Details</h3>
        </div>

        <div class="box-body">

          <strong><i class="fa fa-user margin-r-5"></i> Firstname</strong>
          <p class="text-muted">{{ Auth::user()->first_name }}</p>

          <strong><i class="fa fa-user margin-r-5"></i> Middlename</strong>
          <p class="text-muted">{{ Auth::user()->middle_name }}</p>

          <strong><i class="fa fa-user margin-r-5"></i> Lastname</strong>
          <p class="text-muted">{{ Auth::user()->last_name }}</p>

          <strong><i class="fa fa-male margin-r-5"></i> Position</strong>
          <p class="text-muted">{{ Auth::user()->position }}</p>

          <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
          <p class="text-muted">{{ Auth::user()->email }}</p>

          <hr>

          {{-- Account Settings --}}

          <h4>Account Settings</h4>
          <hr>

          {!! __html::alert('warning', '<i class="icon fa fa-info"></i> Note!', 'You will be logout from the system after you save changes.') !!}   


          {{-- USERNAME SETTINGS --}}

          <div class="panel box box-default">
            <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#username_bar">
              <h4 class="box-title">
                <span>
                  Email
                </span>
              </h4>
            </div>
            <div id="username_bar" class="panel-collapse collapse {{ $errors->has('email') ? 'in' : '' }}">
              <div class="box-body">

                <form class="form-horizontal" method="POST" autocomplete="off" action="{{ route('dashboard.profile.update_account_username', Auth::user()->slug) }}">

                  @csrf

                  @method('PATCH')

                  <input name="_method" value="PATCH" type="hidden">

                  {!! __form::textbox_inline(
                      'email', 'text', 'Email', 'Email', old('email') ? old('email') : Auth::user()->email, $errors->has('email') || Session::has('PROFILE_USERNAME_EXIST'), $errors->first('email'), ''
                  ) !!}

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Save Changes</button>
                    </div>
                  </div>

                </form>

              </div>
            </div>
          </div>


          {{-- PASSWORD SETTINGS --}}

          <div class="panel box box-default">
            <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#password_bar">
              <h4 class="box-title">
                <span>
                  Password
                </span>
              </h4>
            </div>
            <div id="password_bar" class="panel-collapse collapse {{ Session::has('PROFILE_OLD_PASSWORD_FAIL') || $errors->has('password') ? 'in' : '' }}">
              <div class="box-body">

                @if(Session::has('PROFILE_OLD_PASSWORD_FAIL'))
                  {!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Alert!', Session::get('PROFILE_OLD_PASSWORD_FAIL')) !!}
                @endif

                <form class="form-horizontal" method="POST" autocomplete="off" action="{{ route('dashboard.profile.update_account_password', Auth::user()->slug) }}">

                  @csrf
                  @method('PATCH')

                  <input name="_method" value="PATCH" type="hidden">

                  {!! __form::password_inline(
                      'old_password', 'Old Password', 'Old Password', $errors->has('old_password') || Session::has('PROFILE_OLD_PASSWORD_FAIL'), $errors->first('old_password'), ''
                  ) !!}

                  {!! __form::password_inline(
                      'password', 'New Password', 'New Password', $errors->has('password'), $errors->first('password'), ''
                  ) !!}

                  {!! __form::password_inline(
                      'password_confirmation', 'Confirm New Password', 'Confirm New Password', '', '', ''
                  ) !!}

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Save Changes</button>
                    </div>
                  </div>
                
                </form>

              </div>
            </div>
          </div>


          {{-- COLOR SETTINGS --}}

{{--          <div class="panel box box-default">--}}
{{--            <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#color_scheme_bar">--}}
{{--              <h4 class="box-title">--}}
{{--                <span>--}}
{{--                  Color Scheme--}}
{{--                </span>--}}
{{--              </h4>--}}
{{--            </div>--}}
{{--            <div id="color_scheme_bar" class="panel-collapse collapse {{ $errors->has('color') ? 'in' : '' }}">--}}
{{--              <div class="box-body">--}}

{{--                <form id="profile_update_account_color" method="POST" autocomplete="off" action="{{ route('dashboard.profile.update_account_color', Auth::user()->slug) }}">--}}

{{--                  @csrf--}}

{{--                  <input name="_method" value="PATCH" type="hidden">--}}

{{--                  {!! __form::select_static(--}}
{{--                    '4', 'color', 'Color Scheme', old('color') ? old('color') : Auth::user()->color, __static::user_colors(), $errors->has('color'), $errors->first('color'), '', ''--}}
{{--                  ) !!}--}}

{{--                  <div class="form-group">--}}
{{--                    <div style="margin-top:24px;" class="col-sm-8">--}}
{{--                      <button type="submit" class="btn btn-default">Save Changes</button>--}}
{{--                    </div>--}}
{{--                  </div>--}}

{{--                </form>--}}

{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}


          {{-- Activity --}}
          <hr>
          <h4>Activity</h4>
          <hr>

          <strong><i class="fa fa-clock-o "></i> Last Login Time</strong>
          <p class="text-muted">{{ __dataType::date_parse(Auth::user()->last_activity, 'M d, Y h:i A') }}</p>
      
{{--          <strong><i class="fa  fa-desktop margin-r-5"></i> Last Login Machine</strong>--}}
{{--          <p class="text-muted">{{ Auth::user()->last_login_machine }}</p>--}}

          <strong><i class="fa  fa-asterisk margin-r-5"></i> Last Login Local IP</strong>
          <p class="text-muted">{{ Auth::user()->last_login_ip }}</p>

      </div>
      </div>

    </div>

  </div>

</section>

@endsection


@section('scripts')

  <script>
    function previewImage(event) {
      const fileInput = event.target;
      const previewBox = document.getElementById('uploadPreview');

      if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
          previewBox.innerHTML = `<img src="${e.target.result}" alt="New Profile Preview">`;

          // Auto-submit the form after preview loads
          setTimeout(() => {
            fileInput.closest('form').submit();
          }, 200); // slight delay to ensure preview renders first
        };

        reader.readAsDataURL(fileInput.files[0]);
      }
    }
  </script>


  {{--  <script>--}}
{{--    function previewImage(event) {--}}
{{--      const fileInput = event.target;--}}
{{--      const previewBox = document.getElementById('uploadPreview');--}}

{{--      if (fileInput.files && fileInput.files[0]) {--}}
{{--        const reader = new FileReader();--}}

{{--        reader.onload = function (e) {--}}
{{--          previewBox.innerHTML = `<img src="${e.target.result}" alt="New Profile Preview">`;--}}
{{--        };--}}

{{--        reader.readAsDataURL(fileInput.files[0]);--}}
{{--      }--}}
{{--    }--}}
{{--  </script>--}}

  <script>
    Dropzone.options.profileDropzone = {
      paramName: "profile_picture",
      maxFilesize: 2, // MB
      maxFiles: 1,
      acceptedFiles: 'image/*',
      dictDefaultMessage: "Drag & drop your profile picture here or click to upload.",
      init: function () {
        this.on("success", function (file, response) {
          // Optionally reload image preview
          location.reload();
        });
      }
    };
  </script>

{{--  <script>--}}
{{--    function previewImage(event) {--}}
{{--      const reader = new FileReader();--}}
{{--      reader.onload = function() {--}}
{{--        document.getElementById('preview').src = reader.result;--}}
{{--      };--}}
{{--      reader.readAsDataURL(event.target.files[0]);--}}
{{--    }--}}
{{--  </script>--}}

  <script type="text/javascript">
    
    {!! __js::show_password('old_password', 'show_old_password') !!}
    {!! __js::show_password('password', 'show_password') !!}
    {!! __js::show_password('password_confirmation', 'show_password_confirmation') !!}

    @if(Session::has('PROFILE_UPDATE_COLOR_SUCCESS'))
      {!! __js::toast(Session::get('PROFILE_UPDATE_COLOR_SUCCESS')) !!}
    @endif

  </script>
  
@endsection