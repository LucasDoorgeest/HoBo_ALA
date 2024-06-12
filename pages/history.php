<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";

$head = new HeadComponent(
    "History",
    ["/styles/global.css"],
    ["/script/slides.js", "/script/aflevering.js", "/script/lazyLoad.js", "/script/custombg.js"]
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

        <h1>History</h1>

        <?php
        $items = getFilteredHistory($_SESSION["user"]["KlantNr"]);

        $today = [];
        $lastWeek = [];
        $lastMonth = [];
        $earlier = [];

        $todayDate = new DateTime();
        $todayDate->setTime(0, 0, 0);

        foreach ($items as $key => $item) {
            $date = new DateTime($item["d_eind"]);
            $date->setTime(0, 0, 0);

            if ($date == $todayDate) {
                $today[] = $item;
            } else if ($date > $todayDate->sub(new DateInterval("P7D"))) {
                $lastWeek[] = $item;
            } else if ($date > $todayDate->sub(new DateInterval("P30D"))) {
                $lastMonth[] = $item;
            } else {
                $earlier[] = $item;
            }
        }

        renderHistoryItems("Today", $today);
        renderHistoryItems("This week", $lastWeek);
        renderHistoryItems("This month", $lastMonth);
        renderHistoryItems("Earlier", $earlier);


        ?>

    </main>
    <?php FooterComponent::render(); ?>
</body>
</html>