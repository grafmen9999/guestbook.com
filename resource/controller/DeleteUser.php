<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/User.php");

session_start();

$id =  $_POST['id'];

DB::getInstance()->deleteData('users', "WHERE id=?", [$id]);

if ((int)$id == $_SESSION['auth']->getID()) { // logout if we delete authorized user
    unset($_SESSION['auth']);
}

header("Location: /");

?>