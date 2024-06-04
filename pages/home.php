<?php
include "../blocks/head.php";
include "../blocks/header.php";
include "../blocks/seriesCard.php";
include "../blocks/scrolableList.php";
include "../blocks/footer.php";
include "../php/getHistory.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="nl">
<?php head([
    "title" => "Home",
    "styles" => ["/styles/global.css"],
    "scripts" => ["/script/slides.js"]
]); ?>
<body>
    <?php headerBlock(); ?>
    <main>
        <div id="blurBg"></div>

        <h2>Todays topper</h2>
        <?php 
            $randInt = rand(1, 500);
        
            seriesCard($randInt); 
            //seriesCard(84); 
        ?>

        <h2>Laats gekeken</h2>
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



        <h2>Je favoriete genre toppers</h2>

        <?php

        $query = "
            select * from serie 
            inner join serie_genre on serie.SerieID = serie_genre.SerieID
            where GenreID = ?
            ;
        ";
        $items = fetchSqlAll($query, [$_SESSION["user"]["Genre"]]);

        $cards = [];

        foreach ($items as $key => $item) {

            $len = strlen((string)$item["SerieID"]);
            $imgpath = str_repeat("0", 5 - $len) . $item["SerieID"] . ".jpg";
            if (!file_exists("../img/series/images/" . $imgpath)) {
                $imgpath = "error.png";
            }


        }

        scrolableList($cards);
        ?>  
        
    </main>

    <?php footer(); ?>
</body>
</html>