<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('image/icon_univ_bsi.png') }}">
    <title>tokoonline</title>
    <!-- Custom CSS -->
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db"><img src="{{ asset('backend/images/logo.png') }}" alt="logo" /></span>
                    </div>
                    <!-- Form -->
                    <!-- error -->
                    @if(session()->has('password'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" arialabel="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{ session('password')}} </strong>
                        </div>
                    @endif
                    <!-- errorEnd -->
                    <form class="form-horizontal m-t-20" id="loginform" action="{{route('password.update') }}"
                        method="post">
                        <input type="hidden" name="token" value="{{$token}}">
                        <input type="hidden" name="email" value="{{$email}}">
                        @csrf
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success textwhite" id="basic-addon1"><i
                                                class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" name="password" value="{{old('email')}}"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        placeholder="Masukkan Password" aria-label="Password"
                                        aria-describedby="basicaddon1">
                                    @error('password')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning textwhite" id="basic-addon2"><i
                                                class="ti-reload"></i></span>
                                    </div>
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        placeholder="Masukkan Ulang Password" aria-label="Password"
                                        aria-describedby="basic-addon1">
                                    @error('password')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-success float-right" type="submit">Reset
                                            Password</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ==============================================================
        // Login and Recover Password
        // ==============================================================
        $('#to-recover').on("click", function () {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function () {
            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });

    </script>
</body>

</html>