<ul class="menu">
    <?php 
        if (strcmp($_SERVER['SCRIPT_NAME'], "/resource/view/add_update_user.php") != 0)
            echo '<li class="item"><a href="/resource/view/add_update_user.php">Add or Update user</a></li>';
        if (strcmp($_SERVER['SCRIPT_NAME'], "/resource/view/add_update_group.php") != 0)
            echo '<li class="item"><a href="/resource/view/add_update_group.php">Add or Update group</a></li>';
        if (strcmp($_SERVER['SCRIPT_NAME'], "/resource/view/show_users.php") != 0)
            echo '<li class="item"><a href="/resource/view/show_users.php">Show users</a></li>';
    ?>
    <li class="item"><a href="/resource/controller/Logout.php">Logout</a></li>
</ul>