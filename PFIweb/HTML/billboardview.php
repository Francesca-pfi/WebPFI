<?php
  if(validate_session()){
    $name = $_SESSION["userName"];
  }
  else{
    $name="Anon";
  }
?>

<div class="container-fluid mt-30 pl-5">
  <h1 class="pb-4 blanchedalmond">Welcome <?php echo $name ?> </h1>
    <div class="row justify-content-md-center">
        <div class="col-sm-8 pb-4">
            <?php 
              if(isset($_GET["userID"])){
                include "myAlbumView.php";
              }
              else{
                include "albumListView.php";
              }
              
            ?>
        </div>
        <div class="col-sm-3 mb-4">
            <?php include "albumCreationView.php"; ?>            
        </div>
    </div>
</div>
