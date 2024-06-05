<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";

$head = new HeadComponent("History", 
                        ["/styles/global.css"], 
                        ["/script/slides.js", "/script/aflevering.js"]);

// TODO: Create a grid of cards with the series that the user has watched
// TODO: Create a card block
// TODO: create a function to convert id to img path

?>


<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>

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

        scrollableList($cards);
    
    
    ?>
</main>