<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/config.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");


    // echo "DEBUG MODE IS ACTIVE<br>";

    // $mysql = MySqlDB::getInstance();

//     $mysql->query("CREATE TABLE test_table (
// id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// name varchar(255) NOT NULL,
// surname varchar(255) NOT NULL,
// email varchar(255) NOT NULL
// );
// ");


    // $mysql->addData("test_table", ['name' => "Maxim", 'surname' => "Koban", 'email' => "grafmen9999@gmail.com"]);
    // $mysql->updateData('test_table', ['name' => "Alkonaft"], "WHERE id>=:id_min AND id<=:id_max", ['id_min' => 5, 'id_max' => 9]);
    // $mysql->updateData('test_table', ['name' => 'USERNAME_IS_DELETED2']);
    // $mysql->deleteData('test_table', "WHERE id >= ? AND id <= ?", [12, 25]);
    // $mysql->deleteData('test_table');

    // echo "<pre>";
    // print_r($mysql->getData("test_table"));
    // echo "</pre>";

    // exit();

    session_start();

    function initialize()
    {
        $config = Config::getInstance();

        $db = DB::getInstance();

        if ($db->createTable('groups', array(
            'id' => "int(10) UNSIGNED AUTO_INCREMENT",
            'name' => "varchar(255) NOT NULL",
            'PRIMARY KEY' => "(id)",
        )));
        
        if ($db->createTable('users', array(
            'id' => "int(10) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY",
            'id_group' => "int(10) UNSIGNED NOT NULL",
            'name' => "varchar(255) NOT NULL",
            'password' => "varchar(255) NOT NULL",
            'avatar' => "varchar(255)",
            'FOREIGN KEY' => "(id_group) REFERENCES Groups(id)",
        )));
    }

    // initialize(); // create tables

    if (!isset($_SESSION['auth'])) {
        header("Location: /resource/view/authorization.php");
    }
    else {
        header("Location: /resource/view/show_users.php");
    }
?>