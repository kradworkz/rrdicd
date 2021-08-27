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
        <br><br><br><br><br>
        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <h1 class="display-2 font-weight-medium">5<i class='bx bx-alarm-exclamation bx-tada display-3 text-danger'></i></i>3</h1>
                            <h4 class="text-danger">Site is Under Maintenance</h4>
                            <p class="text-muted font-size-12">Please come back and try again later</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>

        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet' defer> 
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>