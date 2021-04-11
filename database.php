<?php
class ConnectionWithDatabase{

    private static $instances = [];
    public $conn;
    
    protected function __construct() {
        $this->connectToDatabase();
     }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): ConnectionWithDatabase
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }
        return self::$instances[$cls];
    }

    public function getConnection(){
        return $this->conn;
    }

    private function connectToDatabase()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name = "coursema";
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->conn = $conn;
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }
    
}

?>