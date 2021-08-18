
<!doctype html>
<html lang="en">

<head>
    <title>{{config('app.name')}}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Krad was here" name="description" />
    <meta content="KradWasHere" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

    <link rel="shortcut icon" href="assets/images/icon.png">
    <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}" />
</head>

<body class="auth-body-bg">
        
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                
                <div class="col-xl-8">
                    <div class="auth-full-bg">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="mt-lg-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <h4 class="mt-4 font-weight-semibold">RRDICD Web Application</h4>
                                            <p class="text-muted">Regional Research, Development and Innovation Committee Database. <br><br>This website will help you find information on plans, policies, programs and projects for the development of the region.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="my-auto">
                                    
                                    <div>
                                        <h6 class="text-primary">Sign in to continue to <u>RRDICD</u>.</h6>
                                    </div>
        
                                    <div class="mt-4">
                                        <form method="POST" action="{{ route('login') }}">@csrf
            
                                            <div class="form-group">
                                                <label for="username">Email Address</label>
                                                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Enter email" required autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                    
                                            <div class="form-group">
                                                <div class="float-right">
                                                    <a href="auth-recoverpw-2.html" class="text-muted">Forgot password?</a>
                                                </div>
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password"  required autocomplete="current-password">
                                            </div>
                    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="auth-remember-check">
                                                <label class="custom-control-label" for="auth-remember-check">Remember me</label>
                                            </div>
                                            
                                            <div class="mt-3">
                                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                            </div>

                                        </form>
                                        <div class="mt-5 text-center">
                                            <p>Don't have an account ? <a href="auth-register-2.html" class="font-weight-medium text-primary"> Signup now </a> </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Developed by <i class="mdi mdi-heart text-danger"></i> DOST-IX</p>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- owl.carousel js -->
        <script src="assets/libs/owl.carousel/owl.carousel.min.js"></script>

        <!-- auth-2-carousel init -->
        <script src="assets/js/pages/auth-2-carousel.init.js"></script>
        
        <!-- App js -->
        <!-- <script src="assets/js/app.js"></script> -->

    </body>
</html>