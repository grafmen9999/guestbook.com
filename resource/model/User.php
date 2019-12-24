<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/model/File.php");

class User
{
    private $id;
    private $group;
    private $name;
    private $password;
    private $avatar;

    public function __construct(string $name, string $password, int $group, File $file = null, int $id = -1)
    {
        if ($id >= 0) $this->id = $id;
        $this->name = $name;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->avatar = $file;
        $this->group = $group;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function setPassword(string $password) : void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setAvatar(File $avatar) : void
    {
        $this->avatar = $avatar;
    }

    public function getAvatar() : File
    {
        return $this->avatar;
    }

    public function getID() : int
    {
        return $this->id;
    }

    public function setID(int $id) : void
    {
        $this->id = $id;
    }

    public function getGroup() : int
    {
        return $this->group;
    }

    public function setGroup(int $group) : void
    {
        $this->group = $group;
    }
}