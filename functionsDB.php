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
    return $answer;
}



function selectTabDataImageTypes()
{
    $pdo = connexionDB();

    $countJpg = $countJpeg = $countPng = $countGif = $countSvg = 0;
    $req = $pdo->query("SELECT format FROM tabimages");
    foreach ($req as $row) {
        $monTableauToutBeau[] = $row;
    }
    // echo count($monTableauToutBeau);
    for ($i = 0; $i < count($monTableauToutBeau); $i++) {
        switch ($monTableauToutBeau[$i]['format']) {
            case 'jpg':
                $countJpg++;
                break;
            case 'jpeg':
                $countJpeg++;
                break;
            case 'png':
                $countPng++;
                break;
            case 'gif':
                $countGif++;
                break;
            case 'svg':
                $countSvg++;
                break;
        }
    }
    $countAll = $countJpg + $countJpeg + $countPng + $countGif + $countSvg;
    // $tabCount = [$countAll, $countJpg, $countJpeg, $countPng, $countGif, $countSvg];
    $tabCount = [
        'all' => $countAll,
        'jpg' => $countJpg,
        'jpeg' => $countJpeg,
        'png' => $countPng,
        'gif' => $countPng,
        'svg' => $countSvg
    ];

    return $tabCount;

    // print_r($monTableauToutBeau[0]['format']);

    // $monTableauToutBeauEnJson = json_encode($monTableauToutBeau);
}



function addToTable($name, $descr, $format, $size, $favorite)
{
    $name = htmlspecialchars($name);
    $descr = htmlspecialchars($descr);
    $favorite === true ? $favorite = 1 : $favorite = 0;

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
                <div class='col-md-8 text-center alert alert-info animate__animated animate__fadeOut animate__delay-3s'>
                    Image has been added into database
                </div>
                <div class='col-md-2'></div>
            </div>
        </div>";

    $txt .= "<div class='container'>
        <div class='row'>
            <div class='col-md-2'></div>
            <div class='col-md-8 alert alert-success text-center fw-bold mt-3 animate__animated animate__fadeOut animate__delay-3s'>
                Extension : " . $format . "<br>
                File name : " . $name . "<br> 
                Size : " . $size . " ko<br>
            </div>
            <div class='col-md-2'></div>
        </div>
    </div>";
    echo $txt;
}



function modifIntoTable($id)
{
    $pdo = connexionDB();
    $answer = $pdo->prepare("SELECT * FROM tabimages WHERE id = :id");
    $answer->execute(array(
        'id' => $id
    ));
    $data = $answer->fetch();
    return $data;
}



function selectImageFormatFromTable($format)
{
    if ($format === "*") {
        // selectAllTable();
        $datas = selectAllTable();
        $count = $datas->rowCount();
        displayNumberOfResults($count);
        displayImagesIntoCards($datas);
    } else if ($format !== "*") {
        $pdo = connexionDB();
        $request = $pdo->query("SELECT * FROM tabimages WHERE format='" . $format . "' ORDER BY id DESC");
        $request->execute(array(
            'format' => $format
        ));
        $count = $request->rowCount();

        displayNumberOfResults($count);
        displayImagesIntoCards($request);
    }
}



function deleteFromTableById($identification)
{
    $pdo = connexionDB();
    $request = $pdo->prepare('DELETE FROM tabimages WHERE id = :id');
    $request->execute(array(
        'id' => $identification
    ));

    echo "<div class='container mt-3'>
            <div class='row'>
                <div class='col-12 text-center'>
                    <div class='alert alert-warning h3 animate__animated animate__fadeOut animate__delay-2s' role='alert'>
                    <i class='far fa-check-circle pr-3'></i>
                        La tâche a bien été supprimée !
                    </div>
                </div>
            </div>
        </div>";

    echo "<script>
    setTimeout(redirection(), 3000);
    </script>";
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



function displayImagesIntoCards($data)
{
?>
    <table class="table table-bordered">
        <?php
        while ($q = $data->fetch()) {
            if (sizeof($q) > 0) {
        ?>
                <div class="card col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 border-secondary" style="height: 300px;">
                    <div class="wrapper text-center bg-secondary border" style="height: 300px;">
                        <img src="img/<?= $q['nameImg'] . "." . $q['format'] ?>" class="card-img-top img-fluid text-center" alt="<?= $q['descr'] ?>" style="height: 300px;">
                        <div class="card-body">
                            <h6 class="card-title text-white fw-bold"><?= $q['descr'] ? $q['descr'] : $q['nameImg'] ?></h6>
                            <a href="images.php?m=<?= $q['id'] ?>" class="btn btn-warning btn-lg me-1" title="Modify"><i class="fas fa-edit"></i></a>
                            <a href="images.php?r=<?= $q['id'] ?>" class="btn btn-danger btn-lg ms-2 me-1" title="Delete"><i class="fas fa-trash-alt fa-lg"></i></a>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </table>
<?php
}


function displayNumberOfResults($count)
{
    $count <= 1 ? $multi = "" : $multi = "s";
    echo "<div class='mt-md-2 mb-md-3 text-center fw-bold h4 animate__animated animate__fadeIn animate__delay-1s'>" . $count . " result" . $multi . "</div>";
    //echo "<div class='mt-3 text-center fw-bold h4 animate__animated animate__fadeIn animate__delay-1s'>" . sizeof($arrayData) . "résultats</div>";
}
