<?php
/**
 * Class Database - OOP Wrapper untuk MySQLi
 */
class Database
{
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    public $conn;

    public function __construct()
    {
        $this->getConfig();
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        
        if ($this->conn->connect_error) {
            die("Koneksi Database gagal: " . $this->conn->connect_error);
        }
    }

    private function getConfig()
    {
        if (defined('CONFIG_PATH') && file_exists(CONFIG_PATH)) {
            // Include file config untuk mendapatkan variable $config
            include CONFIG_PATH; 
            
            if (isset($config)) {
                $this->host     = $config['host'];
                $this->user     = $config['username'];
                $this->password = $config['password'];
                $this->db_name  = $config['db_name'];
            } else {
                die("Error: Variabel \$config tidak ditemukan di config.php");
            }
        } else {
             die("Error: CONFIG_PATH tidak terdefinisi atau file tidak ditemukan.");
        }
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function get($table, $where = null)
    {
        $where_clause = $where ? " WHERE " . $where : "";
        $sql = "SELECT * FROM " . $table . $where_clause . " LIMIT 1";
        $result = $this->conn->query($sql);
        return ($result && $result->num_rows > 0) ? $result->fetch_assoc() : null;
    }

    public function insert($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = array_map(function($val) {
            return "'" . $this->conn->real_escape_string($val) . "'";
        }, array_values($data));
        
        $sql = "INSERT INTO $table ($columns) VALUES (" . implode(", ", $values) . ")";
        return $this->conn->query($sql);
    }

    // ... (metode update dan delete tetap sama)

    public function __destruct() {
        if ($this->conn) $this->conn->close();
    }
}
