<?php
class db
{
    private static $instance;
    private $connexion;
    private function __construct()
    {
        try{
            $this->connexion = new PDO("mysql:host=127.0.0.1:3388;dbname=eventmanager;charset=utf8","root","");
            $this->connexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public static function getInstance(){
        if (!self::$instance){
            self::$instance = new db();
        }
        return self::$instance;
    }

    public function getConnexion(){
        return $this->connexion;
    }
}