<?php
include_once 'basicIncludes.php';

function handleSeizoenEditRequest($GET) {
    $id = $GET["id"];
    $IMDBRating = $GET["IMDBRating"];

    for ($i = 0; $i < count($GET["AflTitel"]); $i++) {
        $aflevering = [
            "AfleveringID" => $GET["afleveringID"][$i],
            "AflTitel" => $GET["AflTitel"][$i],
            "Duur" => $GET["Duur"][$i]
        ];

        $query = "UPDATE aflevering SET AflTitel = ?, Duur = ? WHERE AfleveringID = ?";
        runSql($query, [$aflevering["AflTitel"], $aflevering["Duur"], $aflevering["AfleveringID"]]);
    }
    
    $query = "UPDATE seizoen SET IMDBRating = ? WHERE SeizoenID = ?";
    runSql($query, [$IMDBRating, $id]);

    header("Location: editSeizoen.php?id=$id");
}
?>