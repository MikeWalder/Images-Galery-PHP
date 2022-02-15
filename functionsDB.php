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



function updateSelectedImageIntoTable($id, $descr, $favorite)
{
    $pdo = connexionDB();
    // $nameImg = htmlspecialchars($nameImg);
    $descr = htmlspecialchars($descr);
    // $favorite === true ? $favorite = 1 : $favorite = 0;
    $sql = "UPDATE tabimages SET descr = :descr, favorite = :favorite WHERE id = " . (int)$id;
    $request = $pdo->prepare($sql);
    $request->execute(array(
        'descr' => $descr,
        'favorite' => $favorite
    ));
    $txt = "<div class='container mt-3'>
                <div class='row'>
                    <div class='col-md-2'></div>
                    <div class='col-md-8 text-center alert alert-info animate__animated animate__fadeOut animate__delay-2s'>
                        Your image has been sucessfully modified ! <br>
                        <div class='spinner-border text-info me-3' role='status'>
                            <span class='sr-only'>Loading...</span>
                        </div>
                        Redirection ... 
                    </div>
                    <div class='col-md-2'></div>
                </div>
            </div>";
    echo $txt;

    echo "<script>
            setTimeout('redirection()', 2000);
        </script>";
}



function selectImageFormatFromTable($format)
{
    if ($format === "*") {
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
    // delete image file in img folder
    $datasImg = modifIntoTable($identification);
    $nameImg = $datasImg['nameImg'];
    $format = $datasImg['format'];
    $rep = getcwd();
    $fileToDelete = $rep . "/img/" . $nameImg . "." . $format;
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
    }

    // BDD part
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
        setTimeout('redirection()', 2500);
    </script>";
}



function checkCurrentRepertory()
{
    $current_rep = $_SERVER["PHP_SELF"];
    $rep_struct = explode('/', $current_rep);
    $size_rep_struct = count($rep_struct);
    $currentFileDirectory = explode('.', $rep_struct[$size_rep_struct - 1]);

    return $currentFileDirectory;
}



function displayImagesIntoCards($data)
{
?>
    <table class="table table-bordered">
        <?php
        while ($q = $data->fetch()) {
            if (sizeof($q) > 0) {
        ?>
                <div class="card col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 border-secondary animate__animated animate__fadeIn">
                    <div class="wrapper bg-secondary border" style="height: 300px;">
                        <img src="img/<?= $q['nameImg'] . "." . $q['format'] ?>" class="card-img-top text-center pt-md-1" alt="<?= $q['descr'] ?>" style="height: 300px;">
                        <div class="cardfavorite">
                            <?= $q['favorite'] == 0 ? '<i class="fas fa-heart-broken fa-2x" style="color:red;"></i>' : '<i class="fas fa-heart fa-2x" style="color:red;"></i>' ?>
                        </div>
                        <div class="card-body text-center p-0">
                            <h6 class="card-title text-white my-auto fw-bold pt-2" style="height: 60px;"><?= $q['descr'] ? $q['descr'] : $q['nameImg'] ?></h6>
                            <a href="images.php?m=<?= $q['id'] ?>" class="btn btn-warning col-4 me-1" title="Modify"><i class="fas fa-edit"></i></a>
                            <a href="images.php?r=<?= $q['id'] ?>" class="btn btn-danger col-4 ms-2 me-1" title="Delete"><i class="fas fa-trash-alt fa-lg"></i></a>
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
    echo "<div class='my-md-3 text-center fw-bold text-secondary h4 animate__animated animate__fadeIn'>" . $count . " result" . $multi . "</div>";
}



function displayCalendar()
{
    $datasDate = getdate();
    $firstDayOfCurrentMonth = date("w", mktime(0, 0, 0, date("m"), 1, date("Y")));
    $numberDays = date('t', $firstDayOfCurrentMonth);

    $daysName = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];
    $tabNumberDays = [];
    (int)$datasDate['minutes'] < 10 ? $datasDate['minutes'] = "0" . $datasDate['minutes'] : $datasDate['minutes'];
?>
    <div class='card'>
        <div class='card-header fw-bold h4'>
            Calendar <span class="pb-2" style="float: right;"><?= ($datasDate['hours'] + 1) . ":" . $datasDate['minutes'] ?></span>
        </div>
        <div class='card-body'>
            <table class='table text-center'>
                <thead>
                    <th colspan='8' class='h4 fw-bold'><?= $datasDate['month'] . " " . $datasDate['year'] ?></th>
                </thead>
                <thead>
                    <?php
                    for ($i = 0; $i < count($daysName); $i++) {
                    ?>
                        <th class='ps-2'><?= $daysName[$i] ?></th>
                    <?php
                    }
                    ?>
                </thead>
                <tbody>
                    <tr>
                        <?php

                        $totalBeginCalendar = $firstDayOfCurrentMonth + $numberDays;

                        $weeksOfCurrentMonth = ceil($numberDays / 7);

                        for ($i = 1; $i <= $weeksOfCurrentMonth * 7; $i++) {
                            $tabNumberDays[$i] = " ";
                        }
                        for ($i = $firstDayOfCurrentMonth; $i <= ($numberDays + $firstDayOfCurrentMonth - 1); $i++) {
                            $tabNumberDays[$i] = $i - $firstDayOfCurrentMonth + 1;
                        }
                        if ($totalBeginCalendar % 7 !== 0) {
                            for ($j = ($totalBeginCalendar); $j <= ($totalBeginCalendar + (7 - $totalBeginCalendar % 7)); $j++) {
                                $tabNumberDays[$j] = " ";
                            }
                        }

                        for ($i = 0; $i < ceil(count($tabNumberDays) / 7) - 1; $i++) {
                        ?>
                    <tr>
                        <?php
                            for ($j = 1; $j <= 7; $j++) {
                        ?>
                            <td class="<?= $tabNumberDays[$i * 7 + $j]  == $datasDate['mday'] ? 'fw-bold bg-info' : '' ?>"><?= $tabNumberDays[$i * 7 + $j] ?></td>
                        <?php
                            }
                        ?>
                    </tr>
                <?php
                        }

                        for ($i = ceil(count($tabNumberDays) / 7); $i < ceil(count($tabNumberDays) / 7) + 1; $i++) {
                ?>
                    <tr>
                        <?php
                            for ($j = 7; $j >= 1; $j--) {
                        ?>
                            <td class="<?= $tabNumberDays[$i * 7 - $j]  == $datasDate['mday'] ? 'fw-bold bg-info' : '' ?>"><?= $tabNumberDays[$i * 7 - $j] ?></td>
                        <?php
                            }
                        ?>
                    </tr>
                <?php
                        }
                ?>

                </tbody>
            </table>
        </div>
    </div>

<?php
}


function writeNumberVisitorsByMonth()
{
    $date = getdate();
    $dateMonth = $date['mon'];
    $month = 0;

    for ($i = 1; $i <= 12; $i++) {
        ${$month . $i} = "content/data/month" . strval($i) . ".txt";
        $date = getdate();
        $dateMonth = $date['mon'];

        if (!file_exists(${$month . $i})) {
            file_put_contents(${$month . $i}, 0);
        } else {
            if ($dateMonth === $i) {
                $number = file_get_contents(${$month . $i});
                $file = fopen(${$month . $i}, 'a');
                ftruncate($file, 0);
                fwrite($file, (int)$number + 1);
            }
        }
    }
}



function getNumberVisitorsByMonth()
{
    $month = 0;
    for ($i = 1; $i <= 12; $i++) {
        ${$month . $i} = "content/data/month" . strval($i) . ".txt";
        $number[$i] = file_get_contents(${$month . $i});
    }
    return $number;
}
