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
        <script src="JS/util.js"></script>
        <script src="JS/functions.js"></script>
    </head>
    <body>
        <main>
            <?php include "navigationmodule.php";?>
            <div id="bandeColore"></div>
            <div class="container-fluid align-center text-center">
                <?php  load_modules($content); ?>
            </div>
        </main>       
        <footer>
            <div>
                Created by F. St-Jacques & A. Lévesque with help from J. Dusablon Senecal
            </div>
            <button class="btn btn-outline-light" id="btnTop" type="button">
                Back to the top!
            </button>
        </footer>
    </body>
</html>
