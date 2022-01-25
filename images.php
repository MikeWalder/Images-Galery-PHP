<?php
require_once('header.php');
?>

<style>
    <?php require_once('css/imagesStyle.css'); ?>
</style>

<br><br><br>

<div class="h1 display-4 fw-bold text-center pt-5 animate__animated animate__fadeIn">Images</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <form method="POST">
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

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-12 col-md-10">
            <div class="row">
                <?php
                if (isset($_POST['validation'])) {
                    $formatImage = htmlspecialchars($_POST['imageFormat']);
                    if ($formatImage === "*") {
                        $datas = selectAllTable();
                        displayImagesIntoCards($datas);
                    } else if ($formatImage !== "*") {
                        selectImageFormatFromTable($formatImage);
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<?php
/* if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['imageFormat']) && !empty($_POST['imageFormat'])) {
        $format = htmlspecialchars($_POST['imageFormat']);

        selectImageFormatFromTable($format);
    }
} */
?>

<?php
require_once('footer.php');
