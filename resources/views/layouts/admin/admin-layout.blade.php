<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>Admin Dashboard</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib" />

    <link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico"
        type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
   
    <link rel="stylesheet" type="text/css" href=" {{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/waves.min.css') }}" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome-n.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/chartist.css') }}" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/admin-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/widget.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a href="{{ route('admin-home') }}">
                            <img class="img-fluid" src="{{ asset('assets/img/admin/logo.png') }}" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu icon-toggle-right"></i>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close">
                                            <i class="feather icon-x input-group-text"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn">
                                            <i class="feather icon-search input-group-text"></i>
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()"
                                    class="waves-effect waves-light" data-cf-modified-d2d1d6e2f87cbebdf4013b26-="">
                                    <i class="full-screen feather icon-maximize"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-bell"></i>
                                        <span class="badge bg-c-red">4</span>
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <h6>Notifications</h6>
                                            <label class="label label-danger">New</label>
                                        </li>
                                        {{--@foreach($notifications as $notification)
                                        <li>
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="notification-user">{{ $notification->title }}</h5>
                                                    <p class="notification-msg">{{ $notification->message }}</p>
                                                    <span class="notification-time">{{ $notification->timeAgo }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach--}}
                                    </ul>
                                </div>
                            </li>
                            <!--li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-message-square"></i>
                                        <span class="badge bg-c-green">3</span>
                                    </div>
                                </div>
                            </li-->
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                     
                                        @isset(Auth::user()->profile_pic)
                                            <img  src="{{ asset(Auth::user()->profile_pic) }}" class="img-radius" alt="User-Profile-Image">
                                        @else
                                            <img src="{{ asset('assets/img/admin/avatar-4.jpg') }}" class="img-radius" alt="User-Profile-Image">
                                        @endisset

                                        <span>{{ Auth::user()->name }}</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="#!">
                                                <i class="feather icon-settings"></i> Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('profile') }}">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-x"></i> Josephin Doe
                    </a>
                </div>
                <div class="main-friend-chat">
                    <div class="media chat-messages">
                        <a class="media-left photo-table" href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="{{ asset('assets/img/admin/avatar-2.jpg') }}"
                                alt="Generic placeholder image">
                        </a>
                        <div class="media-body chat-menu-content">
                            <div class="">
                                <p class="chat-cont">I'm just looking around. Will you tell me something about
                                    yourself?</p>
                            </div>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="media chat-messages">
                        <div class="media-body chat-menu-reply">
                            <div class="">
                                <p class="chat-cont">Ohh! very nice</p>
                            </div>
                            <p class="chat-time">8:22 a.m.</p>
                        </div>
                    </div>
                    <div class="media chat-messages">
                        <a class="media-left photo-table" href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="{{ asset('assets/img/admin/avatar-2.jpg') }}"
                                alt="Generic placeholder image">
                        </a>
                        <div class="media-body chat-menu-content">
                            <div class="">
                                <p class="chat-cont">can you come with me?</p>
                            </div>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="chat-reply-box">
                    <div class="right-icon-control">
                        <div class="input-group input-group-button">
                            <input type="text" class="form-control" placeholder="Write hear . . ">
                            <div class="input-group-append">
                                <button class="btn btn-primary waves-effect waves-light" type="button"><i
                                        class="feather icon-message-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <nav class="pcoded-navbar">
                        <div class="nav-list">
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="pcoded-navigation-label">Navigation</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="ms-hover {{ Request::is('admin') ? 'active' : '' }}" >
                                        <a href="{{ route('admin-home') }}" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                            <span class="pcoded-mtext">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="ms-hover {{ Request::is(
                                        'admin/bookings', 
                                        'admin/bookings/create', 
                                        'admin/bookings/*/edit',
                                        ) ? 'pcoded-trigger' : '' 
                                    }}">
                                        <a href="{{ route('bookings.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-micon">
                                            <i class="fa fa-taxi" aria-hidden="true"></i>
                                        </span>
                                        <span class="pcoded-mtext">Bookings</span>
                                        </a>
                                    </li>
                                    <li class="ms-hover {{ Request::is(
                                        'admin/new-drivers-request', 
                                        'admin/drivers-request-view/*', 
                                        ) ? 
                                        'active' : '' 
                                    }}">
                                        <a href="{{ route('new.driver') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-micon">
                                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                                        </span>
                                        <span class="pcoded-mtext">New Drivers Request </span>
                                        </a>
                                    </li>
                                    <li class="ms-hover {{ Request::is(
                                        'admin/drivers', 
                                        'admin/drivers/create', 
                                        'admin/drivers/*/edit') ? 
                                        'active' : '' 
                                    }}">
                                        <a href="{{ route('drivers.index') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-micon">
                                            <i class="fa fa-user-secret" aria-hidden="true"></i>
                                        </span>
                                        <span class="pcoded-mtext">Drivers</span>
                                        </a>
                                    </li>
                                    <li class="pcoded-hasmenu {{ Request::is(
                                        'admin/cars', 
                                        'admin/car-brand', 
                                        'admin/car-model', 
                                        'admin/cars/create', 
                                        'admin/car-brand/create', 
                                        'admin/car-model/create', 
                                        'admin/cars/*/edit',
                                        'admin/car-brand/*/edit',
                                        'admin/car-model/*/edit',
                                        ) ? 'pcoded-trigger' : '' 
                                    }}">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="fa fa-car" aria-hidden="true"></i>
                                            </span>
                                            <span class="pcoded-mtext">Cars</span>
                                            <span class="pcoded-badge label label-warning">NEW</span>
                                        </a>
                                        <ul class="pcoded-submenu" @style([
                                            'display: block' => Request::is(
											'admin/cars',
											'admin/car-brand',
											'admin/car-model',
											'admin/cars/create',
											'admin/car-brand/create',
											'admin/car-model/create',
											'admin/car-brand/*/edit',
											'admin/car-model/*/edit',
											'admin/cars/*/edit'),
                                        ])>
                                            <li class=" pcoded-hasmenu {{ Request::is(
                                                'admin/car-brand', 
                                                'admin/car-model', 
                                                'admin/car-brand/create', 
                                                'admin/car-model/create',
                                                'admin/car-brand/*/edit',
                                                'admin/car-model/*/edit',
                                                ) ? 'active' : '' 
                                            }}" >
                                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Manage Cars</span>
                                                </a>
                                                <ul class="pcoded-submenu" @style([
                                                    'display: block' => Request::is(
                                                        'admin/cars', 
                                                        'admin/car-brand', 
                                                        'admin/car-model', 
                                                        'admin/cars/create', 
                                                        'admin/car-brand/create', 
                                                        'admin/car-model/create', 
                                                        'admin/cars/*/edit',
                                                        'admin/car-brand/*/edit',
                                                    'admin/car-brand/*/edit'),
                                                ])>
                                                    <li @class([
                                                        'active' => Request::is(
                                                        'admin/car-brand',
                                                        'admin/car-brand/create',
                                                        'admin/car-brand/*/edit'),
                                                    ])>
                                                        <a href="{{ route('car-brand.index') }}" class="waves-effect waves-dark">
                                                            <span class="pcoded-mtext">Car Brands</span>
                                                        </a>
                                                    </li>
                                                    <li @class([
                                                        'active' => Request::is(
                                                        'admin/car-model',
                                                        'admin/car-model/create',
                                                        'admin/car-model/*/edit'),
                                                    ])>
                                                        <a href="{{ route('car-model.index') }}" class="waves-effect waves-dark">
                                                            <span class="pcoded-mtext">Car Models</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li @class([
                                                'active' => Request::is(
                                                    'admin/cars',
                                                    'admin/cars/create',
                                                    'admin/cars/*/edit'),
                                            ])>
                                                <a href="{{ route('cars.index') }}" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Cars List</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="ms-hover {{ Request::is(
                                        'admin/settings', 
                                        'admin/settings/create', 
                                        'admin/settings/*/edit',
                                        ) ? 'pcoded-trigger' : '' 
                                    }}">
                                        <a href="{{ route('setting') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-micon">
                                            <i class="fa fa-taxi" aria-hidden="true"></i>
                                        </span>
                                        <span class="pcoded-mtext">Settings</span>
                                        </a>
                                    </li>
                                    <li class="ms-hover">
                                        <a href="{{ route('logout') }}" class="waves-effect waves-dark">
                                        <span class="pcoded-micon">
                                            <i class="feather icon-log-out"></i>
                                        </span>
                                        <span class="pcoded-mtext">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <div class="pcoded-content">
                        <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-home bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Dashboard</h5>
                                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <!--li class="breadcrumb-item"><a href="#!">Dashboard</a> </li-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>

                    <div id="styleSelector">
                    </div>

                </div>
            </div>
        </div>
    </div>

    

    <script data-cfasync="false" src="{{ asset('assets/js/email-decode.min.js') }}"></script>
    <script  src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script  src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script  src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/js/waves.min.js') }}" ></script>

    <script  src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.flot.js') }}" ></script>
    <script src="{{ asset('assets/js/jquery.flot.categories.js') }}" ></script>
    <script src="{{ asset('assets/js/curvedlines.js') }}" ></script>
    <script src="{{ asset('assets/js/jquery.flot.tooltip.min.js') }}" ></script>

    <script src="{{ asset('assets/js/chartist.js') }}" ></script>

    <script src="{{ asset('assets/js/amcharts.js') }}" ></script>
    <script src="{{ asset('assets/js/serial.js') }}" ></script>
    <script src="{{ asset('assets/js/light.js') }}" ></script>

    <script src="{{ asset('assets/js/pcoded.min.js') }}" ></script>
    <script src="{{ asset('assets/js/vertical-layout.min.js') }}" ></script>
    <script  src="{{ asset('assets/js/custom-dashboard.min.js') }}"></script>
    <script  src="{{ asset('assets/js/script.min.js') }}"></script>
    <script  src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

    <script src="{{ asset('assets/js/rocket-loader.min.js') }}" data-cf-settings="d2d1d6e2f87cbebdf4013b26-|49" defer=""></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(function() {            
            $('.delete-btn').click(function() {
                let source = $(this).data('source');
                let deleteApiEndpoint = $(this).data('endpoint');

                swal({
                    title: "Are you sure?",
                    text: `You really want to remove this ${source}?`,
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: deleteApiEndpoint,
                            method: 'DELETE',
                            data: {
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if(response.success){
                                    swal({
                                        title: "Success!",
                                        text: response.message,
                                        type: "success",
                                        showConfirmButton: false
                                    }) 

                                    setTimeout(() => {
                                        location.reload();
                                    }, 2000);
                                }
                            }
                        })
                    }
                });
            })
        })
    </script>
</body>

</html>
