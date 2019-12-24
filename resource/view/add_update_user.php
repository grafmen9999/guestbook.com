<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/User.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/File.php");

session_start();
$groups = DB::getInstance()->getData('groups');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add user</title>
    <link rel="stylesheet" href="/resource/css/style.css">
    <link rel="stylesheet" href="/resource/css/add_update_user.css">
</head>
<body>
    <div class="container">
        <h1>Adding and Updating User</h1>
        <div class="container__inner">
            <form action="/resource/controller/Add_Update_User.php" method="post" enctype="multipart/form-data">
                <input type="text" name="name" id="name" placeholder="You'r name" value="<?php echo (isset($_SESSION['auth'])) ? $_SESSION['auth']->getName() : ""; ?>">
                <input type="password" name="password" id="password" placeholder="<?php echo (isset($_SESSION['auth'])) ? "New password" : "You'r password" ?>">
                <div id="block__avatar">
                    <img src="<?php echo (isset($_SESSION['auth'])) ? $_SESSION['auth']->getAvatar()->getPath() : ""; ?>" alt="Avatar">
                    <div class="box-download">
                        <label for="avatar">Download new image</label>
                        <input accept="image/*" type="file" name="avatar" id="avatar">
                    </div>
                    <input type="hidden" name="isUpload" id="isUpload" value="false">
                </div>
                <select name="group" id="group">
                    <?php                
                    foreach($groups as $group) { ?>
                    <option value='<?php echo $group[0]; ?>' <?php if (isset($_SESSION['auth'])) { if ($_SESSION['auth']->getGroup() == $group[0])  echo "selected"; } ?>><?php echo $group[1]; ?></option>
                    <?php } ?>
                </select>
                <small>Needs new group? Go to <a href="/resource/view/add_update_group.php">link</a>!</small>
                <?php if (isset($_SESSION['auth'])) { ?>
                <input type="hidden" name="id" value="<?php echo $_SESSION['auth']->getID(); ?>">
                <?php } ?>
                <input type="submit" name="submit" value="<?php echo (isset($_SESSION['auth'])) ? "Save" : "Register" ?>">
            </form>
        </div>
        <?php 
        if (isset($_SESSION['auth'])) include($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/menu.php");
        else echo "<small>Click to return back <a href='/resource/view/authorization.php'>authorization</a> page!</small>";
        ?>
    </div>
</body>
<script src="/resource/js/jquery-3.4.1.min.js"></script>
<script>
    $("#block__avatar input[name='avatar']").on('change', function() {
        if (this.files[0]) {
            var fr = new FileReader();

            $(fr).on("load", function() {
                $("#block__avatar img").attr('src', fr.result);
            });

            fr.readAsDataURL(this.files[0]);

            $("#isUpload").val('true');
        }
    });
</script>
</html>