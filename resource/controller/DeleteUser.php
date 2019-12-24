<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");

session_start();

$id =  $_POST['id'];

DB::getInstance()->deleteData('users', array(
    "id" => ['=', $id, '']
));

if ($id == $_SESSION['auth']->getID()) // logout if we delete authorized user
    header("Location: $_SERVER[REQUEST_SCHEME]://$_SERVER[SERVER_NAME]/resource/controller/Logout.php");

header("Location: $_SERVER[HTTP_REFERER]");

?>