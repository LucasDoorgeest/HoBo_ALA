<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";

$head = new HeadComponent(
    "History",
    ["/styles/global.css"],
    ["/script/slides.js", "/script/aflevering.js"]
);

// TODO: Create a grid of cards with the series that the user has watched
// TODO: Create a card block
// TODO: create a function to convert id to img path
?>


<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>

<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <div id="blurBg"></div>
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
    </main>
    <?php FooterComponent::render(); ?>
</body>
</html>