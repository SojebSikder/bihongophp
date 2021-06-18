{% extends 'resources/views/partial/header.te.php' %}

<!-- Used TE Templating -->

<center>
    <h1>Hello, Welcome to {{name}} Framework</h1>
    <h3>{{SLOGAN}}</h3>
</center>


{% block content %}
    <h1>Helo World</h1>
{% endblock %}



<p>You can find this page on <a style="color: violet;">resources/views/home.te.php<a></p>
<p class="footer">Bihongo Version <strong>{{B_VERSION}}</strong></p>

{% include 'resources/views/partial/footer.te.php' %}