<?php
function seriesCard($series) {
    $series = [
        "id" => 1,
        "title" => "The Shawshank Redemption",
        "description" => "After crash-landing on an alien planet, the Robinson family fight against all odds to survive and escape, but they're surrounded by hidden dangers.",
        "image" => "/img/bg/00006.jpg",
        "years" => [
            "begin" => 1994,
            "end" => 1994
        ],
        "duration" => "2h 22min",
        "age" => "16+",
        "seasons" => 1,
        "episodes" => 1,
        "genre" => "Drama",
        "creators" => "Frank Darabont",
        "rating" => 9.3
    ]
    ?>
    <article class="seriesCard">
        <section class="cardHeading">
            <section class="titleWrap">
                <section class="title">
                    <h2 class="seriesTitle"><?php echo $series["title"]; ?></h2>
                    <section class="undertitleinfoWrap">
                        <span class="years"><?php echo $series["years"]["begin"] . " - " . $series["years"]["end"]?$series["years"]["end"]:"nu"; ?></span>
                        <span class="dividor"> | </span>
                        <span class="duration"><?php echo $series["duration"]; ?></span>
                        <span class="dividor"> | </span>
                        <span class="age"><?php echo $series["age"]; ?></span>
                    </section>
                </section>
                <button class="likeButton">    
                    <img class="likeIcon" src="/images/like.svg" alt="Like icon" >
                </button>
            </section>

            <section class="rating">
                <p>IMDb Rating:</p>
                <p class="rating-score"><?php echo $series["rating"]; ?></p>
            </section>

        </section>
        <table class="moreinfoWrap">
            <tr>
                <td>Seasons:</td>
                <td><?php echo $series["seasons"]; ?></td>
            </tr>
            <tr>
                <td>Episodes:</td>
                <td><?php echo $series["episodes"]; ?></td>
            </tr>
            <tr>
                <td>Genre:</td>
                <td><?php echo $series["genre"]; ?></td>
            </tr>
            <tr>
                <td>Creators:</td>
                <td><?php echo $series["creators"]; ?></td>
            </tr>
        </table>
            



        <img class="seriesImg" src="<?php echo $series["image"]; ?>" alt="<?php echo $series["title"]; ?>">


        <p class="seriesDescription"><?php echo $series["description"]; ?></p>


        <section class="imgs">
            <div class="scrolableWrap">
                <img class="scrolableImg" src="/img/Rectangle 19.png" alt="The Shawshank Redemption">
                <img class="scrolableImg" src="/img/Rectangle 20.png" alt="The Shawshank Redemption">
                <img class="scrolableImg" src="/img/Rectangle 21.png" alt="The Shawshank Redemption">
                <img class="scrolableImg" src="/img/Rectangle 19.png" alt="The Shawshank Redemption">
                <img class="scrolableImg" src="/img/Rectangle 20.png" alt="The Shawshank Redemption">
                <img class="scrolableImg" src="/img/Rectangle 21.png" alt="The Shawshank Redemption">
            </div>

            <button class="leftArrow">
                <p><</p>
            </button>
            <button class="rightArrow">
                <p>></p>
            </button>
        </section>


        
    </article>
    <?php
}