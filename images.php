<?php
require_once('header.php');
?>

<style>
    <?php require_once('css/imagesStyle.css'); ?>
</style>

<br><br><br>

<div class="h1 display-4 fw-bold text-center pt-5 animate__animated animate__fadeIn">
    <?=
    !isset($_GET['m']) ? 'Image library' : 'Image modification'
    ?></div>

<?php
if (!isset($_GET['m'])) {
?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center mt-3">
                <form method="POST" action="images.php">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatAll" value="*" checked>
                        <label class="form-check-label pe-1 pe-md-3" for="formatAll">
                            All
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatJpg" value="jpg">
                        <label class="form-check-label ps-0 ps-sm-1 pe-1 pe-md-3" for="formatJpg">
                            JPG
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatJpeg" value="jpeg">
                        <label class="form-check-label ps-0 ps-sm-1 pe-1 pe-md-3" for="formatJpeg">
                            JPEG
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatPng" value="png">
                        <label class="form-check-label ps-0 ps-sm-1 pe-1 pe-md-3" for="formatPng">
                            PNG
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatGif" value="gif">
                        <label class="form-check-label ps-0 ps-sm-1 pe-1 pe-md-3" for="formatGif">
                            GIF
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="imageFormat" id="formatSvg" value="svg">
                        <label class="form-check-label ps-0 ps-sm-1 pe-1 pe-md-3" for="formatSvg">
                            SVG
                        </label>
                    </div>
                    <input type="hidden" name="validation">
                    <button type="submit" class="col-6 btn btn-success btn-block fw-bold shadow mt-5" id="btnHoverEffect">Confirm</button>
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
    $favorite = (int)$datasImg['favorite'];
    $format = $datasImg['format'];
?>
    <div class="container">
        <div class="row">
            <div class="col-1 col-sm-2 col-md-4"></div>
            <div class="col-10 col-sm-8 col-md-4">
                <div class="card border-secondary animate__animated animate__fadeIn" style="height: 300px;">
                    <div class="wrapper text-center bg-secondary border" style="height: 300px;">
                        <img src="img/<?= $datasImg['nameImg'] . "." . $datasImg['format'] ?>" class="card-img-top text-center" alt="<?= $datasImg['descr'] ?>" style="height: 300px;">
                        <div class="card-body">
                            <h6 class="card-title text-white fw-bold pt-3">Name : <?= $datasImg['descr'] ? $datasImg['descr'] : $datasImg['nameImg'] ?></h6>
                            <h6 class="card-title text-white fw-bold">Type : <?= strtoupper($format) ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1 col-sm-2 col-md-4"></div>
        </div>
    </div>
    <form action="" method="POST">
        <div class="container mt-4">
            <div class="row">
                <div class="col-1 col-md-2"></div>
                <div class="col-10 col-md-8 bg-secondary rounded animate__animated animate__fadeIn">

                    <div class="form-group row mt-3">
                        <label for="description" class="col-2 col-form-label fw-bold h4 text-white">Description : </label>
                        <!-- <input type="textarea" name="description" class="form-control-text shadow bg-light col-6 pl-2" placeholder=""> -->
                        <div class="col-8">
                            <textarea class="form-control col-6" id="description" name="description" value="" rows="3" placeholder="<?= $descr ?>"></textarea>
                        </div>
                    </div>
                    <div class="text-center row mt-3 mb-2">
                        <div class="col-5"></div>
                        <input type="checkbox" class="btn-check mt-3" name="favorite" id="favo">
                        <label class="col-2 btn btn-outline-primary text-white fw-bold h4" for="favo" id="favoriteSelection">
                            <?= $favorite == 1 ? "<i class='fas fa-heart fa-lg' style='color: red;'></i>" : "<i class='fas fa-heart-broken' style='color: red;'></i>" ?>
                        </label>
                    </div>
                    <input type="hidden" name="validateModification">
                    <div class="text-center">
                        <button type="submit" name="modif" class="col-4 btn btn-warning my-4 validateModif"><i class="fas fa-edit me-3"></i>Modify</button>
                        <a href="images.php" class="col-4 btn btn-danger my-4 validateModif" title="Return to image gallery"><i class="fas fa-window-close me-3"></i>Cancel</a>
                    </div>
                </div>
                <div class="col-1 col-md-2"></div>
            </div>
    </form>
<?php
}
?>

<?php
if (isset($_POST['validateModification']) && isset($_POST['modif'])) {
    $id = $_GET['m'];
    empty($_POST['description']) ? $_POST['description'] = $descr : $_POST['description'] = htmlspecialchars($_POST['description']);
    empty($_POST['favorite']) ? $_POST['favorite'] = 0 : $_POST['favorite'] = 1;

    updateSelectedImageIntoTable($id, $_POST['description'], $_POST['favorite']);
}
?>



<script>
    /* function redirection() {
        window.location.href = 'http://localhost/wf3/bdd/Images-Galery-PHP/images.php';
    } */

    const favo = document.querySelector('#favo');
    const favoriteSelection = document.querySelector("#favoriteSelection");
    favo.addEventListener('click', function() {
        if (favo.checked == true) {
            favoriteSelection.innerHTML = "<i class='fas fa-heart fa-lg' style='color: red;'></i>";
            favoriteSelection.value = true;
        } else if (favo.checked == false) {
            favoriteSelection.innerHTML = "<i class='fas fa-heart-broken' style='color: red;'></i>";
            favoriteSelection.value = false;
        }
    })

    const nightInput = document.querySelector('#nightInput');
    const nightSelection = document.querySelector("#nightSelection");
    nightInput.addEventListener('click', function() {
        if (nightInput.checked == true) {
            nightSelection.innerHTML = "<i class='far fa-moon fa-lg mt-2'></i>";
            console.log(nightSelection.value);
            nightSelection.value = true;
            document.body.style.background = "black";

        } else if (nightInput.checked == false) {
            nightSelection.innerHTML = "<i class='fas fa-sun fa-lg mt-2'></i>";
            console.log(nightSelection.value);
            nightSelection.value = false;
            document.body.style.backgroundImage = 'url("content/font2.jpg")';
        }
    })
</script>


</script>


<?php
require_once('footer.php');
