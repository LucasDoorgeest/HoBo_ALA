<?php
include_once '../php/basicIncludes.php';

$head = new HeadComponent(
    "Home",
    ["/styles/global.css"],
    ["/script/slides.js", "/script/custombg.js"]
);



?>
<!DOCTYPE html>
<html lang="nl">
<?php $head->render() ?>


<body>
    <?php headerBlock(); ?>
    <main>
        <div id="blurBg"></div>


        <section>
            <h2>Todays topper</h2>
            <?php
            $randInt = rand(1, 500);
            serieCard($randInt);
            ?>
        </section>
        <section>
            <h2>Laats gekeken</h2>
            <?php
            $items = getHistory($_SESSION["user"]["KlantNr"]);
            $cards = [];

            foreach ($items as $key => $item) {

                $len = strlen((string) $item["SerieID"]);
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
        </section>


        <section>
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

                $len = strlen((string) $item["SerieID"]);
                $imgpath = str_repeat("0", 5 - $len) . $item["SerieID"] . ".jpg";
                if (!file_exists("../img/series/images/" . $imgpath)) {
                    $imgpath = "error.png";
                }

                $cards[] = [
                    "title" => $item["SerieTitel"],
                    "img" => "/img/series/images/" . $imgpath,
                    "link" => "/pages/serie.php?id=" . $item["SerieID"]
                ];


            }

            scrollableList($cards);
            ?>
        </section>

    </main>

    <?php footer(); ?>
</body>

</html>