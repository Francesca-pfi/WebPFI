<?php
  include __DIR__ . "/../UTILS/moduleloader.php";
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="HTML/functions.js"></script>
        <?php include "bootstrap.html";?>
        <title> <?php echo $title ?> </title>
    </head>
    <body>
        <?php include "navigationmodule.php";?>
        <div class="container-fluid align-center text-center">
              <?php  load_modules($content); ?>
        </div>
        <footer>
        </footer>
    </body>
</html>
