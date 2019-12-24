<?php

class File
{
    private $filepath;
    private $filename;

    public function __construct(string $filepath)
    {
        $this->filepath = $filepath;
        $pattern = "/[\s\/]+/";
        $str_arr = preg_split($pattern, $filepath);
        $this->filename = trim($str_arr[count($str_arr) - 1]);
    }

    public function getPath() : string
    {
        return $this->filepath;
    }

    public function getName() : string
    {
        return $this->filename;
    }

}