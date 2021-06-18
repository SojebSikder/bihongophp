<!DOCTYPE html>
<html>

<head>
    <base href="{{ ROOT }}">
    <meta charset="UTF-8">
    <link rel="icon" href="{{ ICON }}" type="image/png" sizes="16x16">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to {{ name }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ ASSET }}css/material.css">

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jsoj.js') }}"></script>
    <script src="{{ asset('assets/js/material.js') }}"></script>
</head>

<body>


    <div class="container">
        <div class="m-justify">
            <div class="m-card">
                <div class="m-card-body">


                    <form class="form-signin" action="/login" method="post"></form>

                    <h5 class="m-center">Login</h5>


                    <div class="m-input-group">
                        <input type="text" name="username" class="text-dark m-form-control" autofocus>
                        <label>Username or Email</label>
                    </div>

                    <div class="m-input-group">
                        <input type="password" name="password" class="text-dark m-form-control">
                        <label>Password</label>
                    </div>

                    <a class="float-left" href="recover">Forget Account?</a>
                    <p class="float-right">Don\'t have an account? <a href="register">Register</a></p>
                    <input class="m-btn waves-effect m-btn-primary m-btn-block" name="submit" type="submit" value="Sign in">

                    </form>

                </div>
            </div>
        </div>
    </div>