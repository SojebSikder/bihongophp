<!DOCTYPE html>
<html>
<head>
    <base href="{ROOT}">
    <meta charset="UTF-8">
    <link rel="icon" href="{ICON}" type="image/png" sizes="16x16">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Welcome to {TITLE}</title>
    <link rel="stylesheet" href="{ASSET}css/style.css">
</head>

<body>

	<center>
    <h1>Hello, Welcome to {TITLE} Framework</h1>
    <h3>{SLOGAN}</h3>
    <h3>This is example of TE Template Engine</h3>
    <p>TE is now experimental!. Also TE template loading time slow then normal rendering</p>
    </center>

    <a href="">Home</a>
    
    <?php echo "Hello My name is {name}"; ?>

    <p>If you see the source code of this page you can see TE Templating code</p>
    
    <p>You can find this page on <a style="color: violet;">app/views/home.te.php<a></p>
    <p class="footer">Bihongo Version <strong>{B_VERSION}</strong></p>


</body>
</html>