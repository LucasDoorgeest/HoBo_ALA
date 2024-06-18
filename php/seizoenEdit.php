<?php
include_once 'basicIncludes.php';
include_once 'adminOnly.php';

function handleSeizoenEditRequest($GET) {
    $id = $GET["id"];
    $IMDBRating = $GET["IMDBRating"];

    if ($GET["submit"] == "Seizoen verwijderen") {
        $query = "SELECT * FROM aflevering WHERE SeizID = ?";
        $result = fetchSqlAll($query, [$id]);

        if (count($result) > 0) {
            echo "<script>alert('Er zijn nog afleveringen in dit seizoen.');</script>";
            return;
        }

        $serieQuery = "SELECT SerieID FROM seizoen WHERE SeizoenID = ?";
        $serieID = fetchSql($serieQuery, [$id])["SerieID"];

        $query = "DELETE FROM seizoen WHERE SeizoenID = ?";
        runSql($query, [$id]);
        header("Location: editSerie.php?id=$serieID");
    }

    for ($i = 0; $i < count($GET["AflTitel"]); $i++) {
        $aflevering = [
            "AfleveringID" => $GET["afleveringID"][$i],
            "AflTitel" => $GET["AflTitel"][$i],
            "Duur" => $GET["Duur"][$i],
            "delete" => $GET["delete"][$i] == "1"
        ];

        if ($aflevering["delete"]) {
            $deleteGeschiedenis = "DELETE FROM stream WHERE AflID = ?";
            runSql($deleteGeschiedenis, [$aflevering["AfleveringID"]]);


            $query = "DELETE FROM aflevering WHERE AfleveringID = ?";
            runSql($query, [$aflevering["AfleveringID"]]);

            print_r($aflevering);
            continue;
        }
        $query = "UPDATE aflevering SET AflTitel = ?, Duur = ? WHERE AfleveringID = ?";
        runSql($query, [$aflevering["AflTitel"], $aflevering["Duur"], $aflevering["AfleveringID"]]);
    }

    $query = "UPDATE seizoen SET IMDBRating = ? WHERE SeizoenID = ?";
    runSql($query, [$IMDBRating, $id]);

    header("Location: editSeizoen.php?id=$id");
}