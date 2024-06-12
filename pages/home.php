<?php
include_once '../php/basicIncludes.php';

$head = new HeadComponent(
    "Home",
    ["/styles/global.css"],
    ["/script/slides.js", "/script/custombg.js", "/script/lazyLoad.js"]
);
$randInt = rand(1, 500);
?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render() ?>
<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <div id="blurBg"></div>
        <section>
            <h2 class="heading">Dit moment topper</h2>  
            <a href="/pages/serie.php?id=<?php echo $randInt ?>">
                <?php
                serieCard($randInt);
                ?>
            </a>
        </section>

        <?php
            if (isset($_SESSION["user"])) {
                $items = getFilteredHistory($_SESSION["user"]["KlantNr"]);
                scrollableList("Laatst gekeken", $items, true);
            }
        ?>

    <?php
        if (isset($_SESSION["user"])){
            $query = "
            select * from serie 
            inner join serie_genre on serie.SerieID = serie_genre.SerieID
            where GenreID = ?
            ;
            ";
            $items = fetchSqlAll($query, [$_SESSION["user"]["Genre"]]);
            scrollableList("Je favoriete genre toppers", $items);
        }
    ?>

        <?php
            $picks = [1, 6, 12, 7, 26, 65, 66, 178, 222];
            $cards = [];

            foreach ($picks as $key => $item) {
                $query = "select * from serie where SerieID = ?;";
                $cards[] = fetchSql($query, [$item]);
            }

            scrollableList("Editor picks", $cards);

        ?>
    </main>
    <?php FooterComponent::render(); ?>
</body>
</html>