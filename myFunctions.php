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
                        echo '<input type="number" class="form-control cart-qty"  name="qtyBook'.($id+1).'" id="qtyBook'.($id+1).'" value="0">';
                    echo '</div>';
                echo '</td>';
                echo '<td id="price'.($id+1).'">'.number_format( priceDiscount($book['price'], $book['discount']), 2, ",", " ").' €</td>';
                echo '<td class="text-right" id="priceBookCompted'.($id+1).'">0.00 €</td>';
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
    function popBuyBooks($books, $choice){
        $id = 0;
        $arrBooksById = arrBooks($books);
        $tt = totalPrice($choice, $arrBooksById);
        $ttht = priceForDevise(round(calculVAT($tt/100, 20)));
        $tt = priceForDevise($tt);
        foreach ($choice as $key => $number){
            echo '<tr>';
                echo '<th scope="row">'.($id+1).'</th>';
                echo '<td><a href="#" class="text-danger"><i class="ri-delete-bin-3-line"></i></a></td>';
                echo '<td>';
                    echo '<div class="form-group mb-0">';
                        echo "<p>".$arrBooksById[$key]['name']."<p>";
                    echo '</div>';
                echo '</td>';
                echo '<td>'.$choice[$id].'</td>';
                if ($arrBooksById[$key]['discount'] != null) {
                    echo '<td><small class="text-muted"><del>'.number_format(($arrBooksById[$key]['price']*$number/100), 2, ",", " ").' €</del></small></td>';
                    
                }
                else {
                    echo '<td>'.number_format(($arrBooksById[$key]['price']*$number/100), 2, ",", " ").' €</td>';
                }
                echo '<td class="text-right">'.number_format(priceDiscount($arrBooksById[$id]['price'], $arrBooksById[$id]['discount'])*$number, 2, ",", " ").' €</td>';
            echo '</tr>'; 
            $id++;
        }
    }
    /********************************************************
    *   x   *   x   *
    *   x   *   x   *
    ********************************************************/
    function popTotalPrices($choice, $books){
        $id = 0;
        $arrBooksById = arrBooks($books);
        $tt = totalPriceIfDiscout($choice, $arrBooksById);
        $ht = priceForDevise(floor(calculHT($tt, 20)));
        $ttht = priceForDevise(round(calculVAT($tt/100, 20)));
        $tt = priceForDevise($tt);
        echo '<input id="inputChoice" name="choice" type="hidden" value="' . implode("," ,$choice) . '">';
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
                echo "<h4 id=\"subAmount\">$tt €</h4>";
            echo "</td>";
        echo "</tr>";
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
    function totalPrice($choice, $books) {
        $tt = 0;
        foreach ($choice as $key => $numberOfBooks){
            $tt += $books[$key]['price']*$numberOfBooks;
        }
        return $tt;
    }

    function totalPriceIfDiscout($choice, $books) {
        $tt = 0;
        foreach ($choice as $key => $numberOfBooks){
            if ($books[$key]['discount'] != null) {
                $discounted = floor(priceDiscount($books[$key]['price'], $books[$key]['discount']));
                $tt += $discounted*$numberOfBooks*100;
            }
            else {
                $tt += $books[$key]['price']*$numberOfBooks;
            }
        }
        return $tt;
    }
    /********************************************************
    *   x   *   x   *
    *   x   *   x   *
    ********************************************************/
  
    calculShippingCosts([1,3,2], $books, 3, $transporters);
    function calculShippingCosts($choice, $books ,$selectTransporter, $transporters) {
        $arrTransporter = arrTransporter($transporters);
        $idTransporter = $selectTransporter-1;
        $arrBooks = arrBooks($books);
        $price = totalPriceIfDiscout($choice, $arrBooks) ;
        if ($arrTransporter[$idTransporter]['price'] != null){
            $cost = floor($price*($arrTransporter[$idTransporter]['price']/100));
            $price = $price+$cost;
        }
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