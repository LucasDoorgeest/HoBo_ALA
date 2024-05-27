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


$series = fetchSqlAll("SELECT * FROM serie");
?>


<!DOCTYPE html>
<html lang="nl">
<?php head($head); ?>

<?php headerBlock(); ?>

<main>
    <div id="blurBg"></div>
    <section class="search">
        <form action="/pages/search.php" method="get">
            <input type="text" name="search" id="search" placeholder="Search">
            <button type="submit">Search</button>
        </form>
    </section>
    

    <?php

    foreach ($series as $serie) {
        $id = $serie["SerieID"];
        $len = strlen((string)$id);

        $imgpath = str_repeat("0", 5 - $len) . $id;
        ?>

        <section>
        

            <p>ID: <?php echo $serie["SerieID"] ?></p>
            <p>Name: <?php echo $serie["SerieTitel"] ?></p>
            <img src="/img/series/images/<?php echo $imgpath ?>.jpg" alt="">
        </section>


        <?php
    }

    ?>
</main>