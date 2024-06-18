<?php
include_once 'basicIncludes.php';
include_once 'adminOnly.php';

function handleSerieEditRequest($GET) {
    $id = $GET["id"];
    $SerieTitel = $GET["SerieTitel"];
    $IMDBLink = $GET["IMDBLink"];


    if ($GET["submit"] == "Verwijderen") {
        $check = "SELECT * FROM seizoen WHERE SerieID = ?";
        $seizoenen = fetchSqlAll($check, [$id]);
        foreach ($seizoenen as $seizoen) {
            $query = "SELECT * FROM aflevering WHERE SeizID = ?";
            $result = fetchSqlAll($query, [$seizoen["SeizoenID"]]);

            if (count($result) > 0) {
                echo "<script>alert('Er zijn nog afleveringen in dit serie.');</script>";
                return;
            }
        }


        //Dangerous
        $query = "DELETE FROM serie_genre WHERE SerieID = ?";
        runSql($query, [$id]);

        $query = "DELETE FROM seizoen WHERE SerieID = ?";
        runSql($query, [$id]);

        $query = "DELETE FROM serie WHERE SerieID = ?";
        runSql($query, [$id]);
        header("Location: beheer.php");
    }

    if (!isset($GET["genre"])) {
        $GET["genre"] = [];
    }
    $genres = $GET["genre"];


    $query = "UPDATE serie SET SerieTitel = ?, IMDBLink = ? WHERE SerieID = ?";
    runSql($query, [$SerieTitel, $IMDBLink, $id]);

    $query = "SELECT GenreID FROM serie_genre WHERE SerieID = ?";
    $existingGenres = fetchSqlAll($query, [$id]);
    $existingGenres = array_column($existingGenres, 'GenreID');

    foreach ($genres as $genre) {
        if (!in_array($genre, $existingGenres)) {
            $query = "INSERT INTO serie_genre (SerieID, GenreID) VALUES (?, ?)";
            runSql($query, [$id, $genre]);
        }
    }

    foreach ($existingGenres as $existingGenre) {
        if (!in_array($existingGenre, $genres)) {
            $query = "DELETE FROM serie_genre WHERE SerieID = ? AND GenreID = ?";
            runSql($query, [$id, $existingGenre]);
        }
    }

    header("Location: editSerie.php?id=$id");
}
