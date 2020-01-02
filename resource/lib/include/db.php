<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/Singleton.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/resource/lib/include/config.php");

class DB extends Singleton
{
    private $pdo;
    private $prepare = null;

    protected function __construct()
    {
        $config = Config::getInstance();

        $dbname = $config->getConfig('db')['dbname'];
        $host = $config->getConfig('db')['host'];
        $username = $config->getConfig('db')['username'];
        $password = $config->getConfig('db')['password'];
        $charset = $config->getConfig('db')['charset'];

        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $dsn = "mysql:dbname=$dbname;host=$host;charset=$charset";

        $this->pdo = new PDO($dsn, $username, $password, $opt);
    }

    public function query($sql, $values = null)
    {
        if (is_null($this->prepare)) {
            $this->prepare = $this->pdo->prepare($sql);
        }
        else if (strcmp($this->prepare->queryString, $sql) != 0) {
            $this->prepare = $this->pdo->prepare($sql);
        }
         
        $this->prepare->execute($values);

        return $this->prepare;
    }

    public function getData($table, $where = "", $values = null)
    {
        $sql = "SELECT * FROM $table $where";

        return $this->query($sql, $values)->fetchAll();
    }

    public function addData($table, $params)
    {
        $sql_t1 = "INSERT INTO $table (";
        $sql_t2 = "VALUES (";

        foreach($params as $key => $value)
        {
            $sql_t1 .= "$key,";
            $sql_t2 .= ":$key,";
        }

        $sql_t1 = substr($sql_t1, 0, strlen($sql_t1) - 1) . ") ";
        $sql_t2 = substr($sql_t2, 0, strlen($sql_t2) - 1) . ");";

        $sql = $sql_t1 . $sql_t2;

        $this->query($sql, $params);
    }

    public function updateData($table, $params, $where = "", $where_params = [])
    {
        $sql = "UPDATE $table SET ";

        foreach($params as $key => $value) {
            $sql .= "$key=:$key,";
        }

        $sql = substr($sql, 0, strlen($sql) - 1) . " $where";
        
        $values = array_merge($where_params, $params);

        $this->query($sql, $values);
    }

    public function deleteData($table, $where = "", $values = null)
    {
        $sql = "DELETE FROM $table $where";
        
        $this->query($sql, $values);
    }
}

?>