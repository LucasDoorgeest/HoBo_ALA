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
            <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">     
            <title><?php echo $this->title ?></title>
            <meta name="description" content="ALA, Hobo">
            <meta name="author" content="Lucas, Volodymyr">
            <meta name="keywords" content="">
            <title><?php echo $this->title ?></title>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
            <link id="favicon" rel="shortcut icon" type="image/png" href="/img/logo_small.png">

            <link rel="stylesheet" href="/font/stylesheet.css">

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