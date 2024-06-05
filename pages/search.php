<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";

$head = new HeadComponent("Search", ["/styles/global.css"], []);

$series = [];

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $search = isset($_GET["q"]) ? $_GET["q"] : null;
    $genre = isset($_GET["genre"]) ? $_GET["genre"] : null;


    $query = "SELECT * FROM serie";
    $params = [];

    if ($genre) {
        $query .= " inner join serie_genre on serie.SerieID = serie_genre.SerieID
        WHERE GenreID = ?";
    ";";
        $params[] = $genre;
    }

    if ($search) {
        if ($genre) {
            $query .= " AND";
        } else {
            $query .= " WHERE";
        }

        $query .= " SerieTitel LIKE ?";
        $params[] = "%" . $search . "%";
    }


    $series = fetchSqlAll($query, $params);

    print($query);
    print_r($params);

}

foreach ($series as $key => $serie) {
    $series[$key]["image"] = getImgPathBySerieId($serie["SerieID"]);
}


$genres = fetchSqlAll("SELECT * FROM genre");

?>


<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>

<?php headerBlock(); ?>

<main>
    <div id="blurBg"></div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["q"])) {
        ?>

        <script>
            document.getElementById("searchText").value = "<?php echo $_GET["q"] ?>";
        </script>

        <?php
    }
    ?>

    <section id="searchHeading">
        <a href="/pages/search.php?q=<?php echo $_GET['q'] ?>">
            <button class="<?php if (!isset($_GET["genre"])) { echo "active"; } ?>">All</button>
        </a>
        <?php
            foreach ($genres as $genre) {
                ?>
                <a href="<?php echo "/pages/search.php?q=" . $_GET["q"] . "&genre=" . $genre["GenreID"] ?>">
                    <button class="<?php if (isset($_GET["genre"]) && $_GET["genre"] == $genre["GenreID"]) { echo "active"; } ?>"><?php echo $genre["GenreNaam"] ?></button>
                </a>
                <?php
            }
        ?>
    </section>

    
    <section class="searchResults">
    <?php

    foreach ($series as $serie) {

        ?>
        <a href="/pages/serie.php?id=<?php echo $serie["SerieID"] ?>">
            <section class="serieCardWrap">
                    <img src="<?php echo $serie["image"] ?>" alt="Serie image">
                    <p><?php echo $serie["SerieTitel"] ?></p>
            </section>
        </a>


        <?php
    }


    if (count($series) == 0) {
        ?>
        <h1 class="Error">Oops, niks gevonden</h1>
        <?php
    }

    ?>
    </section>
</main>