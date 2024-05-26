<?php
    namespace Core;

    require_once '../app/config.php';

    use PDO;
    use PDOException;

    class DB
    {

        function __construct()
        {
            // echo "En DB";
        }

        public static function connect()
        {
            try {
                $connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connection;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        
    }
