<div class='card text-white bg-dark albumCard'>
    <div class='card-header albumHeader'>
        <a class="albumTitle" href="./album.php?albumID=<?php echo $this->id ?>">
            <?php echo $this->title ?>
        </a>            
    </div>       
    <div class='card-body albumBody'>  
        <div> 
            <?php echo $this->descr ?>
        </div>     
    </div>
    <div class='card-footer text-left albumFooter'>
        <div class="albumUser">
            <img alt='pfp' src='<?php echo $pfp; ?>' height='50px' width='50px'>
            <span><?php echo $username ?></span> 
            <small class='text-muted'>Posted on <?php echo $this->date; ?></small>
        </div>
        <div class="albumControl">
            <span class='badge badge-primary'><span id="nbLikesalbum<?php echo $this->id?>"><?php echo $nbLikes; ?></span> likes</span>              
            <span class='badge badge-secondary'>
                <?php echo $this->nombreVues ?> views
            </span>           
            <?php echo $btnLike ?>
            <?php echo $btnDelete; ?>
        </div>
    </div>     
</div>