<?php

    if(isset($_SESSION["userID"])){
        $navLinks = '       
        <li class="nav-item">
            <a class="nav-link" href="DOMAINLOGIC/logout.dom.php">LOGOUT</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="billboard.php?userID=' . $_SESSION["userID"] . '">MY ALBUMS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="myProfile.php">
            <img alt="" src="' . $_SESSION["userPFP"] . '" height="20" width ="20">
            MY PROFILE</a>
        </li>
        ';
    }
    else{
    $navLinks = '
    <li class="nav-item">
        <a class="nav-link" href="login.php">LOGIN</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="register.php">REGISTER</a>
    </li>';
    }
?>


<div class="jumbotron text-center" id="headerTop">
    <div class="container">
        <h1>Not a Forum</h1>
        <p>or maybe it is, who knows?</p>
    </div>
</div>


<nav class="navbar navbar-expand-sm navbar-dark" id="headerNav">
    <div class="container collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <?php
                echo $navLinks;
            ?>
            <li class="nav-item">
                <a class="nav-link" href="billboard.php">BILLBOARD</a>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0" action="billboard.php" method="post">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
