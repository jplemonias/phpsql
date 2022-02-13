<?php
// $session = "NOP";
if (!isset($_SESSION) && empty($_SESSION)) {
    // $session = "YES";
    session_start();
    $_SESSION['open'] = 'yes';
}
?>

<!DOCTYPE html>
<html lang="fr-FR" style="background: url(/public/img/thecallofcthulhu.jpg);">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - I LOVEcraft</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <?php
    include "inc/bootstrapLinks.php";
    include "inc/fontawesomeLinks.php";
    ?>
</head>
<body style='display: flex; min-height: 100vh; flex-direction: column; justify-content: space-between; opacity: 0.8;'>
    <?php
    include "inc/header.php";
    // echo $session;
    echo var_dump($_SESSION);
    ?>
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" style="align-items: center">
        <main class="px-3" style="display: contents;">
            <h1>I &#10084;CRAFT.</h1>
            <p class="lead">Viens acheter ton Lovecraft à bon prix</p>
            <p class="lead border-secondary"><a href="books.php" class="btn btn-lg btn-secondary fw-bold bg-gradient">Catalogue <i class="fa-solid fa-caret-right"></i></a></p>
        </main>
    </div>
    <?php
    include "inc/footer.php";
    ?>
</body>
</html>
<!--JP Lemonias-->
<!------Pe@cE---->