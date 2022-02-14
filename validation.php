<?php
    require('req/catalog.php');
    require('req/myFunctions.php');
    require('req/cost.php');
    $choice = [];
    $bookChoiced = [];
    $exped = "";
    if (isset($_POST) && !empty($_POST)) {
        if (isset($_POST['choice']) && !empty($_POST['choice'])) {
            $choice = array_map('intval', explode(",", $_POST['choice']));
        }

        if (isset($_POST['bookChoiced']) && empty($_POST['bookChoiced']) && $_POST['bookChoiced'] == 0){
            array_push($bookChoiced, 0);
        }
        else if (isset($_POST['bookChoiced']) && !empty($_POST['bookChoiced'])) {
            $bookChoiced = array_map('intval', explode(",", $_POST['bookChoiced']));
        }

        if (isset($_POST['selectCost']) && !empty($_POST['selectCost'])) {
            if ($_POST['selectCost'] !== '0'){
                foreach ($_POST as $keyPart => $part) {
                    if ($keyPart === "selectCost") {
                        foreach ($transporters as $key => $transporter) {
                            if ($key === $part) {
                                $exped = $key;
                            }
                        }
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="utf-8">
    <title>Validation du panier</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <?php
        include "inc/bootstrapLinks.php";
        include "inc/fontawesomeLinks.php";
    ?>
</head>

<body>
    <div class="container mt-2 mb-5">
        <div class="contentbar">
            <?php
                include "inc/header.php";
                if (isset($_POST) && !empty($_POST)) {
            ?>
            <!-- Start row -->
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
                                            <form method="post" action="payement">
                                                <div class="row">
                                                    <?php
                                                        if (!empty($exped)) {
                                                    ?>
                                                    <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                                        <div class="order-note"></div>
                                                    </div>
                                                    <div class="col-md-12 order-1 order-lg-2 col-lg-7 col-xl-6">
                                                        <div class="order-total table-responsive ">
                                                            <table class="table table-borderless text-right">
                                                                <tbody>
                                                                <?php
                                                                    sendInputHidden($choice, $bookChoiced);
                                                                    popCostTotalPrices($choice, $books, $exped, $transporters, $bookChoiced, $ship);
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        } else {
                                                    ?>
                                                    <div class="alert alert-warning alert-success" role="alert">
                                                        <h4 class=" alert-heading">HO ho (づ￣ ³￣)づ</h4>
                                                        <p>Apparemment il y a eu un problème avec ton formulaire :</p>
                                                        <hr>
                                                        <p class="mb-0">tu n'as pas choisi de livreur...</p>
                                                    </div>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                                <div class="cart-footer text-right">
                                                    <button type="submit" name="submit" class="btn btn-secondary my-1 bg-secondary bg-gradient" style="color: white; border-color: #000;">
                                                        Payement <i class="fas fa-circle-dollar-to-slot fa-fw"></i>
                                                    </button>
                                                </div>
                                                <!-- </form submit> -->
                                            </form>
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
        </div>
    </div>
    <?php
        }
        include "inc/footer.php";
    ?>
</body>

</html>
<!--JP Lemonias-->
<!------Pe@cE---->