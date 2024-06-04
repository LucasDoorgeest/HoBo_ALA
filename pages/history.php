<?php
require_once "../blocks/head.php";
require_once "../blocks/header.php";
require_once "../blocks/footer.php";

require_once "../php/getHistory.php";
require_once "../blocks/scrolableList.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$head = [
    "title" => "History",
    "styles" => ["/styles/global.css"],
    "scripts" => []
];
$series = [];

if (!isset($_SESSION["user"])) {
    header("Location: /pages/login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="nl">
<?php head($head); ?>

<?php headerBlock(); ?>

<main>
    <div id="blurBg"></div>
    <?php 
        $items = getHistory($_SESSION["user"]["KlantNr"]);
        $cards = [];

        foreach ($items as $key => $item) {

            $len = strlen((string)$item["SerieID"]);
            $imgpath = str_repeat("0", 5 - $len) . $item["SerieID"] . ".jpg";
            if (!file_exists("../img/series/images/" . $imgpath)) {
                $imgpath = "error.png";
            }



            $cards[] = [
                "title" => $item["SerieTitel"],
                "img" => "/img/series/images/" . $imgpath,
                "link" => "/pages/aflevering.php?id=" . $item["AfleveringID"]
            ];
        }

        scrolableList($cards);
    
    
    ?>


</main>