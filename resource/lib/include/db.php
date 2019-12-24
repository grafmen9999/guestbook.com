<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/Singleton.php");

class DB extends Singleton
{
    private $my_sql;


    private function connect() {
        $config = Config::getInstance();
        $this->my_sql->connect(
            $config->getConfig('db')['host'],
            $config->getConfig('db')['username'],
            $config->getConfig('db')['password'],
            $config->getConfig('db')['dbname'],
            null, null);

        if ($this->my_sql->connect_error) {
            die("Connection failed: " . $this->my_sql->connect_error);
        }
    }

    protected function __construct()
    {
        $this->my_sql = new mysqli();
    }

    public function getDB()
    {
        return $this->my_sql;
    }

    public function deleteData($table, $conditions = []) : void
    {
        $where = "";

        if (!empty($conditions)) {
            $where .= " WHERE ";

            foreach($conditions as $key => $values) {
                $where .= $key . $values[0] . "\"$values[1]\"" . " $values[2] ";
            }
        }

        $sql = "DELETE FROM `$table`" . $where;
        
        $this->connect();

        $this->my_sql->query($sql);

        $this->my_sql->close();
    }    
    // conditions => array('id' => ['=', 1, 'OR']); // example
    public function getData($table, $conditions = []) : array
    {
        $where = "";

        if (!empty($conditions)) {
            $where .= " WHERE ";

            foreach($conditions as $key => $values) {
                $where .= $key . $values[0] . "\"$values[1]\"" . " $values[2] ";
            }
        }

        $sql = "SELECT * FROM `$table`" . $where;

        $this->connect();

        $query = $this->my_sql->query($sql);
        $result = [];

        foreach($query->fetch_all() as $r)
        {
            $result[] = $r;
        }

        $this->my_sql->close();

        return $result;
    }

    // params => array('name' => "MyName"); // example
    public function addData($table, $params)
    {
        $sql1 = "INSERT INTO `$table` (";
        $sql2 = "VALUES (";

        foreach($params as $key => $value)
        {
            $sql1 .= $key . ",";
            $sql2 .= '"' . $value . '",';
        }

        $sql1 = substr($sql1, 0, strlen($sql1) - 1) . ") ";
        $sql2 = substr($sql2, 0, strlen($sql2) - 1) . ");";

        $sql = $sql1 . $sql2;

        $this->connect();

        $this->my_sql->query($sql);

        $this->my_sql->close();
    }

    public function createTable(string $table_name, $params)
    {
        $query = "CREATE TABLE `$table_name` (";

        foreach($params as $key => $value)
        {
            $query .= $key . ' ' . $value . ',';
        }

        $query = substr($query, 0, strlen($query) - 1) . ");";

        $this->connect();

        $this->my_sql->query($query);

        $this->my_sql->close();
    }

    public function updateData(string $table_name, $params, $conditions = [])
    {
        $sql = "UPDATE `$table_name` SET ";
        $where = "";
        
        if (!empty($conditions)) {
            $where .= " WHERE ";

            foreach($conditions as $key => $values) {
                $where .= $key . $values[0] . "\"$values[1]\"" . " $values[2] ";
            }
        }

        foreach($params as $key => $value) {
            $sql .= $key . '=' . "\"$value\",";
        }

        $sql = substr($sql, 0, strlen($sql) - 1) . $where;

        $this->connect();

        $this->my_sql->query($sql);

        $this->my_sql->close();
    }
}

?>