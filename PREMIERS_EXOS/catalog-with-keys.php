<?php
    $necronomicon = [
        "name" => "Necronomicon",
        "price" => 6660,
        "discount" => null,
        "summary" => "The Necronomicon, a completely fictional book mentioned in the stories of pulp horror author H.P. Lovecraft.",
        "picture_url" => "https://universoabierto.com/wp-content/uploads/2021/02/necronomicon.jpg",
    ];
    $cthulhu = [
        "name" => "The Call of Cthulhu",
        "price" => 999,
        "discount" => 10,
        "summary" => "While sorting the affairs of his late Uncle, a man accidentally stumbles across a series of dark secrets connected to an ancient horror waiting to be freed. A faithful rendition of H.P. Lovecraft's short story.",
        "picture_url" => "https://images-na.ssl-images-amazon.com/images/I/81rHR4HYYSL.jpg",
    ];
    $doorstep = [
        "name" => "The Thing on the Doorstep",
        "price" => 666,
        "discount" => null,
        "summary" => "The Thing on the Doorstep is a horror short story by American writer H. P. Lovecraft, part of the Cthulhu Mythos universe.",
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