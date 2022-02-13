<?php
    require('req/catalog.php');
?>
<div class="container mt-2 mb-5">
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Choix</h5>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 col-xl-8">
                                <div class="cart-container">
                                    <form method="post" action="livraison.php">
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
                                                        if ( isset($selectedSession) && !empty($selectedSession) && isset($quantitySession) && !empty($quantitySession) ){
                                                            popBooksOnArray($books, $_SESSION['selectedBooks'], $_SESSION['quantityBooks']);
                                                        }
                                                        else {
                                                            popBooksOnArray($books, 0, 0);
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="cart-footer text-right">
                                            <button type="submit" name="submit" class="btn btn-secondary my-1 bg-secondary bg-gradient" style="color: white;  border-color: #000;">
                                            Livraison <i class="fas fa-angle-right fa-fw" ></i></button>
                                        </div>
                                    </form>
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