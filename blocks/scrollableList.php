<?php
function scrollableList($heading, $items) {
    if (count($items) === 0) {
        return;
    }

    foreach ($items as $key => $item) {
        if (isset($item["id"])) break;

        if (!isset($item["SerieID"])) {
            $items[$key]["SerieID"] = getSerieIdByAflId($item["AflID"]);
            $items[$key]["SerieTitel"] = $item["AflTitel"];
            $items[$key]["link"] = "/pages/aflevering.php?id=" . $item["AflID"];
            $items[$key]["title"] = $item["AflTitel"];
        } else {
            $items[$key]["link"] = "/pages/serie.php?id=" . $item["SerieID"];
            $items[$key]["title"] = $item["SerieTitel"];
        }
        $items[$key]["img"] = getImgPathBySerieId($item["SerieID"]);
    }

    ?>
    <section>
        <h2><?php echo $heading ?></h2>
        <section class="seriesList blueBox">
            <div class="scrollableWrap">
                <?php

                foreach ($items as $item) {
                    ?>
                    <a href="<?php echo $item["link"] ?>">
                        <div class="scrollableCard">
                            <img class="scrollableImg bgsupport" src="<?php echo $item["img"] ?>" alt="<?php echo $item["title"] ?>">
                            <p><?php echo $item["title"] ?></p> 


                        </div>
                    </a>
                    <?php
                }
                ?>
                
            </div>

            <button class="leftArrow arrow">
                <p><</p>
            </button>
            <button class="rightArrow arrow">
                <p>></p>
            </button>


        </section>
    </section>
    <?php
}

