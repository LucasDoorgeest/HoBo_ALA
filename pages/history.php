<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";

$head = new HeadComponent(
    "History",
    ["/styles/global.css"],
    ["/script/slides.js", "/script/aflevering.js", "/script/lazyLoad.js", "/script/custombg.js"]
);

if (isset($_GET["clearHistory"])) {
    execSql("DELETE FROM stream WHERE KlantID = ?", [$_SESSION["user"]["KlantNr"]]);

    header("Location: /pages/history.php");
}

function calcDuration($items) {
    $totalSeconds = 0;
    foreach ($items as $item) {
        $startSeconds = strtotime($item['d_start']);
        $endSeconds = strtotime($item["d_eind"]);
        
        $totalSeconds += $endSeconds - $startSeconds;
    }
    
    $hours = floor($totalSeconds / 3600);
    $minutes = floor(($totalSeconds % 3600) / 60);
    $seconds = $totalSeconds % 60;
    
    $durationString = "";

    if ($hours > 0) {
        $durationString .= $hours . "h ";
    }
    if ($minutes > 0) {
        $durationString .= $minutes . "m ";
    }
    if ($seconds > 0) {
        $durationString .= $seconds . "s";
    }

    return $durationString;
}
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
        $items = getHistory($_SESSION["user"]["KlantNr"]);

        $todayDate = new DateTime();
        $todayDate->setTime(0, 0, 0);

        $todayDuration = [];
        $lastWeekDuration = [];
        $lastMonthDuration = [];
        $earlierDuration = [];
        foreach ($items as $key => $item) {
            $todayDate = new DateTime();
            $todayDate->setTime(0, 0, 0);

            $date = new DateTime($item["d_eind"]);
            $date->setTime(0, 0, 0);

            if ($date == $todayDate) {
                $todayDuration[] = $item;
            } else if ($date > $todayDate->sub(new DateInterval("P7D"))) {
                $lastWeekDuration[] = $item;
            } else if ($date > $todayDate->sub(new DateInterval("P30D"))) {
                $lastMonthDuration[] = $item;
            } else {
                $earlierDuration[] = $item;
            }
        }

        $earlierDuration = calcDuration(array_merge($todayDuration, $lastWeekDuration, $lastMonthDuration, $earlierDuration));
        $lastMonthDuration = calcDuration(array_merge($todayDuration, $lastWeekDuration, $lastMonthDuration));
        $lastWeekDuration = calcDuration(array_merge($todayDuration, $lastWeekDuration));
        $todayDuration = calcDuration($todayDuration);

        $items = getFilteredHistory($_SESSION["user"]["KlantNr"]);

        $today = [];
        $lastWeek = [];
        $lastMonth = [];
        $earlier = [];

        foreach ($items as $key => $item) {
            $todayDate = new DateTime();
            $todayDate->setTime(0, 0, 0);

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

        renderHistoryItems("Today: " . $todayDuration, $today);
        renderHistoryItems("This week: " . $lastWeekDuration, $lastWeek);
        renderHistoryItems("This month: " . $lastMonthDuration, $lastMonth);
        renderHistoryItems("Earlier: " . $earlierDuration, $earlier);

        if (empty($items)) {
            echo "<p>No history found</p>";
        } else { ?>
            <form action="">
            <input name="clearHistory" class="button buttonred" type="submit" value="Clear history">
            </form>
        <?php }
        ?>
    </main>
    <?php FooterComponent::render(); ?>
</body>
</html>