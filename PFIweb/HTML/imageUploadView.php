<?php 
    if(!validate_session() || !($album->get_userID() == $_SESSION["userID"])){
        echo "
            <h3 class=\"my-4 blanchedalmond\">Upload image</h3>
            <div class=\"card\" id=\"creationAlbum\">   
                <img id='gremlin' src='./MEDIAS/Images/gremlin.png'>
            </div>
        ";
    }
    else{
        echo "
            <h3 class=\"my-4 blanchedalmond\">Upload image</h3>
            <div class=\"card\" id=\"creationAlbum\">   
                <div class='card-body'>                             
                    <form method = \"post\" action = \"./DOMAINLOGIC/addimage.dom.php?\" enctype='multipart/form-data'>        
                        <input type=\"hidden\" id=\"albumID\" name=\"albumID\" value=\"" . $_GET["albumID"] . "\">
                        <div for=\"file\" style='font-size:1.3em'>Upload</div>
                        <input type=\"file\" class=\"form-control\" name=\"file\" id=\"file\" required>
                        <div for=\"contenu\" style='font-size:1.3em'>Description</div>
                        <textarea type=\"text\" class=\"form-control\" name=\"descr\" id=\"descr\" rows='12'></textarea>                               
                        <button class=\"btn btn-outline-light\" type=\"submit\" style='font-size:1em'>Add!</button>
                    </form>                
                </div>
            </div>
        ";
    }
?>
               
                     
         
                     
  
