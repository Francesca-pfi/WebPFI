<?php 
  //on arrive de imageview.php
  $addComm;
  if (validate_session()) {
    $addComm = "
    <input type='hidden' id='elemID' name='elemID' value='" . $_GET["imageID"] . "'>
    <input type='hidden' id='typeElem' name='typeElem' value='image'>
    <textarea class='newComment' name='content' id='content' rows='7' placeholder='What do you think about this image?' required></textarea><br>
    <button class='btn btn-outline-info' type='submit'>Post</button>
    ";
  }
  else {
    $addComm = "<p class='blanchedalmond'>Please <a class='blanchedalmond linkHover' href='login.php'>login</a> to comment</p>";
  }
?>
  <form method ="post" action = "./DOMAINLOGIC/addComment.dom.php ?>" style="text-align:left">
    <?php echo $addComm; ?>
  </form>
  
</div>