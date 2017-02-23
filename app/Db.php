<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 23.02.17
 * Time: 18:19
 */

namespace App;

use PDO;

/**
 * Class Db component for work with database
 * @package App
 */
class Db
{
    /**
     * @var object PDO
     */
    private static $instance;

    /**
     * Db constructor.
     */
    private function __construct(){}

    private function __clone(){}

    private function __wakeup(){}

    /**
     * Connect to the database on the specified parameters
     *
     * @return PDO
     */
    public static function connect()
    {
        if (self::$instance === null) {
            $paramsPath = ROOT . '/app/config/db_params.php';
            $params = include($paramsPath);

            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            try{
                self::$instance = new PDO($dsn,$params['user'],$params['password']);
                return self::$instance;
            }catch (\PDOException $e){
                echo "Error connect to database" . $e->getMessage();
            }
        }

        return self::$instance;
    }
}