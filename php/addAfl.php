<?php
include_once 'basicIncludes.php';
include_once 'adminOnly.php';

$AflTitel = $_GET["AflTitel"];
$Duur = $_GET["Duur"];
$SeizoenID = $_GET["SeizoenID"];
$Rang = $_GET["Rang"];

$query = "INSERT INTO aflevering (AflTitel, Duur, SeizID, Rang) VALUES (?, ?, ?, ?)";
runSql($query, [$AflTitel, $Duur, $SeizoenID, $Rang]);

header("Location: ../pages/editSeizoen.php?id=$SeizoenID");
?>