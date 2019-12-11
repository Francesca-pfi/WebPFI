<?php 
    if(!validate_session()){
        die;
    }
?>

<h3 class="my-4">Upload image</h3>
<div class="card" style="margin-bottom:30px;border:0.3vh solid rgba(57,184,188,1)">
    
    <div class='card-body text-white bg-dark'>                             
        <form method = "post" action = "./DOMAINLOGIC/addimage.dom.php?" enctype="multipart/form-data">
            <div class="form-group" style='margin-bottom:0' >
                <input type="hidden" id="albumID" name="albumID" value="<?php echo $_GET["albumID"]; ?>">
                <label for="contenu" style='font-size:1.3em'>Upload :</label>
                <input type="file" class="form-control" name="file" id="file" required>
                <label for="contenu" style='font-size:1.3em'>Description :</label>
                <textarea type="text" class="form-control" name="descr" id="descr" rows='5'></textarea><br>                
            </div>                       
            <button class="btn btn-info" type="submit" style='font-size:1em'>Add</button>
        </form>                
    </div>
</div>