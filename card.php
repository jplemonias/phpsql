<?php
require('multidimensional-catalog.php');
require('myFunctions.php');
require('livraison.php');
$choice = [];
$bookChoiced = [];
if (isset($_POST) && !empty($_POST)) {
    if (isset($_POST['qtyBook0']) && !empty($_POST['qtyBook0'])) {
        $qty = intval(htmlspecialchars($_POST['qtyBook0']), 10);
        array_push($bookChoiced, preg_replace('/[^0-9]/', '', 'qtyBook0'));
        array_push($choice, $qty);
    }
    if (isset($_POST['qtyBook1']) && !empty($_POST['qtyBook1'])) {
        $qty = intval(htmlspecialchars($_POST['qtyBook1']), 10);
        array_push($bookChoiced, preg_replace('/[^0-9]/', '', 'qtyBook1'));
        array_push($choice, $qty);
    }
    if (isset($_POST['qtyBook2']) && !empty($_POST['qtyBook2'])) {
        $qty = intval(htmlspecialchars($_POST['qtyBook2']), 10);
        array_push($bookChoiced, preg_replace('/[^0-9]/', '', 'qtyBook2'));
        array_push($choice, $qty);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Progression PHP de base</title>
    <?php
    include "bootstraplinks.php";
    ?>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <div class="container mt-2 mb-5">
        <div class="contentbar">
            <!-- Start row -->
            <?php
            if (!empty($_POST) && !empty($_POST)) {
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
                                                    <tbody>
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
                                                <form method="get">
                                                    <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">


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

                                                    </div>
                                                </form>
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
                                                                asort($transporters);
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
                                                        <button type="submit" name="submit" class="btn btn-info my-1">
                                                            <i class="ri-save-line mr-2"></i>Payement =>
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
    include "footer.php";
    ?>
    <script src="public/js/cost.js"></script>
</body>

</html>