<?php
require_once('header.php');
require_once('functionsDB.php');
?>
<br><br>
<div class="h1 display-4 fw-bold text-center pt-5">Add an image</div>

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <!-- Default file input example  within the main form -->
        <form class="col-6" method="POST" enctype="multipart/form-data">
            <div class="mt-5">
                <input class="form-control" type="file" id="formFile" name="fileImgData">
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
    $fileSize = round($_FILES['fileImgData']['size'] / 1000, 2);
    $fileNameExtension = explode('.', $_FILES['fileImgData']['name']);
    $nameOfFile = $fileNameExtension[0];
    $extension = $fileNameExtension[1];
    /* echo "<div class='h1 text-center bg-success'>Hello here !</div>";
    echo "<pre class='h3 fw-bold'>";
    echo $_FILES['fileImgData']['name'];
    echo "</pre>";
    echo $fileType . "<br>";
    echo $fileNameExtension[0] . " and " . $fileNameExtension[1]; */

    if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png' || $extension === 'gif' || $extension === 'svg') {
        if ($fileSize <= 1000) {
            $descr = "Une simple image";
            $favorite = false;
            addToTable($nameOfFile, $descr, $extension, $fileSize, $favorite);
            $txt = "<div class='container'>
                        <div class='row'>
                            <div class='col-md-2'></div>
                            <div class='col-md-8 alert alert-success text-center fw-bold mt-5 animate__animated animate__fadeIn'>
                                Extension : " . $extension . "<br>
                                File name : " . $nameOfFile . "<br> 
                                Size : " . $fileSize . " ko<br>
                            </div>
                            <div class='col-md-2'></div>
                        </div>
                    </div>";
            echo $txt;
        } else if ($fileSize > 1000) {
            $txt = "<div class='container'>
                        <div class='row'>
                            <div class='col-md-2'></div>
                            <div class='col-md-8 alert alert-warning text-center fw-bold mt-3 animate__animated animate__fadeIn'>
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
