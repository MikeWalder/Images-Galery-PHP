<?php
require_once('header.php');
?>

<style>
    <?php require_once('css/imagesStyle.css'); ?>
</style>

<br><br><br>

<div class="h1 display-4 fw-bold text-center pt-5">Images</div>

<div class="container-fluid">
    <div class="row">
        <?php selectAllTable(); ?>
    </div>
</div>




<?php
require_once('footer.php');
