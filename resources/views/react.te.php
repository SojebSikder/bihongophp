<!DOCTYPE html>
<html>

<head>
    <?php echo BASE ?>
    <meta charset="<?php echo CHARSET ?>">
    <link rel="icon" href="<?php echo ICON ?>" type="image/png" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to <?php echo TITLE ?> with react</title>

</head>

<body>
    <noscript>Please enable Javascript on your browser to visit this site </noscript>

    <div id="app">
        Hello World
    </div>

    <script src="{{ Url::asset('js/index.js') }}"></script>

</body>

</html>