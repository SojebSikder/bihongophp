<?php class_exists('System\Core\Perser2') or exit; ?>
<!DOCTYPE html>
<html>

<head>
    <?php echo BASE ?>
    <meta charset="<?php echo htmlentities(CHARSET, ENT_QUOTES, 'UTF-8') ?>">
    <link rel="icon" href="" type="image/png" sizes="16x16">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlentities(name, ENT_QUOTES, 'UTF-8') ?></title>
    <!-- css -->
    <link rel="stylesheet" href="<?php echo htmlentities(asset('assets/css/style.css'), ENT_QUOTES, 'UTF-8') ?>">
</head>

<body>




<!-- Used TE Templating -->

<center>
    <h1>Hello, Welcome to <?php echo htmlentities(name, ENT_QUOTES, 'UTF-8') ?> Framework</h1>
    Let's create awesome
</center>






<p>You can find this page on <a style="color: violet;">resources/views/home.te.php<a></p>
<p class="footer">Bihongo Version <strong><?php echo htmlentities(B_VERSION, ENT_QUOTES, 'UTF-8') ?></strong></p>

</body>

</html>