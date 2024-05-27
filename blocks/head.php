<?php
function head($head) {
    ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $head["title"]; ?></title>

            <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

            <?php
            foreach ($head["styles"] as $style) {
                ?>
                <link rel="stylesheet" href="<?php echo $style; ?>">
                <?php
            }
            foreach ($head["scripts"] as $script) {
                ?>
                <script src="<?php echo $script; ?>"></script>
                <?php
            }
            ?>
        </head>
    <?php
}