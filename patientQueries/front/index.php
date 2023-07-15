<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Index</title>
    <!--Custom CSS Stylesheet -->
    <link href="../css/style/style.css" rel="stylesheet">
    <!-- Latest CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
  </head>
<body>
<!--Navbar-->
<?php require_once 'navbar.php'?>
<main class="container">
    <div class="container p-5 my-5 border bg-light">
        <!--Link pages to navbar-->
        <?php
        include 'config.php';
        include 'functions.php';
        if(isset($_GET['menu']))
        {
            switch($_GET['menu'])
            {
                case 'form':
                    include('form.php');
                    break;
                case 'view':
                    include('view.php');
                    break;
                default:
                    include('view.php');
            }
        }
        else
        {
            include('view.php');
        }
        ?>
    </div>
</main>
<!-- Latest compiled JavaScript -->
<script src="../js/bootstrap.bundle.js"></script>
</body>
</html>