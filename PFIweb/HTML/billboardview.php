<?php
  if(isset($_SESSION["userID"])){
    $name = $_SESSION["userName"];
  }
  else{
    $name="Anon";
  }
?>

<div class="container-fluid mt-30 pl-5">
  <h1 class="mb-4" >Welcome <?php echo $name ?> </h1>
    <div class="row justify-content-md-center">
        <div class="col-sm-8 mb-4">
            <?php include "albumListView.php";?>
        </div>
        <div class="col-sm-3 mb-4">
            <?php include "albumCreationView.php"; ?>
        </div>
    </div>
</div>
