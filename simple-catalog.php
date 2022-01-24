<?php
    echo"Tableau original :<br>";
    $products = ["Necronomicon", "The Thing on the Doorstep", "The Call of Cthulhu"];
    print_r($products);
    echo"<br><br>Par ordre alphabétique croissant :<br>";
    $order = sort($products);
    print_r($products);
    echo"<br><br>Premier élément :<br>";
    print_r($products[0]);
    echo"<br><br>Dernier élément :<br>";
    print_r($products[count($products)-1]);
?>