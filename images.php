<?php
require_once('header.php');
?>

<style>
    <?php require_once('css/imagesStyle.css'); ?>
</style>

<br><br><br>

<div class="h1 display-4 fw-bold text-center pt-5 animate__animated animate__fadeIn">Image library</div>

<?php
if (!isset($_GET['m'])) {
?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">
                <form method="POST" action="images.php">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatAll" value="*" checked>
                        <label class="form-check-label pe-3" for="formatAll">
                            All
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatJpg" value="jpg">
                        <label class="form-check-label ps-1 pe-3" for="formatJpg">
                            JPG
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatJpeg" value="jpeg">
                        <label class="form-check-label ps-1 pe-3" for="formatJpeg">
                            JPEG
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatPng" value="png">
                        <label class="form-check-label ps-1 pe-3" for="formatPng">
                            PNG
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatGif" value="gif">
                        <label class="form-check-label ps-1 pe-3" for="formatGif">
                            GIF
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatSvg" value="svg">
                        <label class="form-check-label ps-1 pe-3" for="formatSvg">
                            SVG
                        </label>
                    </div>
                    <input type="hidden" name="validation">
                    <button type="submit" class="col-6 btn btn-success btn-block fw-bold shadow mt-4" id="btnHoverEffect">Confirm</button>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
<?php
}
?>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-12 col-md-10">
            <div class="row">
                <?php
                if (isset($_POST['validation'])) {
                    $formatImage = htmlspecialchars($_POST['imageFormat']);
                    selectImageFormatFromTable($formatImage);
                }
                ?>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<?php
if (isset($_GET['r']) && $_GET['r'] > 0) {
    $id = (int)$_GET['r'];
    deleteFromTableById($id);
}

if (isset($_GET['m']) && $_GET['m'] > 0) {
    $id = (int)$_GET['m'];
    $datasImg = modifIntoTable($id);

    $nameImg = $datasImg['nameImg'];
    $descr = $datasImg['descr'];
    $favorite = $datasImg['favorite'];
    $format = $datasImg['format'];
?>
    <div class="container">
        <div class="row">
            <div class="col-1 col-sm-2 col-md-3"></div>
            <div class="col-10 col-sm-8 col-md-6">
                <div class="card border-secondary" style="height: 300px;">
                    <div class="wrapper text-center bg-secondary border" style="height: 300px;">
                        <img src="img/<?= $datasImg['nameImg'] . "." . $datasImg['format'] ?>" class="card-img-top img-fluid text-center" alt="<?= $datasImg['descr'] ?>" style="height: 300px;">
                        <div class="card-body">
                            <h6 class="card-title text-white fw-bold"><?= $datasImg['descr'] ? $datasImg['descr'] : $datasImg['nameImg'] ?></h6>
                            <h6 class="card-title text-white fw-bold">Type : <?= $format ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1 col-sm-2 col-md-3"></div>
        </div>
    </div>
    <form action="" method="POST">
        <div class="container mt-4">
            <div class="row">
                <div class="col-1 col-md-3"></div>
                <div class="col-10 col-md-6 bg-secondary rounded">
                    <div class="form-group row mt-3">
                        <label for="nameImg" class="col-3 col-form-label font-weight-bold h4">Nom : </label>
                        <input type="text" name="nameImg" class="form-control-text shadow bg-light col-6 pl-2" placeholder="<?= $nameImg ?>">
                    </div>
                    <div class="form-group row mt-3">
                        <label for="description" class="col-3 col-form-label font-weight-bold h4">Description : </label>
                        <input type="text" name="description" class="form-control-text shadow bg-light col-6 pl-2" placeholder="<?= $descr ?>">
                    </div>
                    <div class="form-group row mt-3">
                        <label for="favorite" class="col-3 col-form-label font-weight-bold h4">Favorite : </label>
                        <input type="text" name="favorite" class="form-control-text shadow bg-light col-6 pl-2" placeholder="<?= $favorite ?>">
                    </div>
                    <input type="hidden" name="validateModification">
                    <div class="mx-auto">
                        <button type="submit" class="col-4 btn btn-warning my-4">Modifier</button>
                    </div>
                    <div class="col-1 col-md-3"></div>
                </div>
            </div>
    </form>
<?php
}
?>

<?php
if (isset($_POST['validateModification'])) {
}
?>



<script>
    function redirection() {
        window.location.href = 'http://localhost/wf3/bdd/Images-Galery-PHP/images.php';
    }
</script>

<?php
require_once('footer.php');
