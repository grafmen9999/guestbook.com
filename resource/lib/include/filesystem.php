<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/Singleton.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/File.php");

class Filesystem extends Singleton
{
    private $uploaddir = "/public/";

    public function upload_file($file, string $type = 'images/avatar/')
    {
        $uploadfile = $this->uploaddir . $type . basename($file['name']);

        $file;
    
        if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $uploadfile)) {
            $file = new File($uploadfile);
        } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . $uploadfile)) {
            $file = new File($uploadfile);
        }

        return $file;
    }
}