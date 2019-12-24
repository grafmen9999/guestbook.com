<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/config.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/db.php");

    session_start();

    function initialize()
    {
        $config = Config::getInstance();

        $db = DB::getInstance(); // Изначально планировал заполнять конфиги в этом месте, но потом немного передумал

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

    // initialize(); // Данная строка создает таблицы в "автоматическом режиме", т.е. она сама создаст таблицы с нужными полями


    if (!isset($_SESSION['auth'])) {
        header("Location: /resource/view/authorization.php");
    }
    else {
        header("Location: /resource/view/show_users.php");
    }
?>