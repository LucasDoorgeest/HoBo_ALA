<?php
function scrolableList($items) {
    if ($items == null) {
        $items = [
            [
                "id" => 1,
                "title" => "The Shawshank Redemption",
                "img" => "/img/bg/00006.jpg",
                "link" => "/pages/aflevering.php?id=1"
            ],
            [
                "id" => 2,
                "title" => "The Godfather",
                "img" => "/img/bg/00006.jpg",
                "link" => "/pages/aflevering.php?id=2"
            ],
            [
                "id" => 3,
                "title" => "The Dark Knight",
                "img" => "/img/bg/00006.jpg",
                "link" => "/pages/aflevering.php?id=3"
            ]
            ];
    }

    ?>

    <section class="seriesList blueBox">
        <div class="scrollableWrap">
            <?php

            foreach ($items as $item) {
                ?>
                <a href="<?php echo $item["link"] ?>">
                    <div class="scrollableCard">
                        <img class="scrolableImg" src="<?php echo $item["img"] ?>" alt="<?php echo $item["title"] ?>">
                        <p><?php echo $item["title"] ?></p> 


                    </div>
                </a>
                <?php
            }
            ?>
            
        </div>

        <button class="leftArrow">
            <p><</p>
        </button>
        <button class="rightArrow">
            <p>></p>
        </button>


    </section>
    <?php
}

