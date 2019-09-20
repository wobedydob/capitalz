<?php?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include the bootstrap css and meta links. -->
    <?php
    include("./index/meta.php");
    include("./index/css.php");
    ?>

    <title>ZZP.nl</title>

</head>

<body>

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

<!-- Include the needed scripts. -->
<?php include("./index/js.php"); ?>

</body>

</html>