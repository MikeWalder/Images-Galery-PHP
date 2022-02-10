<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap 5.1.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Animate CSS library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <!-- Header CSS -->
    <link rel="stylesheet" href="css/headerStyle.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image galery website</title>

</head>

<body>
    <?php
    session_start();
    require_once('functionsDB.php');
    $directoryFile = checkCurrentRepertory();
    $directory = $directoryFile[0];
    $extension = $directoryFile[1];
    ?>

    <nav class="navbar navbar-light <?= ($directory !== 'configuration' ? 'bg-secondary' : 'bg-info') ?> fixed-top">
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center" id="bs-overwrite">
            <div class="offcanvas offcanvas-start <?= ($directory !== 'configuration' ? 'bg-secondary' : 'bg-info') ?> text-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                <div class="offcanvas-header">

                    <a class="navbar-brand text-white fw-bold me-3" href="<?= ($directory !== 'configuration' ? 'index.php' : 'configuration.php') ?>">
                        <img src="content/logo<?= ($directory !== 'configuration' ? '1.png' : '2.png') ?>" alt="" width="30" height="30" class="d-inline-block align-text-top text-white h3">
                        <?= ($directory !== 'configuration' ? 'Image Gallery' : 'Configuration') ?>
                    </a>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>

                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-start flex-grow-1 ps-3">

                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold hovernavlink" aria-current="page" href="index.php">Accueil</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold hovernavlink" href="images.php">Images</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold hovernavlink" href="configuration.php">Configuration</a>
                        </li>

                    </ul>
                </div>
            </div>

            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="me-auto ms-5">
                <input type="checkbox" class="btn-check" name="nightInput" id="nightInput">
                <label class="col-2 text-white fw-bold h4" for="nightInput" id="nightSelection">
                    <?= $night = 0 ? "<i class='far fa-moon fa-2x mt-2'></i>" : "<i class='fas fa-sun fa-2x mt-2'></i>" ?>
                </label>
            </div>

            <a class="fw-bold navbar-brand d-none d-md-block animate__animated animate__slideInRight" id="titleNavigation" href="<?= ($directory !== 'configuration' ? 'index.php' : 'configuration.php') ?>">
                <img src="content/logo<?= ($directory !== 'configuration' ? '1.png' : '2.png') ?>" alt="<?= ($directory !== 'configuration' ? 'Image Gallery Icon' : 'Configuration Icon') ?>" width="30" height="30" class="d-inline-block align-text-top me-3">
                <?= ($directory !== 'configuration' ? 'Image Gallery' : 'Configuration') ?>
            </a>

        </div>
    </nav>