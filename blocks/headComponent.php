<?php

class HeadComponent {
    private $title;
    private $description;
    private $styles;
    private $scripts;

    public function __construct($title, $styles = [], $scripts = [], $description = "") {
        $this->title = $title;
        $this->description = $description;
        $this->styles = $styles;
        $this->scripts = $scripts;
    }

    public function render() {
        ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $this->title ?></title>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

            <?php
            foreach ($this->styles as $style) {
                ?>
                <link rel="stylesheet" href="<?php echo $style; ?>">

                <?php
            }
            foreach ($this->scripts as $script) {
                ?>
                <script src="<?php echo $script; ?>"></script>
                
                <?php
            }
            ?>
        </head>
        <?php
    }

}