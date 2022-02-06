<?php
    // On *require* le tableau avec les infos du livre
    // We *require* the info of the book's table 
    require('multidimensional-catalog.php');
    // On *require* le tableau avec les infos de livraison
    // We *require* the info of the coast's table 
    require('livraison.php');
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
            $priceDiscount = number_format( priceDiscount($book['price'], $book['discount']), 2, ",", " ");
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
        // echo "\price\n".number_format( $discouted/100, 2, ",", " ");
        return number_format( $price/100, 2, ",", " ");
    }
    /******************************************************
    *   fonction affichant un   *   function displaying   *
    *   tableau                 *   a table               *
    *   ( le formulaire )       *   (the form)            *
    ******************************************************/
    function popBooksOnArray($books){
        asort($books);
        $id = 0;
        foreach ($books as $book){
            echo '<tr>';
                echo '<th scope="row">'.($id+1).'</th>';
                echo '<td><a href="#" class="text-danger"><i class="ri-delete-bin-3-line"></i></a></td>';
                echo '<td>'.$book['name'].'</td>';
                echo '<td>';
                    echo'<div class="form-group mb-0">';
                        echo '<input type="number" class="form-control cart-qty"  name="qtyBook'.$id.'" id="qtyBook'.$id.'" value="0">';
                    echo '</div>';
                echo '</td>';
                echo '<td id="price'.$id.'">'.number_format( priceDiscount($book['price'], $book['discount']), 2, ",", " ").' €</td>';
                echo '<td class="text-right" id="priceBookCompted'.$id.'">0.00 €</td>';
            echo '</tr>';
            $id++;
        }
    }
    /*******************************************************
    *   fonction calculant le   *   function calculating   *
    *   pourcetage de           *   the reduction          *
    *   reduction et le prix    *   percentage an the      *
    *   remisé                  *   price delivery         *
    ********************************************************/
    
    function discount($price, $discount) {
        $discount = $price*($discount/100);
        $discount = (floor($discount)/100);
        return $discount;
    }

    function priceDiscount($price, $discount) {
        $discount = discount($price, $discount);
        $price = $price/100;
        $discouted = $price - $discount;
        return $discouted;
    }
    /*************************************************
    *   fonction calcule de   *   fVAT calculation   *
    *   TVA                   *   function           *
    *************************************************/
    function calculHT ($price, $vat) {
        return (100*$price) / (100+$vat);
    }
    /********************************************************
    *   fonction calcule du   *   function calculates       *
    *   prix TTC              *   the price including tax   *
    ********************************************************/
    function calculVAT($price, $vat) {
        return ($price - calculHT($price, $vat))*100;
    }
    // echo calculHT(100, 20);
    // echo calculVAT(100);
    /********************************************************
    *   x   *   x   *
    *   x   *   x   *
    ********************************************************/
    function popBuyBooks($books, $numberSelect, $choice){
        asort($books);
        $id = 0;
        $arrBooksById = arrBooks($books);
        // $tt = totalPrice($choice, $arrBooksById);
        // $ttht = priceForDevise(round(calculVAT($tt/100, 20)));
        // $tt = priceForDevise($tt);
        foreach ($choice as $key => $number){
            if ( count($numberSelect) === 0) {
                $numberSelect = [0];
            }

            echo '<tr>';
                echo '<th scope="row"><img style="height:45px; width:fit-content" src="'.$arrBooksById[$numberSelect[$key]]['picture_url'].'" class="card-img-top" alt="Cover : '.$arrBooksById[$numberSelect[$key]]['name'].'"></th>';
                echo '<td><a href="#" class="text-danger"><i class="ri-delete-bin-3-line"></i></a></td>';
                echo '<td>';
                    echo '<div class="form-group mb-0">';
                        echo "<p>".$arrBooksById[$numberSelect[$key]]['name']."<p>";
                    echo '</div>';
                echo '</td>';
                echo '<td>'.$choice[$id].'</td>';
                if ($arrBooksById[$numberSelect[$key]]['discount'] != null) {
                    echo '<td><small class="text-muted"><del>'.number_format(($arrBooksById[$numberSelect[$key]]['price']*$number/100), 2, ",", " ").' €</del></small></td>';
                    
                }
                else {
                    echo '<td>'.number_format(($arrBooksById[$numberSelect[$key]]['price']*$number/100), 2, ",", " ").' €</td>';
                }
                echo '<td class="text-right">'.number_format(priceDiscount($arrBooksById[$numberSelect[$key]]['price'], $arrBooksById[$numberSelect[$key]]['discount'])*$number, 2, ",", " ").' €</td>';
            echo '</tr>'; 
            $id++;
        }
    }
    /********************************************************
    *   x   *   x   *
    *   x   *   x   *
    ********************************************************/
    function sendInputHidden($choice, $celected){
        echo '<input id="inputChoice" name="choice" type="hidden" value="' . implode("," ,$choice) . '">';
        echo '<input id="bookChoiced" name="bookChoiced" type="hidden" value="' . implode("," ,$celected) . '">';
    }

    function popTotalPrices($choice, $books, $selected){
        //print_r($selected);
        $arrBooksById = arrBooks($books);
        // echo phpinfo();

        $tt = totalPriceIfDiscout($choice, $arrBooksById, $selected);
        $ht = priceForDevise(floor(calculHT($tt, 20)));
        $ttht = priceForDevise(round(calculVAT($tt/100, 20)));
        $tt = priceForDevise($tt);
        // echo '<input id="inputChoice" name="choice" type="hidden" value="\''.$choice.'\'">';
        popTopPayment($ht, $ttht, $tt);
        echo "<tr>";
            echo "<td>reduction  :</td>";
            echo "<td id=\"reduc\">0,00 €</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td>Shipping costs :</td>";
            echo "<td id=\"cost\">0,00 €</td>";
        echo "</tr>";
        echo "<tr>";
            echo '<td class="f-w-7 font-18">';
                echo "<h4>Amount :</h4>";
            echo "</td>";
            echo '<td class="f-w-7 font-18">';
                echo "<h4 id=\"amount\">$tt €</h4>";
            echo "</td>";
        echo "</tr>";
    }

    function popCostTotalPrices($choice, $books, $exped, $transporters, $selected, $ship){
        echo '<input id="bookChoiced" name="exped" type="hidden" value="' .$exped. '">';
        $arrBooksById = arrBooks($books);
        $stt = totalPriceIfDiscout($choice, $arrBooksById, $selected);
        $totalCost = 0;
        $tt = $stt;
        $ht = priceForDevise(floor(calculHT($stt, 20)));
        $ttht = priceForDevise(round(calculVAT($stt/100, 20)));
        $stt = priceForDevise($stt);
        if ($transporters[$exped]['price'] !== null){
            if ($tt < $ship[1]) {
                $totalCost = floor($tt*($transporters[$exped]['price']/100));
                // echo "<5000";
            }
            else if ($tt > $ship[2]) {
                // echo ">10000";
                $totalCost = 0;
            }
            else {
                // echo "5000><10000<br>";
                $totalCost = floor(($tt*(($transporters[$exped]['price']/2)/100)));
            }
        }
        $tt = priceForDevise($tt+$totalCost);
        $totalCost = priceForDevise($totalCost);
        // echo '<input id="inputChoice" name="choice" type="hidden" value="\''.$choice.'\'">';
        popTopPayment($ht, $ttht, $stt);
        echo "<tr>";
            echo "<td>reduction  :</td>";
            echo "<td id=\"reduc\">0,00 €</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td>Shipping costs :</td>";
            echo "<td id=\"cost\">$totalCost €</td>";
        echo "</tr>";
        echo "<tr>";
            echo '<td class="f-w-7 font-18">';
                echo "<h4>Amount :</h4>";
            echo "</td>";
            echo '<td class="f-w-7 font-18">';
                echo "<h4 id=\"amount\">$tt €</h4>";
            echo "</td>";
        echo "</tr>";
    }

    function popTopPayment($ht, $ttht, $stt){
        echo "<tr>";
            echo '<td>Sub Total :</td>';
            echo "<td>$ht €</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td>Tax(20%) :</td>";
            echo "<td>$ttht €</td>";
        echo "</tr>";
        echo "<tr>";
            echo '<td class="f-w-7 font-18">';
                echo "<h4>Sub Amount :</h4>";
            echo "</td>";
            echo '<td class="f-w-7 font-18">';
                echo "<h4 id=\"subAmount\">$stt €</h4>";
            echo "</td>";
        echo "</tr>";
    }
    /********************************************************
    *   x   *   x   *
    *   x   *   x   *
    ********************************************************/
    function arrBooks($books){
        asort($books);
        $arrBooksById = [];
        foreach ($books as $book){
            array_push($arrBooksById, $book);
        }
        return $arrBooksById;
    }

    function arrTransporter($transporters){
        asort($transporters);
        $arrTransportersById = [];
        foreach ($transporters as $transporter){
            array_push($arrTransportersById, $transporter);
        }
        return $arrTransportersById;
    }
    /********************************************************
    *   x   *   x   *
    *   x   *   x   *
    ********************************************************/
    function totalPrice($choice, $books ,$choiced) {
        $tt = 0;
        foreach ($choice as $key => $numberOfBooks){
            $tt += $books[$choiced[$key]]['price']*$numberOfBooks;
        }
        return $tt;
    }

    function totalPriceIfDiscout($choice, $books, $selected) {
        $tt = 0;
        foreach ($choice as $key => $numberOfBooks){
            if ( count($selected) === 0) {
                $selected = [0];
            }
            if ($books[$selected[$key]]['discount'] != null) {
                $discounted = floor(priceDiscount($books[$selected[$key]]['price'], $books[$selected[$key]]['discount']));
                $tt += $discounted*$numberOfBooks*100;
            }
            else {
                $tt += $books[$selected[$key]]['price']*$numberOfBooks;
            }
        }
        return $tt;
    }
    /********************************************************
    *   x   *   x   *
    *   x   *   x   *
    ********************************************************/
  
    //calculShippingCosts([2,1,1], $books, 3, $transporters);
    function calculShippingCosts($choice, $books ,$selectTransporter, $transporters, $selected) {
        //print_r( $transporters);
        $arrTransporter = arrTransporter($transporters);
        $idTransporter = $selectTransporter-1;
        $arrBooks = arrBooks($books);
        $price = totalPriceIfDiscout($choice, $arrBooks, $selected) ;
        // echo $selectTransporter;
        //if () {
            if ($arrTransporter[$idTransporter]['price'] != null){
                $cost = floor($price*($arrTransporter[$idTransporter]['price']/100));
                $price = $price+$cost;
            }
        //}
        //echo "<br><br>$cost<br><br>$price<br><br>";
        return [$cost, $price];
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