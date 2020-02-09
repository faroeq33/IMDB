<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<div class="container-fluid">    
    <div class="row no-gutters">
        <div class="col">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Project <span class="text-uppercase">oop</span> movie</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Mijn films</a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="#">
                                Mijn bekeken
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Nog te bekijken</a>
                        </li>
                    </ul>

                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Zoek naar films" aria-label="Zoek films...">
                        <button class="btn btn-info my-2 my-sm-0" type="submit">Zoeken!</button>
                    </form>
                </div>
            </nav>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-md-8">
            <h2 class="h2">Mijn films</h2>

            <div class="movies">
                <div class="movie">
                    <img src="assets/img/macOS-11.jpg" alt="" class="movie__img">
                    <div class="movie__title">filmtitel</div>
                    <div class="movie__rating">5 sterren </div>
                </div>

                <div class="movie">
                    <img src="assets/img/macOS-11.jpg" alt="" class="movie__img">
                    <div class="movie__title">filmtitel</div>
                    <div class="movie__rating">2.5 sterren </div>
                </div>

                <div class="movie">
                    <img src="assets/img/macOS-11.jpg" alt="" class="movie__img">
                    <div class="movie__title">filmtitel</div>
                    <div class="movie__rating">3 sterren </div>
                </div>

                <div class="movie">
                    <img src="assets/img/macOS-11.jpg" alt="" class="movie__img">
                    <div class="movie__title">filmtitel</div>
                    <div class="movie__rating">4 sterren </div>
                </div>


            </div>
        </div>
        <div class="col-md-3">
            <h2>Login</h2>
            <form action="" class="form">
                <ul>
                    <br><br>
                    <input type="text" placeholder="Gebruikersnaam" class="loginform__field">
                    <br><br>
                    <input type="text" placeholder="Wachtwoord" class="loginform__field">
                    <br><br>
                    <a href="" class="loginform__field">Nog geen account?</a>
                </ul>
            </form>
        </div>
    </div>
</div>

<footer class="footer">
    <ul class="footer__list">
        <li class="footer__listitem text-muted">Project OOP Movie</li>
        <li class="footer__listitem text-muted">Alle rechten voorbehouden &copy; 2020</li>
    </ul>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>