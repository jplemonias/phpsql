<?php
    $products = ["Necronomicon", "The Thing on the Doorstep", "The Call of Cthulhu"];

    echo"Tableau original :<br>";
    print_r($products);

    echo"<br><br>Par ordre alphabétique croissant :<br>";
    sort($products);
    print_r($products);

    echo"<br><br>Premier élément :<br>";
    print_r($products[0]);
    
    echo"<br><br>Dernier élément :<br>";
    print_r($products[count($products)-1]);
?>