<!DOCTYPE html>
<html>

<head>
    {{ BASE }}
    <meta charset="UTF-8">
    <link rel="icon" href="{{ ICON }}" type="image/png" sizes="16x16">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to {{ name }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material.css') }}">

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jsoj.js') }}"></script>
    <script src="{{ asset('assets/js/material.js') }}"></script>
</head>

<body>


    <div class="container">
        <div class="m-justify">
            <div class="m-card">
                <div class="m-card-body">

                    <form class="form-signin" action="/register" method="post">

                        <h3 class="m-center">Register</h3>
                        <p class="m-center">It's free!</p>


                        <div class="m-input-group">
                            <input type="text" name="username" class="text-dark m-form-control" autofocus>
                            <label>Name</label>
                        </div>

                        <div class="m-input-group">
                            <input type="text" name="email" class="text-dark m-form-control">
                            <label>Email address</label>
                        </div>

                        <div class="m-input-group">
                            <input type="password" name="password" class="text-dark m-form-control">
                            <label>Password</label>
                        </div>


                        <input class="float-left m-hidden" id="psk" type="button" ng-click="showPass()">
                        <label class="float-left" for="psk">Show Password</label>

                        <p class="float-right">Already have an account? <a href="login">Login</a></p>
                        <input class="m-btn waves-effect m-btn-primary m-btn-block" name="submit" type="submit" value="Register">
                    </form>

                </div>
            </div>
        </div>
    </div>