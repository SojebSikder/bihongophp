{% extends 'resources/views/partial/header.te.php' %}

<!-- Used TE Templating -->

{% block title %}
{{ name }}
{% endblock %}

{% block content %}

<center>
    <h1>Hello, Welcome to {{name}} Framework</h1>
    <p>Let's create awesome</p>
</center>

<p>You can find this page on <a style="color: violet;">resources/views/home.te.php<a></p>
<p class="footer">Bihongo Version <strong>{{B_VERSION}}</strong></p>

{% include 'resources/views/partial/footer.te.php' %}


{% endblock %}