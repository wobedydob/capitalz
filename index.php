<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include the bootstrap css and meta links. -->
    <?php
    include("./index/meta.php");
    include("./index/css.php");
    ?>

    <!-- Pagina Titel -->
    <title>CapitalZ.net</title>

    <!-- Page icons -->
    <link rel="shortcut icon" href="./img/icon.PNG">
    <link rel="apple-touch-icon-precomposed" sizes="200x200" href="./img/icon.PNG">
    <link rel="icon" href="./img/icon.PNG" type="image/x-icon">
    <link rel="icon" href="./img/icon.PNG">

</head>

<body>

<!-- Page Content -->
<main id="contents">

    <!-- Include the navbar. -->
    <?php include("./layout/navbar.php"); ?>

    <section class="content">
        <?php
        if (isset($_GET["content"])) {
            include("./pages/" . $_GET["content"] . ".php");
        } else if (empty(isset($_GET["content"]))) {
            include("./pages/homepage.php");
        } else {
            include("./pages/homepage.php");
        }
        ?>
    </section>

</main>

<!-- Include the footer. -->
<?php include("./layout/footer.php"); ?>

<!-- Include the needed scripts. -->
<?php include("./index/js.php"); ?>

</body>

</html>