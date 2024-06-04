<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["user"])) {
    $userId = $_SESSION["user"]["KlantNr"];
    $serieId = $_GET["id"];

    echo "<script>const userId = $userId; const serieId = $serieId;</script>";

}

if (!isset($_GET["id"])) {
    header("Location: /pages/home.php");
    exit();
}

require_once "../blocks/head.php";
require_once "../blocks/header.php";
require_once "../blocks/footer.php";
require_once "../blocks/seriesCard.php";
require_once "../blocks/scrolableList.php";


require_once "../php/sqlConnect.php";
require_once "../php/sqlUtils.php";

$head = [
    "title" => "serie",
    "styles" => ["/styles/global.css"],
    "scripts" => ["/script/slides.js", "/script/serie.js"]
];

?>

<!DOCTYPE html>
<html lang="nl">
<?php head($head); ?>
<?php headerBlock(); ?>
<main>
    <div id="blurBg"></div>
    <?php echo seriesCard($_GET['id']); ?>

    <h2>Seizoenen</h2>

    <?php

    $seasons = fetchSqlAll("select * from seizoen where SerieID = ?", [$_GET['id']]);

    foreach ($seasons as $key => $season) {
        $items = [];

        $episodes = fetchSqlAll("select * from aflevering where SeizID = ?", [$season["SeizoenID"]]);

        foreach ($episodes as $episode) {
            $items[] = [
                "id" => $episode["AfleveringID"],
                "title" => $episode["AflTitel"],
                "img" => "/images/series/" . "000005.jpg", //TODO: change to actual image
                "link" => "/pages/aflevering.php?id=" . $episode["AfleveringID"]
            ];
        }

        echo "<h3>Seizoen " . $key + 1 . "</h3>";
        scrolableList($items);
        
    }

    ?>


</main>
<?php footer(); ?>
</body>