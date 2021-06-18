<?php class_exists('System\Core\Perser2') or exit; ?>
<!DOCTYPE html>
<html>

<head>
    <?php echo BASE ?>
    <meta charset="UTF-8">
    <link rel="icon" href="" type="image/png" sizes="16x16">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to <?php echo htmlentities(name, ENT_QUOTES, 'UTF-8') ?></title>

    <link rel="stylesheet" href="<?php echo htmlentities(asset('assets/css/bootstrap.min.css'), ENT_QUOTES, 'UTF-8') ?>">
    <link rel="stylesheet" href="<?php echo htmlentities(asset('assets/css/material.css'), ENT_QUOTES, 'UTF-8') ?>">

    <script src="<?php echo htmlentities(asset('assets/js/jquery.min.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script src="<?php echo htmlentities(asset('assets/js/jsoj.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
    <script src="<?php echo htmlentities(asset('assets/js/material.js'), ENT_QUOTES, 'UTF-8') ?>"></script>
</head>

<body>


    <div class="container">
        <div class="m-justify">
            <div class="m-card">
                <div class="m-card-body">

                    <form class="form-signin" action="/login" method="post">

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
                        <p class="float-right">Don't have an account? <a href="register">Register</a></p>
                        <input class="m-btn waves-effect m-btn-primary m-btn-block" name="submit" type="submit" value="Sign in">

                    </form>

                </div>
            </div>
        </div>
    </div>