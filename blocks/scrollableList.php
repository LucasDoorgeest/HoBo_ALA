<?php
function scrollableList($items) {
    ?>

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
    <?php
}

