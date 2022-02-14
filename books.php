<?php
    if (!isset($_SESSION) && empty($_SESSION)) {
        session_start();
        $_SESSION['open'] = 'yes';
    }

    require('req/myFunctions.php');
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="utf-8">
    <title>Progression PHP de base</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <?php
        include "inc/bootstrapLinks.php";
        include "inc/fontawesomeLinks.php";
    ?>
</head>

<body>
    <?php
        include "inc/header.php";
        include "cardBooks.php";
        include "cardPayement.php";
        include "inc/footer.php";
    ?>
    <script src="public/js/selectBooks.js"></script>
</body>

</html>
<!--JP Lemonias-->
<!------Pe@cE---->