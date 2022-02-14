<?php
require_once('header.php');
?>

<style>
    <?php require_once('css/indexStyle.css'); ?>
</style>

<br><br><br>

<h1 class="display-4 fw-bold text-center pt-5 animate__animated animate__fadeIn" id="maintitle">
    <script>
        checkModeMaintitle();
    </script>
    Add an image
</h1>

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <!-- Default file input example  within the main form -->
        <form class="col-6 bg-secondary mt-5 rounded animate__animated animate__fadeInDown animate__delay-1s" method="POST" enctype="multipart/form-data">
            <div class="mt-3">
                <input class="form-control animate__animated animate__fadeInDown animate__delay-1s" type="file" id="formFile" name="fileImgData" accept="image/*">
            </div>
            <div class="my-3">
                <textarea class="form-control" id="description" name="description" value="" rows="3" placeholder="Description (optional)"></textarea>
            </div>
            <div class="my-3 d-grid gap-2 col-4 mx-auto">
                <input type="checkbox" class="btn-check mt-3" name="favorite" id="favo">
                <label class="btn btn-outline-primary text-white fw-bold h4" for="favo" id="favoriteSelection">Add to favorite</label>
            </div>
            <div class="d-grid gap-2 col-8 mx-auto my-3 animate__animated animate__fadeInDown animate__delay-1s">
                <button type="submit" class="btn btn-success btn-block btn-lg">Confirm</button>
            </div>
        </form>
        <div class="col-3"></div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['fileImgData']) && !empty($_FILES['fileImgData']['error'] === 0)) {
        $descr = htmlspecialchars($_POST['description']);
        isset($_POST['favorite']) ? $favorite = true : $favorite = false;
        //$favorite = htmlspecialchars($_POST['favorite']);
        //echo "<h1>" . $favorite . "</h1>";
        $fileSize = round($_FILES['fileImgData']['size'] / 1000, 2);
        $fileNameExtension = explode('.', $_FILES['fileImgData']['name']);
        $nameOfFile = $fileNameExtension[0];
        $extension = $fileNameExtension[1];

        // Name and extension of our downloaded file
        $fileToUpload = $nameOfFile . "." . $extension;

        if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png' || $extension === 'gif' || $extension === 'GIF' || $extension === 'svg') {
            if ($fileSize <= 1000) {
                $nameImg = $_FILES['fileImgData']['tmp_name'];

                // select the uploaded file and add it into the selected destination
                move_uploaded_file($nameImg, "img/" . $fileToUpload);

                // call a function to add the file datas into the BDD
                addToTable($nameOfFile, $descr, $extension, $fileSize, $favorite);
            } else if ($fileSize > 1000) {
                $txt = "<div class='container'>
                            <div class='row'>
                                <div class='col-md-2'></div>
                                <div class='col-md-8 alert alert-warning text-center fw-bold mt-3 animate__animated animate__fadeOut animate__delay-2s'>
                                    Your file (" . $nameOfFile . " - " . $fileSize . "ko) is oversized !
                                    <br>" . $favorite . "
                                </div>
                                <div class='col-md-2'></div>
                            </div>
                        </div>";
                echo $txt;
            }
        }
    } else { // if no file is downloaded
        $txt = "<div class='container'>
            <div class='row'>
                <div class='col-md-2'></div>
                <div class='col-md-8 alert alert-danger text-center fw-bold mt-3 animate__animated animate__fadeOut animate__delay-2s'>
                    No file downloaded !
                </div>
                <div class='col-md-2'></div>
            </div>
        </div>";
        echo $txt;
    }
}
?>

<script>
    const favo = document.querySelector('#favo');
    const favoriteSelection = document.querySelector("#favoriteSelection");
    favo.addEventListener('click', function() {
        if (favo.checked == true) {
            favoriteSelection.innerHTML = "<i class='fas fa-heart fa-lg' style='color: red;'></i>";
            favoriteSelection.value = true;

        } else if (favo.checked == false) {
            favoriteSelection.innerHTML = "Add to favorite";
            favoriteSelection.value = false;

        }
    })
</script>

<?php
require_once('footer.php');
