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
            <link rel=\"icon\" type=\"image/svg\" href=\"".$this->root."assets/images/booknav-favicon.svg\">
            <link rel=\"stylesheet\" href=\"".$this->root."assets/bootstrap/css/bootstrap.css\">
            <link rel=\"stylesheet\" href=\"".$this->root."assets/bootstrap/icons/font/bootstrap-icons.css\">
            <link rel=\"stylesheet\" href=\"".$this->root."assets/css/main.css\">
            <script src=\"".$this->root."assets/bootstrap/js/bootstrap.js\" defer></script>
            <script src=\"".$this->root."assets/bootstrap/js/popper.min.js\"></script>
            <title>".$this->name."</title>
        </head>
    ";
?>