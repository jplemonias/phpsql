<?php
    require('multidimensional-catalog.php');
    
    function popBooks($books){
        asort($books);
        foreach ($books as $key => $book){
                echo "<div class=\"col\">";
                    echo "<div class=\"card h-100\">";
                        echo printImg($book);
                        echo "<div class=\"card-body\">";
                        echo printInfosBooks($book);
                        echo "</div>";
                        echo "<div class=\"card-footer\">";
                            echo printPrice($book);
                        echo "</div>";
                    echo "</div>";
                    // print calculHT($book['price']/100, 20);
                    // echo "\t";
                    // print calculTVA($book['price']/100);
                echo "</div>";
        }
    }

    function printImg($book) {
        echo '<img width="100%" src='.$book['picture_url'].' class="card-img-top" alt="Cover :'.$book['name'].'">';
    }
    
    function printInfosBooks($book) {
        echo '<h5 class="card-title">'.$book['name'].'</h5>';
        echo '<p class="card-text">'.$book['summary'].'</p>';
        if ( $book['discount'] != null) {
            echo '<small class="badge rounded-pill bg-success">discount : '.$book['discount'].'%</small>';
        }
    }
    
    function printPrice($book) {
        $price = priceForDevise($book['price'], $book['discount']);
        if ( $book['discount'] != null) {
            $priceDiscount = priceDiscount($book['price'], $book['discount']);
            return '<small class="text-muted"><del>'.$price.'</del> € => '.$priceDiscount.' €</small>';
        }
        else {
            return '<small class="text-muted">'.$price.' €</small>';
        }
    }
    
    function priceForDevise($price) {
        $numberComma = $price / 100;
        $int = floor($numberComma);
        $float = explode(".", strval(round($numberComma - floor($numberComma), 2)))[1];
        if (strlen($float) === 1) {
            if (strlen($float) === 1 && substr($price,-1) === "0" ) {
                $float = $float * 10;
            }
            else {
                $float = "0".$float;
            }
        }
        $numberComma = $int.",".$float;
        return $numberComma;
    }

    function popBooksOnArray($books){
        asort($books);
        $id = 0;
        foreach ($books as $book){
            $id++;
            echo '<tr>';
                echo '<th scope="row">'.$id.'</th>';
                echo '<td><a href="#" class="text-danger"><i class="ri-delete-bin-3-line"></i></a></td>';
                echo '<td>'.$book['name'].'</td>';
                echo '<td>';
                    echo'<div class="form-group mb-0">';
                        echo '<input type="number" class="form-control cart-qty"  name="priceBook'.$id.'" id="priceBook'.$id.'" value="0">';
                    echo '</div>';
                echo '</td>';
                echo '<td>'.priceDiscount($book['price'], $book['discount']).' €</td>';
                echo '<td class="text-right">0.00 €</td>';
            echo '</tr>';
        }
    }

    function priceDiscount($price, $discount) {
        $numberComma = $price / 100;
        if ( $discount != null ) {

            $original = literalResult($price, $numberComma);
            $int = intval($original);
            echo "test : ".strval($original)."<br>";
            echo "true : ".stristr(strval($original), ',')."<br>";
            if(stristr(strval($original), '.') === TRUE) {
                $float = substr(explode(".", strval($original))[1],0,2);
                echo $float;
            }
            else {$float = "00";
                echo $float;
            }
            $numberComma = $int.".".$float;
            echo $numberComma;
            $discounted = $numberComma * $discount / 100;

            $intDiscount = floor($discounted);
            $floatDiscount = substr(explode(".", strval($discounted))[1],0,2);
            $discounted = $intDiscount.".".$floatDiscount;
            $numberComma = $price / 100 - $discounted;

            $priceInt = intval($numberComma);


            if(stristr(strval($numberComma), ',') === TRUE) {
                $float = substr(explode(",", $numberComma)[1],0,2);
                if ( strlen($float) === 2 ) {
                    $float;
                }
                else if (strlen($float) === 1 && substr($priceInt,-1) === "0" ) {
                    $float = $float."0";
                }
                else {
                    $float = "0".$float;
                }
            }
            else{
                $float = "00";
            }
            return literalResult($int.$float, $numberComma);
        }
        else {
            return literalResult($price, $numberComma);
        }
    }

    function literalResult($priceInt, $number){
        $int = floor($number);
        if(stristr(strval($number), '.') !== TRUE) {
            $float = substr(explode(".", strval($number))[1],0,2);
            //$float = explode(".", strval(round($numberComma - floor($numberComma), 2)))[1];
            if ( strlen($float) === 2 ) {
                $number = $int.",".$float;
            }
            else if (strlen($float) === 1 && substr($priceInt,-1) === "0" ) {
                $number = $int.",".$float."0";
            }
            else if (strlen($float) === 1 && substr($priceInt,-1) !== "0" ) {
                $number = $int.",0".$float;
            }
        }
        else {
            $number = "$int,00";
        }
        return $number;
    }
    
    function calculHT ($price, $tva) {
        return (100*$price) / (100+$tva);
    }

    function calculTVA($price) {
        $newPrice = ( $price - calculHT($price, 20))*100;
        return priceForDevise($newPrice);
    }
    // echo calculHT(100, 20);
    // echo calculTVA(100);

    function popBuyBooks($books, $choice){
        asort($books);
        $arrBooksById = [];
        $id = 0;
        foreach ($books as $key => $book){
            array_push($arrBooksById, $book);
        }
        foreach ($choice as $key => $book){
            
            echo '<tr>';
                echo '<th scope="row">'.$id.'</th>';
                echo '<td><a href="#" class="text-danger"><i class="ri-delete-bin-3-line"></i></a></td>';
                echo '<td>';
                    echo'<div class="form-group mb-0">';
                        echo "<p>".$arrBooksById[$key]['name']."<p>";
                    echo '</div>';
                echo '</td>';
                echo '<td>'.$choice[$id].'</td>';
                echo '<td>'.priceDiscount($arrBooksById[$id]['price'], $arrBooksById[$id]['discount']).' €</td>';
                echo '<td class="text-right">0.00 €</td>';
            echo '</tr>';
            $id++;
        }
    }
    // echo "E_ERROR: ".E_ERROR;
    // echo "<br>E_PARSE: ".E_PARSE;
    // echo "<br>E_CORE_ERROR: ".E_CORE_ERROR;
    // echo "<br>E_CORE_WARNING: ".E_CORE_WARNING;
    // echo "<br>E_COMPILE_ERROR: ".E_COMPILE_ERROR;
    // echo "<br>E_COMPILE_WARNING: ".E_COMPILE_WARNING;
    // echo "<br>E_STRICT: ".E_STRICT;
    // echo "<br>E_COMPILE_WARNING: ".E_COMPILE_WARNING;
    // function error(){
    //     set_error_handler(function($niveau, $message, $fichier, $ligne){
    //         echo 'Erreur : ' .$message. '<br>';
    //         echo 'Niveau de l\'erreur : ' .$niveau. '<br>';
    //         echo 'Erreur dans le fichier :   ' .$fichier. '<br>';
    //         echo 'Emplacement de l\'erreur : ' .$ligne. '<br>';
    //     });
    // }
    // echo $a;
    // print_r(error_get_last());
?>