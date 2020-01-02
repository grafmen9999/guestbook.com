<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");

$name = $_POST['name'];
$id = $_POST['id'];

if (isset($id)) { // hidden parameter id -> update data
    DB::getInstance()->updateData('groups', ['name' => $name], "WHERE id = :id", ['id' => $id]);
}
else {
    DB::getInstance()->addData('groups', ['name' => $name]);
}

header("Location: $_SERVER[HTTP_REFERER]");

?>