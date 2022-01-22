<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap 5.1.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Animate CSS library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- CSS files -->
    <link rel="stylesheet" href="css/style.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image galery website</title>
    <style>
        body {
            background: content-box no-repeat fixed bottom url("content/font1.jpeg");
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-secondary fixed-top">
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center">
            <div class="offcanvas offcanvas-start bg-secondary text-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <!-- <h3 class="offcanvas-title text-white" id="offcanvasNavbarLabel">Image galery</h3> -->
                    <a class="navbar-brand text-white fw-bold" href="index.php">
                        <img src="content/logo.png" alt="Website logo" width="30" height="30" class="d-inline-block align-text-top text-white h3">
                        Image Gallery
                    </a>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-start flex-grow-1 ps-3">

                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold hovernavlink" aria-current="page" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold hovernavlink" href="#">Images</a>
                        </li>

                    </ul>
                    <!-- <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Valider</button>
                    </form> -->
                </div>
            </div>

            <button class="navbar-toggler bg-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand animate__animated animate__slideInRight" href="index.php">
                <img src="content/logo.png" alt="Website logo" width="30" height="30" class="d-inline-block align-text-top text-white">
                Image Gallery
            </a>

        </div>
    </nav>