<?php class_exists('Perser2') or exit; ?>
<!DOCTYPE html>
<html>

<head>
    <?php echo BASE ?>
    <meta charset="<?php echo CHARSET ?>">
    <link rel="icon" href="<?php echo ICON ?>" type="image/png" sizes="16x16">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to <?php echo TITLE ?></title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo Url::asset('assets/css/style.css') ?>">
</head>

<body>

    <center>
        <h1>Hello, Welcome to <?php echo TITLE ?> Framework</h1>
        <h3><?php echo SLOGAN ?></h3>
        <h3>This is example of TE Template Engine</h3>
    </center>

    <a href="">Home</a>
    <br>
    <?php echo "Hello, I'm "; ?><?php echo $name ?>
    <p>If you see the source code of this page you can see TE Templating code</p>

    <p>You can find this page on <a style="color: violet;">resources/views/home.te.php<a></p>
    <p class="footer">Bihongo Version <strong><?php echo B_VERSION ?></strong></p>


</body>

</html>