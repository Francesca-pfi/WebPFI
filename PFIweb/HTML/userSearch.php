<?php   
    include_once __DIR__ . "/../CLASSES/USER/user.php";   

    $TDG = UserTDG::get_instance();   
    $title = $_POST['search'];
    $users = $TDG->search_name($title);

    if(count($users) > 0){
        echo "<h3 class='my-4'>Users</h3>";
    }
    foreach($users as $user){
        $display = new User();
        $display->load_user($user['email']);

        $display->display_user(0);
    }
?>