<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";

if (!isset($_GET["id"])) {
    header("Location: /pages/home.php");
    exit();
}

$userId = $_SESSION["user"]["KlantNr"];
$serieId = $_GET["id"];
echo "<script>const userId = $userId; const serieId = $serieId;</script>";

$head = new HeadComponent("Aflevering", 
                        ["/styles/global.css"], 
                        ["/script/slides.js", "/script/aflevering.js"]);

?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<?php headerBlock(); ?>
<main>
    <div id="blurBg"></div>
    <?php echo serieCard($_GET['id']); ?>

    <h2>Seizoenen</h2>

    <?php

    $seasons = fetchSqlAll("select * from seizoen where SerieID = ?", [$_GET['id']]);

    $len = strlen((string)$_GET['id']);
    $imgpath = str_repeat("0", 5 - $len) . $_GET['id'] . ".jpg";
    if (!file_exists("../img/series/images/" . $imgpath)) {
        $imgpath = "error.png";
    }


    $img = "/img/series/images/" . $imgpath;

    foreach ($seasons as $key => $season) {
        $items = [];

        $episodes = fetchSqlAll("select * from aflevering where SeizID = ?", [$season["SeizoenID"]]);

        foreach ($episodes as $episode) {
            $items[] = [
                "id" => $episode["AfleveringID"],
                "title" => $episode["AflTitel"],
                "img" => $img,
                "link" => "/pages/aflevering.php?id=" . $episode["AfleveringID"]
            ];
        }

        echo "<h3>Seizoen " . $key + 1 . "</h3>";
        scrollableList($items);
        
    }

    ?>


</main>
<?php footer(); ?>
</body>