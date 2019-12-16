<div class='card' style='text-align:left;margin-top:30px;display:none' id="comment<?php echo $noComment;?>">
    <div class='card-header'>
        <img alt='pfp' src='<?php echo $pfp; ?>' height='50px' width='50px'>
        <span style='margin:0 1vw'><a href="billboard.php?userID=<?php echo $authorID;?>"><?php echo $username;?></a></span>
        <small class='text-muted'><?php echo $date; ?></small></div>
    <div class = 'card-body'>
    <p class='card-text'><?php echo $content; ?></p></div>
    <div class='card-footer'>
        <span class='badge badge-primary m-1'><span id="nbLikescomment<?php echo $id?>"><?php echo $nbLikes?></span> likes</span>
        <?php 
            echo $btnLike;
            echo $btnsOwner;
        ?>
    </div>
    <?php 
        echo $editbox;
    ?>
</div>