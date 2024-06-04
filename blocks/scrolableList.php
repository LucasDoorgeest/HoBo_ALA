<?php
function scrolableList($items) {
    if ($items == null) {
        $items = [
            [
                "id" => 1,
                "title" => "The Shawshank Redemption",
                "img" => "/img/bg/00006.jpg",
            ],
            [
                "id" => 2,
                "title" => "The Godfather",
                "img" => "/img/bg/00006.jpg",
            ],
            [
                "id" => 3,
                "title" => "The Dark Knight",
                "img" => "/img/bg/00006.jpg",
            ]
            ];
    }
    ?>

    <section class="seriesList blueBox">
        <div class="scrollableWrap">
            <?php

            foreach ($items as $item) {
                ?>
                <div class="scrollableCard">
                    <img class="scrolableImg" src="/img/bg/00006.jpg" >


                </div>
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

