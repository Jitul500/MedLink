<?php
class Database {

    private static $connection = null;

    public static function connect() {

        if (self::$connection === null) {

            self::$connection = new mysqli(
                "localhost", 
                "root",      
                "",           
                "medlink"     
            );

            if (self::$connection->connect_error) {
                die("Database connection failed");
            }
        }

        return self::$connection;
    }
}
