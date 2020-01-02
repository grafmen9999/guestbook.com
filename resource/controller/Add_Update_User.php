<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/filesystem.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/File.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/User.php");

session_start();

$id = $_POST['id'];
$name = $_POST['name'];
$password = $_POST['password'];
$group = $_POST['group'];
$isUpload = (strcmp($_POST['isUpload'], "true") == 0) ? true : false;
$avatar = $_FILES['avatar'];
$imgAvatar = Filesystem::getInstance()->upload_file($avatar);

if (!isset($id)) {
    $user = new User($name, $password, $group, $imgAvatar);

    DB::getInstance()->addData('users', [
        'name' => $user->getName(),
        'id_group' => $user->getGroup(),
        'password' => $user->getPassword(),
        'avatar' => $user->getAvatar()->getPath(),
    ]);
    $user->setID(DB::getInstance()->getData('users', "WHERE name=? AND id_group=? AND password=? AND avatar=?", [
        $user->getName(),
        $user->getGroup(),
        $user->getPassword(),
        $user->getAvatar()->getPath(),
    ])[0]['id']);
    $_SESSION['auth'] = $user;

}
else {
    $user = &$_SESSION['auth'];

    $user->setName($name);
    if ($password) $user->setPassword($password);
    $user->setGroup($group);
    if ($isUpload) $user->setAvatar($imgAvatar);

    DB::getInstance()->updateData('users', [
        'name' => $user->getName(),
        'id_group' => $user->getGroup(),
        'password' => $user->getPassword(),
        'avatar' => $user->getAvatar()->getPath(),
    ], "WHERE id=:id", ['id' => $id]);

    header("Location: $_SERVER[HTTP_REFERER]");
}

header("Location: /");
    
?>