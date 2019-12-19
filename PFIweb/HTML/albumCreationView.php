<?php
    if(!validate_session()){
        echo "
            <h3 class=\"my-4 blanchedalmond\">Album creation</h3>
            <div class=\"card\" id=\"creationAlbum\">   
                <img id='gremlin' src='./MEDIAS/Images/gremlin.png'>
            </div>
        ";        
    }
    else{
        echo "
            <h3 class=\"my-4 blanchedalmond\">Album creation</h3>
            <div class=\"card\" id=\"creationAlbum\">   
                <div class='card-body'>                             
                    <form method = \"post\" action = \"./DOMAINLOGIC/newAlbum.dom.php?\">        
                        <div for=\"titre\" style='font-size:1.3em'>Titre</div>
                        <input type=\"text\" name=\"title\" id=\"title\" required>
                        <div for=\"contenu\" style='font-size:1.3em'>Description</div>
                        <textarea type=\"text\" class=\"form-control\" name=\"descr\" id=\"descr\" rows='12'></textarea>                               
                        <button class=\"btn btn-outline-light\" type=\"submit\" style='font-size:1em'>Créer!</button>
                    </form>                
                </div>
            </div>
        ";
    }
?>

