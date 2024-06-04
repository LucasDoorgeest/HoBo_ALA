<?php
include "../blocks/head.php";
include "../blocks/header.php";
include "../blocks/seriesCard.php";
include "../blocks/scrolableList.php";
include "../blocks/footer.php";

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

            echo $randInt;
        
            seriesCard($randInt); 
            //seriesCard(84); 
        ?>

        <h2>Laats gekeken</h2>
        <?php scrolableList(
            [
                "id" => 1,
                "title" => "The Shawshank Redemption",
                "description" => "Two imprisoned)"
            ]) ?>
        <?php scrolableList(
            [
                "id" => 1,
                "title" => "The Shawshank Redemption",
                "description" => "Two imprisoned)"
            ]) ?>     
        <?php scrolableList(
            [
                "id" => 1,
                "title" => "The Shawshank Redemption",
                "description" => "Two imprisoned)"
            ]) ?>     
    </main>

    <?php footer(); ?>
</body>
</html>