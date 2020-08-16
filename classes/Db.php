<?php

    class Db{
        private static $conn;

        public static function getConnection(){
            if(self::$conn === null){
                self::$conn = new PDO('mysql:host=localhost;dbname=hazuktr389_virtualcurrency', "hazuktr389_hazuktr389", "84hcmxht");
                return self::$conn;
            }else{
                return self::$conn;
            }
        }
    }