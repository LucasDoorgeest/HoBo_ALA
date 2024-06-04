<?php
require_once "../blocks/head.php";
require_once "../blocks/header.php";
require_once "../blocks/footer.php";


require_once "../php/sqlConnect.php";
require_once "../php/sqlUtils.php";


$head = [
    "title" => "Search",
    "styles" => ["/styles/global.css"],
    "scripts" => []
];
$series = [];

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["q"])) {
    $search = $_GET["q"];
    $series = fetchSqlAll("SELECT * FROM serie WHERE SerieTitel LIKE ?", ["%$search%"]);
} else {
    $series = fetchSqlAll("SELECT * FROM serie");
}


//Check imgs
for ($i = 0; $i < count($series); $i++) {
    $serie = $series[$i];
    $serie["image"] = "/img/series/images/error.png";


    $id = $serie["SerieID"];
    $len = strlen((string)$id); 

    $imgpath = str_repeat("0", 5 - $len) . $id . ".jpg";
    if (!file_exists("../img/series/images/" . $imgpath)) {
        $imgpath = "error.png";
    }
    $serie["image"] = "/img/series/images/" . $imgpath;

    $series[$i] = $serie;
}

?>


<!DOCTYPE html>
<html lang="nl">
<?php head($head); ?>

<?php headerBlock(); ?>

<main>
    <div id="blurBg"></div>
    <section class="search">


    <?php
    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["q"])) {
        ?>

        <script>
            document.getElementById("searchText").value = "<?php echo $_GET["q"] ?>";
        </script>

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