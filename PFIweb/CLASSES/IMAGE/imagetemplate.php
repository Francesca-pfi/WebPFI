<?php 
    $display;
    if ($type == "image") {
        $display = "<img alt='$descr' src='$url'>";
    }
    else if ($type == "video") {
        $display = "<video class='m-1 align-middle' width='1280' height='720' controls>
        <source src='$url'>
        This video format is not supported by your browser
        </video>";
    }
?>

<div class='d-block card text-white bg-dark w-95' style='margin-bottom:30px;border:0.5vh solid rgba(57,184,188,1)'>
    <div class='card-header'>
        <?php echo $display; ?>
    </div>
    <div class='card-body'>
        <p class='card-text'><?php echo $descr; ?></p>
        <p class='card-text'><small class='text-muted'>Added on <?php echo $date; ?></small></p>
    </div>
    <div class='card-footer'>
        <span class='badge badge-primary m-1'><span id="nbLikesimage<?php echo $id?>"><?php echo $nbLikes; ?></span> likes</span>
        <span class='badge badge-secondary m-1'><?php echo $nbVues; ?> views</span>
        <?php
            echo $btnLike;
            echo $btnDelete;
        ?>
    </div>
</div>