<?php
require_once('header.php');
require_once('database.php');
?>
<br><br>
<div class="h1 display-4 fw-bold text-center pt-5">Add an image</div>

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 my-3">
            <!-- <label for="formFileMultiple" class="form-label">Multiple files input example</label> -->
            <input class="form-control" type="file" id="formFileMultiple" multiple placehover="No file selected">
        </div>
        <div class="col-3"></div>
    </div>
</div>

<?php
require_once('footer.php');
