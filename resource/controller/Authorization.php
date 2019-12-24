<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/File.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/User.php");

session_start();

$name = $_POST['name'];
$password = $_POST['password'];

$users = DB::getInstance()->getData('users', array(
    'name' => ['=', $name, ''],
    // 'password' => ['=', $password, ''],
));

$user = $users[0];
if (password_verify($password, $user[3])) {
    $user = new User($name, $password, $user[1], new File($user[4]), $user[0]);
    $_SESSION['auth'] = $user;
}

// foreach($users as $user) {
//     if (password_verify($password, $user[3])) {
//         $user = new User($name, $password, $user[1], new File($user[4]), $user[0]);
//         $_SESSION['auth'] = $user;
//     break;
//     }
// }

header("Location: /");

?>