<?php
declare(strict_types=1);
//session_start();
?>


<!doctype html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>photos</title>
</head>
<body>

<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php?p=home">Whole Wild World</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{% block signUpLink %}{% endblock %}">{% block signUp %}{% endblock %}<span class="sr-only">(current)</span></a>
            </li>





            <li class="nav-item">
                    <a class="nav-link"
                       href="{% block connexionLink %}{% endblock %}">{% block connexion %}{% endblock %}</a>
                </li>
            {% block navMenu %}{% endblock %}
        </ul>
        <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Search">
        </form>
    </div>
</nav>

            <h1>hello <?= $_COOKIE['first_name'] ?></h1>



<div class="container">
    <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">

           <?php foreach ($images as $image):?>

            <img src="<?= $image['img_name'] ?>" alt="">
           <?php endforeach;?>



        </div>
    </div>
</div>






        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="public/assets/js/vendor/popper.min.js"></script>
<script src="public/dist/js/bootstrap.min.js"></script>
<script src="public/assets/js/vendor/holder.min.js"></script>
<script src="public/js/upload.js"></script>
<script src="public/js/uploadStatement.js"></script>

</body>
</html>