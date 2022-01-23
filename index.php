<?php
require_once('header.php');
?>

<style>
    <?php require_once('css/indexStyle.css'); ?>
</style>

<br><br>
<div class="h1 display-4 fw-bold text-center pt-5">Add an image</div>

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <!-- Default file input example  within the main form -->
        <form class="col-6" method="POST" enctype="multipart/form-data">
            <div class="mt-5">
                <input class="form-control" type="file" id="formFile" name="fileImgData" accept="image/*">
            </div>
            <div class="mt-3">
                <textarea class="form-control" id="description" name="description" value="" rows="3" placeholder="Description (optional)"></textarea>
            </div>
            <div class="d-grid gap-2 col-8 mx-auto mt-5">
                <button type="submit" class="btn btn-success btn-block btn-lg">Confirm</button>
            </div>
        </form>
        <div class="col-3"></div>
    </div>
</div>

<?php
if (isset($_FILES['fileImgData'])) {
    $descr = htmlspecialchars($_POST['description']);
    $fileSize = round($_FILES['fileImgData']['size'] / 1000, 2);
    $fileNameExtension = explode('.', $_FILES['fileImgData']['name']);
    $nameOfFile = $fileNameExtension[0];

    $extension = $fileNameExtension[1];
    $fileToUpload = $nameOfFile . "." . $extension;

    if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png' || $extension === 'gif' || $extension === 'GIF' || $extension === 'svg') {
        if ($fileSize <= 1000) {
            $favorite = false;
            // $infosFile = pathinfo($fileToUpload);
            $nameImg = $_FILES['fileImgData']['tmp_name'];

            // select the uploaded file and add it into the selected destination
            move_uploaded_file($nameImg, "img/" . $fileToUpload);

            // call a funvction to add the file datas into the BDD
            addToTable($nameOfFile, $descr, $extension, $fileSize, $favorite);
        } else if ($fileSize > 1000) {
            $txt = "<div class='container'>
                        <div class='row'>
                            <div class='col-md-2'></div>
                            <div class='col-md-8 alert alert-warning text-center fw-bold mt-3 animate__animated animate__fadeOut animate__delay-2s'>
                                Your file (" . $nameOfFile . " - " . $fileSize . "ko) is oversized !
                            </div>
                            <div class='col-md-2'></div>
                        </div>
                    </div>";
            echo $txt;
        }
    }
}
?>

<?php
require_once('footer.php');
