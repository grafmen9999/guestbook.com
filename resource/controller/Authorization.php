<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/File.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/User.php");

session_start();

$name = $_POST['name'];
$password = $_POST['password'];

$users = DB::getInstance()->getData('users', "WHERE name=?", [$name]);

$user = $users[0];
if (password_verify($password, $user['password'])) {
    $user = new User($user['name'], $user['password'], $user['id_group'], new File($user['avatar']), $user['id']);
    $_SESSION['auth'] = $user;
}

header("Location: /");

?>