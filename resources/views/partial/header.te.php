<!DOCTYPE html>
<html>

<head>
    {{{ BASE }}}
    <meta charset="{{ CHARSET }}">
    <link rel="icon" href="{{ ICON }}" type="image/png" sizes="16x16">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ name }}</title>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>


{% block content %}
<h1>Helo World from header</h1>
{% endblock %}