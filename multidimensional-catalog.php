<?php
    $books = [
        $necronomicon = [
            "name" => "Necronomicon",
            "price" => 6660,
            "weight" => 1870,
            "discount" => null,
            "picture_url" => "https://universoabierto.com/wp-content/uploads/2021/02/necronomicon.jpg",
        ],
        $cthulhu = [
            "name" => "The Call of Cthulhu",
            "price" => 9990,
            "weight" => 374,
            "discount" => 10,
            "picture_url" => "https://images-na.ssl-images-amazon.com/images/I/81rHR4HYYSL.jpg",
        ],
        $doorstep = [
            "name" => "The Thing on the Doorstep",
            "price" => 6660,
            "weight" => 187,
            "discount" => null,
            "picture_url" => "https://m.media-amazon.com/images/M/MV5BMjA4ODkxMzc2MV5BMl5BanBnXkFtZTgwODg3NTg2MjE@._V1_.jpg",
        ]
    ];
    foreach ($books as $key => $value){
        foreach ($value as $k => $v){
            if ( $k === "picture_url" ) {
                echo "<img src=\"$v\" alt=\"Necronomicon\" width=\"222\">";
            }
            else if ( $k === "discount") {
                    if  ($v != null ) {
                    echo "<p>$k : $v</p>";
                }
            }
            else {
                echo "<p>$k : $v</p>";
            }
        }
    }
    var_dump($books);
?>