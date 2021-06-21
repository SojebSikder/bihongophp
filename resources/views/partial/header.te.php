<!DOCTYPE html>
<html>

<head>
    {{{ BASE }}}
    <meta charset="{{ CHARSET }}">
    <link rel="icon" href="" type="image/png" sizes="16x16">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{% yield title %}</title>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>


    {% yield content %}