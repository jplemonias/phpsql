<?php
    $necronomicon = [
        "name" => "Necronomicon",
        "price" => 66.6,
        "weight" => 1870,
        "discount" => null,
        "picture_url" => "https://universoabierto.com/wp-content/uploads/2021/02/necronomicon.jpg",
    ];
    $cthulhu = [
        "name" => "The Call of Cthulhu",
        "price" => 9.99,
        "weight" => 374,
        "discount" => 10,
        "picture_url" => "https://images-na.ssl-images-amazon.com/images/I/81rHR4HYYSL.jpg",
    ];
    $doorstep = [
        "name" => "The Thing on the Doorstep",
        "price" => 6.66,
        "weight" => 187,
        "discount" => null,
        "picture_url" => "https://m.media-amazon.com/images/M/MV5BMjA4ODkxMzc2MV5BMl5BanBnXkFtZTgwODg3NTg2MjE@._V1_.jpg",
    ];

    foreach ($necronomicon as $key => $value){
        if ( $key === "picture_url" ) {
            echo "<img src=\"$value\" alt=\"Necronomicon\" width=\"222\">";
        }
        else if ( $key === "discount") {
                if  ($value != null ) {
                echo "<p>$key : $value</p>";
            }
        }
        else {
            echo "<p>$key : $value</p>";
        }
    }

    foreach ($cthulhu as $key => $value){
        if ( $key === "picture_url" ) {
            echo "<img src=\"$value\" alt=\"Necronomicon\" width=\"222\">";
        }
        else if ( $key === "discount") {
                if  ($value != null ) {
                echo "<p>$key : $value</p>";
            }
        }
        else {
            echo "<p>$key : $value</p>";
        }
    }

    foreach ($doorstep as $key => $value){
        if ( $key === "picture_url" ) {
            echo "<img src=\"$value\" alt=\"Necronomicon\" width=\"222\">";
        }
        else if ( $key === "discount") {
                if  ($value != null ) {
                echo "<p>$key : $value</p>";
            }
        }
        else {
            echo "<p>$key : $value</p>";
        }
    }

?>