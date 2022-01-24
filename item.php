<?php
    $nom = "Necronomicon";
    $prix = 66.60;
    $img = "https://universoabierto.com/wp-content/uploads/2021/02/necronomicon.jpg";
    
    include "header.php";
    echo "<h1>$nom</h1>";
    echo "<p>$prix €</p>";
    echo "<img src=\"$img\" alt=\"Necronomicon\" width=\"222\">";
    include "header.php";
?>