<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
{{--                    <img alt="image" style="margin-left: 25%;" class="rounded-circle" width="80" height="80" src="{{ Auth::user()->user_profile_path ? url('show_file_custom_user/users/'. Auth::user()->slug. '/user_profile_path') : asset('images/avatar.jpeg') }}"/><br>--}}
                   <div style="text-align: center">
                       <img alt="image" loading="lazy" style=" border: 1px solid rgb(47, 64, 80);
                                    border-radius: 4px;
                                    padding: 5px;
                                    width: 150px;
                                    height: 150px;
                                    margin-right: 5px;" class="image-clean" width="80" src="{{ Auth::user()->user_profile_path ? url('show_file_custom_user/users/'. Auth::user()->slug. '/user_profile_path') : asset('images/avatar.jpeg') }}"/>
                   </div>
                    <br>

{{--                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">--}}
                        <span class="text-muted m-t-sm font-bold" style="font-size: medium; margin-left: 15%" >{{Auth::guard('web')->user()->first_name}} {{Auth::guard('web')->user()->last_name}}</span>

                        <span class="text-muted text-xs block" style="word-break: normal; font-size: smaller">{{Auth::guard('web')->user()->business_name}}
{{--                            <b class="caret"></b>--}}
                        </span>
{{--                    </a>--}}
{{--                    <ul class="dropdown-menu animated fadeInRight m-t-xs">--}}
{{--                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>--}}
{{--                        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>--}}
{{--                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>--}}
{{--                        <li class="dropdown-divider"></li>--}}
{{--                        <li><a class="dropdown-item" href="login.html">Logout</a></li>--}}
{{--                    </ul>--}}
                </div>
                <div class="logo-element">
                    SRA
                </div>
            </li>
            <li>
                <a href="{{route('dashboard.home')}}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">Home</span>
                </a>
            </li>

{{--            <li>--}}
{{--                <a href="{{route('dashboard.home')}}">--}}
{{--                <a href="">--}}
{{--                    <i class="fa fa-user"></i>--}}
{{--                    <span class="nav-label">Profile</span>--}}
{{--                </a>--}}

{{--            </li>--}}
            @if(count($global_user_menus) > 0)
                @foreach($global_user_menus as $key => $label)
                    @foreach($label as $menu)
                        @if($menu['menu_obj']->is_dropdown == 1)
                            <li>
                                <a href="#{{$menu['menu_obj']->slug}}">
                                    <i class="{{$menu['menu_obj']->icon}}"></i>
                                    <span class="nav-label">{{$menu['menu_obj']->menu_name}}</span>
                                    <span class="fa arrow"></span>
                                </a>
                                @if(count($menu['functions']) > 0)
                                    <ul class="nav nav-second-level collapse">
                                        @foreach($menu['functions'] as $function)
                                            @if($function['function_obj']->function_is_nav == 1)
                                                <li>
                                                    <a href="{{route($function['function_obj']->function_route)}}">
                                                        {{$function['function_obj']->function_label}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @else
{{--                            <li class="active">--}}
{{--                                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span> <span class="fa arrow"></span></a>--}}
{{--                                <ul class="nav nav-second-level">--}}
{{--                                    <li class="active"><a href="{{route('dashboard.home')}}">Home</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
                        @endif
                    @endforeach
                @endforeach
            @endif
        </ul>
    </div>
</nav>