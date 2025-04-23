<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
  <div class="navbar-header">
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
{{--    <form role="search" class="navbar-form-custom" action="search_results.html">--}}
{{--      <div class="form-group">--}}
{{--        <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">--}}
{{--      </div>--}}
{{--    </form>--}}
  </div>
  <ul class="nav navbar-top-links">
    <li style="padding: 8px; text-align: center;">
      <span class="m-r-sm text-muted welcome-message"><h2 style="horiz-align: center; margin-top: 5px; margin-bottom: 0;"><strong style="margin: 0">Welcome to SRA Web Portal - Online Application</strong></h2></span>
    </li>
  </ul>
  <ul class="nav navbar-top-links navbar-right">
    <li>
      <a href="{{route('auth.logout')}}">
        <i class="fa fa-sign-out"></i> Log out
      </a>
    </li>
    <li>
      <a class="right-sidebar-toggle">
        <i class="fa fa-tasks"></i>
      </a>
    </li>
  </ul>
</nav>