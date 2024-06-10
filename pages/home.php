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
                $cards[] = [
                    "title" => $item["SerieTitel"],
                    "img" => getImgPathBySerieId($item["SerieID"]),
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
                $cards[] = [
                    "title" => $item["SerieTitel"],
                    "img" => getImgPathBySerieId($item["SerieID"]),
                    "link" => "/pages/serie.php?id=" . $item["SerieID"]
                ];


            }

            scrollableList($cards);
            ?>
        </section>

        <section>
            <h2>Editor picks</h2>

            <?php
            $picks = [14, 15, 16, 17, 18];

            $cards = [];

            foreach ($picks as $key => $item) {
                $query = "select * from serie where SerieID = ?;";
                $serie = fetchSql($query, [$item]);

                $cards[] = [
                    "title" => "Serie " . $serie["SerieTitel"],
                    "img" => getImgPathBySerieId($item),
                    "link" => "/pages/serie.php?id=" . $item
                ];
            }

            scrollableList($cards);
            ?>

        </section>

    </main>

    <?php footer(); ?>
</body>

</html>