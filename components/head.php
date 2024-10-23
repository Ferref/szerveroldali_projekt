<?php
    //
    // Az $element változón keresztül éri el a komponens tartalmát a `generate.php`.
    // A fájlban kezelhetők a Generate osztály változói ($this->...)
    //
    //echo $this->root."bootstrap/css/bootstrap.css";
    $element =  "
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <link rel=\"icon\" type=\"image/svg\" href=\"".$this->root."media/images/booknav-favicon.svg\">
            <link rel=\"stylesheet\" href=\"".$this->root."bootstrap/css/bootstrap.css\">
            <link rel=\"stylesheet\" href=\"".$this->root."bootstrap/icons/font/bootstrap-icons.css\">
            <link rel=\"stylesheet\" href=\"".$this->root."css/main.css\">
            <script src=\"".$this->root."bootstrap/js/bootstrap.js\" defer></script>
            <script src=\"".$this->root."bootstrap/js/popper.min.js\"></script>
            <title>".$this->name."</title>
        </head>
    ";
?>