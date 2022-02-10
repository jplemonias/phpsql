<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Progression PHP de base</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <?php
        include "bootstraplinks.php";
        // ini_set('error_reporting', E_ALL);
    ?>
</head>

<body>
    <?php
        require('myFunctions.php');
        include "header.php";
        include "books.php";
        include "payement.php";
        include "footer.php";
    ?>
    <script src="public/js/selectBooks.js"></script>
</body>

</html>
