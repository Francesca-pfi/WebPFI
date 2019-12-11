<?php 
  $addComm;
  if (validate_session()) {
    $addComm = "
    <input type='hidden' id='elemID' name='elemID' value='" . $_GET["imageID"] . "'>
    <input type='hidden' id='typeElem' name='typeElem' value='image'>
    <textarea class='form-control' name='content' id='content' rows='7' placeholder='What do you think about this image?' required></textarea><br>
    <button class='btn btn-success' type='submit'>Post</button>
    ";
  }
  else {
    $addComm = "<p>Please <a href='login.php'>login</a> to comment</p>";
  }
?>
  <form method ="post" action = "./DOMAINLOGIC/addComment.dom.php ?>" style="margin-top:30px;text-align:left">
    <?php echo $addComm; ?>
  </form>
  
</div>