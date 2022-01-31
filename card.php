<?php
require('multidimensional-catalog.php');
require('myFunctions.php');
require('livraison.php');
$choice = [$_POST['qtyBook1'], $_POST['qtyBook2'], $_POST['qtyBook3']];
// print_r($_POST);
/* for test to PHP if not hosted */ // $choice = [2,3,2];
var_dump($choice);
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
                                                            popBuyBooks($books, $choice);
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="cart-body">
                                            <div class="row">
                                                <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                                    <div class="order-note">
                                                        <!-- <form reduuctoin> -->

                                                        <form method="post" action="#">

                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="search" class="form-control" placeholder="Coupon Code" aria-label="Search" aria-describedby="button-addonTags">
                                                                    <div class="input-group-append">
                                                                        <button class="input-group-text" id="button-addonTags">Apply</button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </form>

                                                        <!-- </form reduction > -->
                                                        <div class="form-group">
                                                            <select class="form-select" aria-label="Default select example" style="margin: 13px 0;">
                                                                <option id="select0" value="0">Expedition's choice</option>
                                                                <?php
                                                                    asort($transporters);
                                                                    $value = 1;
                                                                    foreach ($transporters as $key => $carrer) {
                                                                        echo '<option id="select'.$value.'" value="' . $key . '">' . $carrer["name"] . '</option>';
                                                                        $value++;
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <form submit> -->
                                                <div class="col-md-12 order-1 order-lg-2 col-lg-7 col-xl-6">

                                                    <form method="post" action="validation.php">
                                                        <div class="order-total table-responsive ">
                                                            <table class="table table-borderless text-right">
                                                                <tbody>
                                                                    <?php
                                                                        popTotalPrices($choice, $books);
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
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
    <script src="public/js/cost.js"></script>
</body>

</html>