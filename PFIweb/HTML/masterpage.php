<?php
  include __DIR__ . "/../UTILS/moduleloader.php";
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include "bootstrap.html";?>
        <title> <?php echo $title ?> </title>
        <link rel="stylesheet" type="text/css" href="HTML/CSS/css.css">
        <script> <?php include_once __DIR__ . "/../JS/util.js"; ?> </script>
    </head>
    <body>   
        <?php include "navigationmodule.php";?>
        <div id="bandeColore"></div>
        <div class="container-fluid align-center text-center">
              <?php  load_modules($content); ?>
        </div>
        <footer>
        </footer>
    </body>
</html>
