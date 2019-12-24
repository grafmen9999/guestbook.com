<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add or Update groups</title>
    <link rel="stylesheet" href="/resource/css/style.css">
    <link rel="stylesheet" href="/resource/css/add_update_group.css">
</head>
<body>
    <div class="container">
        <h1>Adding and Update groups</h1>
        <ul>
            <li>
                <?php
                $groups = DB::getInstance()->getData('groups');
                foreach($groups as $group) { ?>
                <form action='/resource/controller/Add_Update_Group.php' method='post'>
                    <input type='text' value='<?php echo $group[1] ?>' name='name'>
                    <input type='hidden' value='<?php echo $group[0] ?>' name='id'>
                    <input type='submit' value='Save' name='submit'>
                </form>
                <?php } ?>
                <form action="/resource/controller/Add_Update_Group.php" method="post">
                    <input type="text" value="" name="name">
                    <input type="submit" value="Add" name="submit">
                </form>
            </li>
        </ul>
        <?php 
        if (isset($_SESSION['auth'])) include($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/menu.php");
        else echo "<small>Click to return back <a href='/resource/view/authorization.php'>authorization</a> page!</small>";
        ?>
    </div>
</body>
</html>