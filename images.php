<?php
require_once('header.php');
?>

<style>
    <?php require_once('css/imagesStyle.css'); ?>
</style>

<br><br><br>

<div class="h1 display-4 fw-bold text-center pt-5 animate__animated animate__fadeInDown">Images</div>

<div class="container-fluid">
    <div class="row">
        <?php
        $datas = selectAllTable();
        displayImagesIntoCards($datas);
        ?>
    </div>
</div>




<?php
require_once('footer.php');
