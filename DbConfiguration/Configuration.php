<?php 

    // Importing Database.php file in the Configuration
    require_once(dirname(__FILE__) ."../Database.php");




    class PDODatabaseConfiguration{

        private const user = db_username;
        private const password = db_password;
        private $URL = db_type.':host='.db_host.';port='.port;
        protected $connection = null;

        // private $URL2 = 'mysql:host=localhost;dbname=clinic_db';

        public function __construct() {
            try {
                // First, create a connection to the MySQL server without specifying a database
                $this->connection = new PDO($this->URL, self::user, self::password);
                $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                // Create the database if it does not exist
                $sql = 'CREATE DATABASE IF NOT EXISTS ' . db_name . ';';
                $this->connection->exec($sql);
                $this->connection = new PDO($this->URL . ';dbname=' . db_name, self::user, self::password);
                // Now select the database to use it
                $this->connection->exec('USE ' . db_name);
        
            } catch (PDOException $e) {
                die('Error: ' . $e->getMessage());
            }
        }

        // Add a method to retrieve the PDO connection
        public function getConnection() {
            $this->connection->exec('CREATE TABLE IF NOT EXISTS user (
                    user_id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(255) NOT NULL,
                    email VARCHAR(191) UNIQUE,  -- Reduced length to avoid max key length error
                    password VARCHAR(255) NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) CHARACTER SET utf8mb4;');
            
            return $this->connection;
        }


    }

    class MySQLIConfiguration {
        
        private const user = db_username; // Replace with actual username
        private const password = db_password; // Replace with actual password
        private $host = db_host; // Assign database host
        private $dbname = db_name; // Assign database name
        protected $connection = null;

        public function __construct() {
            // Create a connection
            $this->connection = new mysqli($this->host, self::user, self::password, $this->dbname);

            // Check connection
            if ($this->connection->connect_error) {
                die('Connection failed: ' . $this->connection->connect_error);
            } else {
                echo 'The Connection is Successfully';
            }
        }

        // Optionally add a method to close the connection
        public function closeConnection() {
            if ($this->connection) {
                $this->connection->close();
                echo "Connection closed.";
            }
        }
    }

?>



