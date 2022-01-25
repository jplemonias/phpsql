<?php
    $books = [
        $necronomicon = [
            "name" => "Necronomicon",
            "price" => 6660,
            "discount" => null,
            "summary" => "The Necronomicon, a completely fictional book mentioned in the stories of pulp horror author H.P. Lovecraft.",
            "picture_url" => "https://universoabierto.com/wp-content/uploads/2021/02/necronomicon.jpg",
        ],
        $cthulhu = [
            "name" => "The Call of Cthulhu",
            "price" => 999,
            "discount" => 10,
            "summary" => "While sorting the affairs of his late Uncle, a man accidentally stumbles across a series of dark secrets connected to an ancient horror waiting to be freed. A faithful rendition of H.P. Lovecraft's short story.",
            "picture_url" => "https://images-na.ssl-images-amazon.com/images/I/81rHR4HYYSL.jpg",
        ],
        $doorstep = [
            "name" => "The Thing on the Doorstep",
            "price" => 666,
            "discount" => null,
            "summary" => "The Thing on the Doorstep is a horror short story by American writer H. P. Lovecraft, part of the Cthulhu Mythos universe.",
            "picture_url" => "https://m.media-amazon.com/images/M/MV5BMjA4ODkxMzc2MV5BMl5BanBnXkFtZTgwODg3NTg2MjE@._V1_.jpg",
        ]
    ];
    
function popBooks($books){
    foreach ($books as $key => $value){
            echo "<div class=\"col\">";
                echo "<div class=\"card h-100\">";
                    echo printImg($value);
                    echo "<div class=\"card-body\">";
                        echo printTitle($value);
                        echo printSummary($value);
                        echo printDiscount($value);
                    echo "</div>";
                    echo "<div class=\"card-footer\">";
                        echo printPrice($value);
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        
    }
    // var_dump($books);
}

function printImg ($data) {
    foreach ($data as $k => $v){
            if ( $k === "picture_url" ) {
                return "<img width=\"100%\" src=\"$v\" class=\"card-img-top\" alt=\"Cover : $v\">";
            }
        }
}

function printTitle ($data) {
    foreach ($data as $k => $v){
            if ( $k === "name" ) {
                return "<h5 class=\"card-title\">$v</h5>";
            }
        }
}

function printSummary ($data) {
    foreach ($data as $k => $v){
            if ( $k === "summary" ) {
                return "<p class=\"card-text\">$v.</p>";
            }
        }
}

function printPrice ($data) {
    foreach ($data as $k => $v){
            if ( $k === "price" ) {
                $v = priceForDevise($v);
                return "<small class=\"text-muted\">$v €</small>";
            }
        }
}

function printDiscount ($data) {
    foreach ($data as $k => $v){
        if ( $k === "discount" ) {
            if ( $v != null) {
                return "<small class=\"badge rounded-pill bg-success\">discount : $v%</small>";
            }
        }
    }
}

function priceForDevise($data) {
        $numberComma = $data/100;
        $int = floor($numberComma);
        $float = explode(".",strval(round($numberComma - floor($numberComma), 2)))[1];
        if (strlen($float) === 1) {
            $float = $float*10;
        }
        $numberComma = $int.",".$float;
        return $numberComma;
}
?>