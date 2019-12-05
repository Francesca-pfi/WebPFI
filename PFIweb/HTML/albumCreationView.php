<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";  
    
    if(!validate_session()){
        die;
    }
?>

<h3 class="my-4">Création d'albums</h3>
<div class="card" style="margin-bottom:30px;border:0.3vh solid rgba(57,184,188,1)">
    
    <div class='card-body text-white bg-dark'>                             
        <form method = "post" action = "./DOMAINLOGIC/newAlbum.dom.php?">
            <div class="form-group" style='margin-bottom:0'>
                <label for="titre" style='font-size:1.3em'>Titre :</label>
                <input type="text" name="title" id="title">
                <label for="contenu" style='font-size:1.3em'>Description :</label>
                <textarea type="text" class="form-control" name="descr" id="descr" rows='5'></textarea><br>                
            </div>                       
            <button class="btn btn-info" type="submit" style='font-size:1em'>Créer!</button>
        </form>                
    </div>
</div>