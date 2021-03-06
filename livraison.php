<?php
    if (!isset($_SESSION) && empty($_SESSION)) {
        session_start();
    }

    require('req/catalog.php');
    require('req/myFunctions.php');
    require('req/cost.php');
    $choice = [];
    $bookChoiced = [];
    if (isset($_POST) && !empty($_POST)) {
        if (isset($_POST['qtyBook0']) && !empty($_POST['qtyBook0'])) {
            $qty = intval(htmlspecialchars($_POST['qtyBook0']), 10);
            $id = htmlspecialchars(preg_replace('/[^0-9]/', '', 'qtyBook0'));
            array_push($bookChoiced, $id);
            array_push($choice, $qty);
        }
        if (isset($_POST['qtyBook1']) && !empty($_POST['qtyBook1'])) {
            $qty = intval(htmlspecialchars($_POST['qtyBook1']), 10);
            $id = htmlspecialchars(preg_replace('/[^0-9]/', '', 'qtyBook1'));
            array_push($bookChoiced, $id);
            array_push($choice, $qty);
        }
        if (isset($_POST['qtyBook2']) && !empty($_POST['qtyBook2'])) {
            $qty = intval(htmlspecialchars($_POST['qtyBook2']), 10);
            $id = htmlspecialchars(preg_replace('/[^0-9]/', '', 'qtyBook2'));
            array_push($bookChoiced, $id);
            array_push($choice, $qty);
        }
    }
    if (empty($_SESSION)) {
        $_SESSION['open'] = 'yes';
        $_SESSION['selectedBooks'] = $bookChoiced;
        $_SESSION['quantityBooks'] = $choice;
    }
?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="utf-8">
    <title>livraison et réduction</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <?php
        include "inc/bootstrapLinks.php";
        include "inc/fontawesomeLinks.php";
    ?>
</head>

<body>
    <?php
        include "inc/header.php";
    ?>
    <div class="container mt-2 mb-5">
        <div class="contentbar">
            <!-- Start row -->
            <?php
                if (isset($_POST) && !empty($_POST)) {
            ?>
            <div class="row">
                <!-- Start col -->
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="card-title">Cart</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-10 col-xl-8">
                                    <div class="cart-container">
                                        <div class="cart-head">
                                            <div class="table-responsive">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col"></th>
                                                            <th scope="col">Product</th>
                                                            <th scope="col">Qty</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col" class="text-right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="vertical-align: middle">
                                                        <?php
                                                            if (!empty($choice)) {
                                                                popBuyBooks($books, $bookChoiced, $choice);
                                                            } else {
                                                        ?>
                                                        <div class="alert alert-warning alert-success" role="alert">
                                                            <h4 class=" alert-heading">HO ho (づ￣ ³￣)づ</h4>
                                                            <p>Apparemment il y a eu un problème avec ton formulaire :</p>
                                                            <hr>
                                                            <p class="mb-0">tu n'as pas choisi de live...</p>
                                                        </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                            <div class="cart-body">
                                                <!-- <form reduction> -->
                                                <div class="row">
                                                    <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                                        <form method="get">
                                                            <?php
                                                                if (!empty($choice)) {
                                                            ?>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="search" class="form-control" placeholder="Coupon Code" aria-label="Search" aria-describedby="button-addonTags">
                                                                    <div class="input-group-append">
                                                                        <button class="input-group-text" id="button-addonTags">Apply</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- </form reduction > -->
                                                <!-- <form submit> -->
                                                <form method="post" action="validation.php">
                                                    <div class="row">
                                                        <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                                        <?php
                                                            if (!empty($choice)) {
                                                        ?>
                                                        <div class="order-note">
                                                            <div class="form-group">
                                                                <select id="selectCost" name="selectCost" class="form-select" aria-label="Default select example" style="margin: 13px 0;">
                                                                    <option id="select0" value="0">Expedition's choice</option>
                                                                    <?php
                                                                        $value = 1;
                                                                        foreach ($transporters as $key => $carrer) {
                                                                            echo '<option id="select' . $value . '" value="' . $key . '">' . $carrer["name"] . '</option>';
                                                                            $value++;
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            }
                                                            $over = false;
                                                            asort($books);
                                                            $booksArray = [];
                                                            foreach($books as $book) {
                                                                array_push($booksArray, $book) ;
                                                            }
                                                            foreach($bookChoiced as $key => $book) {
                                                                if ($booksArray[$book]['quantity']<$choice[$key]) {
                                                                    $over = true;
                                                                    break;
                                                                }
                                                            }
                                                            if ($over){
                                                        ?>
                                                        <div class="order-note">
                                                            <div class="form-group">
                                                                <div class="alert alert-success" role="alert">
                                                                    <h4 class="alert-heading">Oups... ¯\_(ツ)_/¯</h4>
                                                                    <p>Désolé vous voulliez :</p>
                                                                    <?php
                                                                    foreach($bookChoiced as $key => $book) {
                                                                        //echo $booksArray[$book]['quantity'];
                                                                        if ($booksArray[$book]['quantity']<$choice[$key]) {
                                                                            //$string+=
                                                                            echo "<hr>";
                                                                            echo '<p class="mb-0"> <b>'. $choice[$key].'</b> <i>'. $booksArray[$book]['name'].'</i> nous n\'en avons que <b>'.$booksArray[$book]['quantity'].'</b>.</p>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        </div>
                                                        <div class="col-md-12 order-1 order-lg-2 col-lg-7 col-xl-6">
                                                            <div class="order-total table-responsive ">
                                                                <table class="table table-borderless text-right">
                                                                    <tbody>
                                                                        <?php
                                                                        sendInputHidden($choice, $bookChoiced);
                                                                        popTotalPrices($choice, $books, $bookChoiced);
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart-footer text-right">
                                                        <button type="submit" name="submit" class="btn btn-secondary my-1 bg-secondary bg-gradient" style="color: white; border-color: #000;">
                                                            Confirmation <i class="fa-solid fa-angles-right"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                                <!-- </form submit> -->
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
            </div>
            <!-- End row -->
            <?php
                }
                else {
            ?>
            <div class="alert alert-warning alert-danger" role="alert">
                <h4 class=" alert-heading">Whaaaaat (╯°□°）╯︵ ┻━┻</h4>
                <p>Ton formulaire :</p>
                <hr>
                <p class="mb-0">EST VIIIIIIIIDE...</p>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    <?php
        include "inc/footer.php";
    ?>
    <script src="public/js/cost.js"></script>
</body>

</html>
<!--JP Lemonias-->
<!------Pe@cE---->