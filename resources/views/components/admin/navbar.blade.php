<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img
                    src="{{ asset('vendor/adminlte3/img/user2-160x160.jpg') }}"
                    class="user-image img-circle elevation-2"
                    alt="User Imagess">
                    {{-- <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> --}}
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">

                        <img
                            src="{{ asset('vendor/adminlte3/img/user2-160x160.jpg') }}"
                            class="img-circle elevation-2"
                            alt="User Imagess"
                            style="display: block;
                            margin-left: auto;
                            margin-right: auto;">

                            <p>
                                {{ Auth::user()->username }}
                                <small>Bergabung pada @DateIndo(Auth::user()->created_at)</small>
                            </p>
                        </li>
                        <!-- Menu Body -- <li class="user-body"> <div class="row"> <div class="col-4
                        text-center"> <a href="#">Followers</a> </div> <div class="col-4 text-center">
                        <a href="#">Sales</a> </div> <div class="col-4 text-center"> <a
                        href="#">Friends</a> </div> </div> <!-- /.row -- </li>-->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                            <a
                                class="btn btn-default btn-flat float-right"
                                href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">

                                <form
                                    id="logout-form"
                                    action="{{ route('admin.logout') }}"
                                    method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                            {{-- <a href="#" class="btn btn-default btn-flat float-right">Sign out</a> --}}
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        data-widget="control-sidebar"
                        data-slide="true"
                        href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
