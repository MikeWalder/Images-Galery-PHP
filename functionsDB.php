<?php

function connexionDB()
{
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=force3;port=3308;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    return $pdo;
}



function selectAllTable()
{
    $pdo = connexionDB();
    $answer = $pdo->query("SELECT * FROM tabimages order by id DESC");
?>
    <table class="table table-bordered">
        <?php
        while ($q = $answer->fetch()) {
        ?>

            <div class="card col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mt-3 border-secondary" style="height: 250px;">
                <img src="img/<?= $q['nameImg'] . "." . $q['format'] ?>" class="card-img-top img-fluid text-center" alt="<?= $q['descr'] ?>" style="height: 200px;">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= $q['nameImg'] . "." . $q['format'] ?></h5>
                </div>
            </div>

        <?php
        }
        ?>
    </table>
<?php
}



function addToTable($name, $descr, $format, $size, $favorite)
{
    $name = htmlspecialchars($name);
    $descr = htmlspecialchars($descr);
    $favorite = 0;

    $target_dir = "img/";
    //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $pdo = connexionDB();
    $request = $pdo->prepare('INSERT INTO tabimages (nameImg, descr, format, size, favorite) VALUES (:nameImg, :descr, :format, :size, :favorite)');
    $request->execute(array(
        'nameImg' => ucfirst($name),
        'descr' => ucfirst($descr),
        'format' => $format,
        'size' => $size,
        'favorite' => $favorite
    ));

    $txt = "<div class='container mt-3'>
            <div class='row'>
                <div class='col-md-2'></div>
                <div class='col-md-8 text-center alert alert-info animate__animated animate__fadeOut animate__delay-2s'>
                    Image has been added into database
                </div>
                <div class='col-md-2'></div>
            </div>
        </div>";

    $txt .= "<div class='container'>
        <div class='row'>
            <div class='col-md-2'></div>
            <div class='col-md-8 alert alert-success text-center fw-bold mt-3 animate__animated animate__fadeOut animate__delay-2s'>
                Extension : " . $format . "<br>
                File name : " . $name . "<br> 
                Size : " . $size . " ko<br>
            </div>
            <div class='col-md-2'></div>
        </div>
    </div>";
    echo $txt;
}



function modifIntoTable($identification)
{
    $id = (int)$identification;
    $pdo = connexionDB();
    $request = $pdo->prepare('SELECT * FROM tabimages WHERE id = :id');
    $request->execute(array(
        'id' => $id
    ));
    $datas = $request->fetch();
    return $datas;
}



function deleteFromTableById($identification)
{
    $id = (int)$identification;
    $pdo = connexionDB();
    $request = $pdo->prepare('DELETE FROM tabimages WHERE id = :id');
    $request->execute(array(
        'id' => $id
    ));
    echo "<div class='container mt-3'>
            <div class='row'>
                <div class='col-md-2'></div>
                <div class='col-md-8 text-center alert alert-info'>
                    L'image a bien été supprimée !
                </div>
                <div class='col-md-2'></div>
            </div>
        </div>";
}



function checkCurrentRepertory()
{
    $current_rep = $_SERVER["PHP_SELF"];
    $rep_struct = explode('/', $current_rep);
    $size_rep_struct = count($rep_struct);
    $currentFileDirectory = explode('.', $rep_struct[$size_rep_struct - 1]);
    $currentFileDirectoryName = $currentFileDirectory[0];
    // echo "<div class='h1 alert alert-info text-center fw-bold mt-3'>" . $currentFileDirectory . "</div>";

    return $currentFileDirectoryName;
}
