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

    </center>

    <ul>
        <li><a href="te">See TE Example</a></li>
        <li><a href="callback">See Callback Example</a></li>
    </ul>


    <p>You can find this page on <a style="color: violet;">resources/views/home.php<a></p>
    <p class="footer"><?php echo  'Bihongo Version <strong>' . B_VERSION . '</strong>' ?></p>


</body>

</html>