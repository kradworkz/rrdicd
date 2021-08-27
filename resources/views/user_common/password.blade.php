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

    <body data-topbar="dark" data-layout="horizontal">
        <div id="app"> 

            <div class="account-pages my-5 pt-sm-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card overflow-hidden">
                                <div class="bg-soft-primary">
                                    <div class="row">
                                        <div class="col-12" style="margin-bottom: -15px;">
                                            <div class="text-primary p-3">
                                                <h5 class="text-primary" style="margin-bottom: 0px;">Update Password</h5>
                                                <p class="font-size-11">Please update your password.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0"> 
                                   
                                    <div class="p-2 mt-3">
                                       <password></password>
                                    </div>
                
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <div>
                                    <p>©  DOST - IX. <i class="mdi mdi-heart text-danger"></i> 2021</p>
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>