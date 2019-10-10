<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include the bootstrap css and meta links. -->
    <?php
    include("./index/meta.php");
    include("./index/css.php");
    ?>

    <title>Starter_template</title>

</head>

<body>

<!-- Include the navbar. -->
<?php include("./layout/navbar.php"); ?>

<div class="content d-flex" id="wrapper">

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <section class="container-fluid">
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

    </div>

</div>

<!-- Include the footer. -->
<?php include("./layout/footer.php"); ?>

<!-- Include the needed scripts. -->
<?php include("./index/js.php"); ?>

</body>

</html>