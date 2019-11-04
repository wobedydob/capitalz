<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include the bootstrap css and meta links. -->
    <?php
    require_once("index/meta.php");
    require_once("index/css.php");

    require_once("script/svg-helper.php");
    ?>
    <!-- Pagina Titel -->
    <title>CapitalZ.net</title>
    <!-- Page icons -->
    <link rel="shortcut icon" href="img/icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="200x200" href="img/icon.png">
    <link rel="icon" href="img/icon.png" type="image/x-icon">
    <link rel="icon" href="img/icon.png">
</head>
<body>
<!-- Page Content -->
<main id="contents">
    <!-- Include the navbar. -->
    <?php require_once("layout/navbar.php"); ?>
    <section class="content">
        <?php
        if (isset($_GET["content"])) {
            require_once("pages/" . $_GET["content"] . ".php");
        } else if (empty(isset($_GET["content"]))) {
            require_once("pages/homepage.php");
        } else {
            require_once("pages/homepage.php");
        }
        ?>
    </section>
</main>
<!-- Include the footer. -->
<?php require_once("layout/footer.php"); ?>
<!-- Include the needed scripts. -->
<?php require_once("index/js.php"); ?>
</body>
</html>