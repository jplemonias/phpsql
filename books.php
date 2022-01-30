<?php
    require('multidimensional-catalog.php');
    /* for test to PHP if not hosted */ // require('myFunctions.php');
?>
<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4" whidth="100%">
        <?php
            popBooks($books);
        ?>
    </div>
</div>