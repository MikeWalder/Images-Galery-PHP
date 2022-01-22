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

function addToTable($name, $descr, $format, $size, $favorite)
{
    $name = htmlspecialchars($name);
    $descr = htmlspecialchars($descr);
    $favorite = 0;

    $pdo = connexionDB();
    $request = $pdo->prepare('INSERT INTO tabimages (nameImg, descr, format, size, favorite) VALUES (:nameImg, :descr, :format, :size, :favorite)');
    $request->execute(array(
        'nameImg' => ucfirst($name),
        'descr' => ucfirst($descr),
        'format' => $format,
        'size' => $size,
        'favorite' => $favorite
    ));

    echo "<div class='container mt-3'>
            <div class='row'>
                <div class='col-md-2'></div>
                <div class='col-md-8 text-center alert alert-success'>
                    Les informations ont été ajoutées !
                </div>
                <div class='col-md-2'></div>
            </div>
        </div>";
}

function modifIntoTable($identification)
{
}
