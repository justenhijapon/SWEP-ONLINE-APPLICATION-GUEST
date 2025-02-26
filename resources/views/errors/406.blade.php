<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Swep | 404</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @include('layouts.css-plugins')
</head>

<body class="hold-transition">
  <div class="wrapper" style="background-color: #ecf0f5; padding-top:50px ">
    <div class="container">
      <section class="content">

        <div class="error-page">
          <h2 class="headline text-yellow"> 404</h2>
          <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! File not found.</h3>
            <p>
              The file you are looking for was moved, removed,
              renamed or might never existed.
            </p>
{{--            <a class="btn btn-sm btn-warning" href="{{ URL::previous() }}">Go Back!</a>--}}
          </div>
        </div>

      </section>
    </div>
  </div>
</body>
</html>
