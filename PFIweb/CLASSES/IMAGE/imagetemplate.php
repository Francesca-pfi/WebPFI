<div class='d-block card text-white bg-dark w-95' style='margin-bottom:30px;border:0.5vh solid rgba(57,184,188,1)'>
    <div class='card-header'>
        <img alt='<?php echo $descr; ?>' src='<?php echo $url; ?>'>
    </div>
    <div class='card-body'>
        <p class='card-text'><?php echo $descr; ?></p>
        <p class='card-text'><small class='text-muted'>Added on <?php echo $date; ?></small></p>
    </div>
    <div class='card-footer'>
        <span class='badge badge-primary m-1'><?php echo $nbLikes; ?> likes</span>
        <span class='badge badge-secondary m-1'><?php echo $nbVues; ?> views</span>
        <?php
            echo $btnLike;
            echo $btnDelete;
        ?>
    </div>
</div>