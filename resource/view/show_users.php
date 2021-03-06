<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/User.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guest Book</title>
    <link rel="stylesheet" href="/resource/css/style.css">
    <link rel="stylesheet" href="/resource/css/show_users.css">
</head>
<body>
    <div class="container">
        <h1>Users</h1>
        <div class="user-list">
            <ul>
                <li>
                    <div class="user">
                        <div>Id</div>
                        <div>Avatar</div>
                        <div>Name</div>
                        <div>Group</div>
                        <div>Delete</div>
                    </div>
                </li>
                <?php
                $users = DB::getInstance()->query("SELECT users.id, groups.name as groupName, users.name, users.avatar FROM users JOIN groups WHERE users.id_group=groups.id")->fetchAll();
                // $users = DB::getInstance()->getData('users');
                foreach($users as $user)
                { ?>
                <li>
                    <div class="user">
                        <div class="id"><?php echo $user['id']; ?></div>
                        <div class="avatar"><img src="<?php echo $user['avatar']; ?>" alt="Avatar"></div>
                        <div class="name"><?php echo $user['name']; ?></div>
                        <div class="group"><?php echo $user['groupName']; ?></div>
                        <div class="delete">
                            <form action="/resource/controller/DeleteUser.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/menu.php") ?>
    </div>
</body>
</html>