<?php
function head($head) {
    ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $head["title"]; ?></title>
            <meta name="description" content="ALA, Hobo">
            <meta name="author" content="Lucas, Volodymyr">
            <meta name="keywords" content="">
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
            <link id="favicon" rel="shortcut icon" type="image/png" href="../img/logo_small.png">

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