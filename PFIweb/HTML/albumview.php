<div class="container-fluid mt-30 pl-5">
  <h1 class="mb-4" ><?php echo $_GET["title"] ?> </h1>
    <div class="row justify-content-md-center">
        <div class="col-sm-8 mb-4">
            <?php include "imagelistview.php";?>
        </div>
        <div class="col-sm-3 mb-4">
            <?php include "imageUploadView.php"; ?>
            <?//php include "mostvisitedview.php"; ?>
        </div>
    </div>
</div>