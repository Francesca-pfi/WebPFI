<?php 
  //on arrive de albumview.php, permet d'ajouter un commentaire si on est login
  $addComm;
  if (validate_session()) {
    $addComm = "
    <input type='hidden' id='elemID' name='elemID' value='" . $_GET["albumID"] . "'>
    <input type='hidden' id='typeElem' name='typeElem' value='album'>
    <textarea class='newComment' name='content' id='content' rows='7' placeholder='What do you think about this album?' required></textarea><br>
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
  
