<?php
    // On *require* le tableau avec les infos du livre
    // We *require* the info of the book's table 
    require('multidimensional-catalog.php');
    /***************************************************
    *   fonction affichant   *   function displaying   *
    *   les lives et infos   *   lives and infos       *
    ***************************************************/
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
    /********************************************************************
    *   fonction affichant :        *   function displaying:            *
    *   - l'image du livre          *   - the image of the book         *
    *   - les informations          *   - information                   *
    *   - Le prix et sa eéduction   *   - The price and its reduction   *
    ********************************************************************/
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
    /****************************************************************
    *   fonction formate le prix   *   function formats the price   *
    *   selon la devise            *   to currency                  *
    ****************************************************************/
    function priceForDevise($price) {
        $numberComma = $price / 100;
        $int = floor($numberComma);
        $float = explode(".", strval(round($numberComma - floor($numberComma), 2)))[1];
        if (strlen($float) === 1) {
            $float = $float * 10;
        }
        $numberComma = $int.",".$float;
        return $numberComma;
    }
    /******************************************************
    *   fonction affichant un   *   function displaying   *
    *   tableau                 *   a table               *
    *   ( le formulaire )       *   (the form)            *
    ******************************************************/
    function popBooksOnArray($books){
        $id = 0;
        foreach ($books as $key => $book){
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
    /*******************************************************
    *   fonction calculant le   *   function calculating   *
    *   pourcetage de           *   the reduction          *
    *   reduction               *   percentage             *
    ********************************************************/
    function priceDiscount($price, $discount) {
        $numberComma = $price / 100;
        if ( $discount != null ) {

            $original = literalResult($price, $numberComma);
            $int = intval($original);
            $float = substr(explode(",", $original)[1],0,2);
            $numberComma = $int.".".$float;
            $discounted = $numberComma * $discount / 100;

            $intDiscount = floor($discounted);
            $floatDiscount = substr(explode(".", strval($discounted))[1],0,2);
            $discounted = $intDiscount.".".$floatDiscount;
            $numberComma = $price / 100 - $discounted;

            $priceInt = intval($numberComma);

            $float = substr(explode(",", $numberComma)[1],0,2);
            if ( strlen($float) === 2 ) {
                $float;
            }
            else if ( strlen($float) === 0 ) {
                $float = "00";
            }
            else if (strlen($float) === 1 && substr($priceInt,-1) === "0" ) {
                $float = $float."0";
            }

            return literalResult($int.$float, $numberComma);
        }
        else {
            return literalResult($price, $numberComma);
        }
    }
    /************************************************
    *   fonction inutile   *   useless's function   *
    ************************************************/
    function literalResult($priceInt, $number){
        $int = floor($number);
        $float = substr(explode(".", strval($number))[1],0,2);
        //$float = explode(".", strval(round($numberComma - floor($numberComma), 2)))[1];
        if ( strlen($float) === 2 ) {
            $number = $int.",".$float;
        }
        else if ( strlen($float) === 0 ) {
            $number = $int.",00";
        }
        else if (strlen($float) === 1 && substr($priceInt,-1) === "0" ) {
                $number = $int.",".$float."0";
        }
        return $number;
    }
    /*************************************************
    *   fonction calcule de   *   fVAT calculation   *
    *   TVA                   *   function           *
    *************************************************/
    function calculHT ($price, $tva) {
        return (100*$price) / (100+$tva);
    }
    /********************************************************
    *   fonction calcule du   *   function calculates       *
    *   prix TTC              *   the price including tax   *
    ********************************************************/
    function calculTVA($price) {
        $newPrice = ( $price - calculHT($price, 20))*100;
        return priceForDevise($newPrice);
    }
    // echo calculHT(100, 20);
    // echo calculTVA(100);
    /********************************************************
    *   fonction calcule du   *   function calculates       *
    *   prix TTC              *   the price including tax   *
    ********************************************************/
    function popBuyBooks($books, $choice){
        $id = 0;
        foreach ($books as $key => $book){
            echo $key."<br>";
        }
        foreach ($choice as $key => $book){
            $id++;
            echo $books[$key];
            
            echo '<tr>';
                echo '<th scope="row">'.$id.'</th>';
                echo '<td><a href="#" class="text-danger"><i class="ri-delete-bin-3-line"></i></a></td>';
                //echo '<td>'.$book['name'].'</td>';
                echo '<td>';
                    echo'<div class="form-group mb-0">';
                        echo "<p> test : ".$books["$key"]."<p>";
                    echo '</div>';
                echo '</td>';
               // echo '<td>'.priceDiscount($book['price'], $book['discount']).' €</td>';
                echo '<td class="text-right">0.00 €</td>';
            echo '</tr>';
        }
    }
?>