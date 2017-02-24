<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 24.02.17
 * Time: 2:01
 */

namespace Acme\UserBundle\Model;

use App\Db;
use App\Session;
use PDO;

/**
 * Class User
 * @package Acme\UserBundle\Model
 */
class User
{
    /**
     * Registration user
     *
     * @param string $email
     * @param string $login
     * @param string $name
     * @param string $password
     * @param int $country
     * @param int $conditions
     * @return \PDOStatement
     */
    public static function register($email, $login, $name, $password, $country, $conditions)
    {
        $db = Db::connect();

        $sql = "INSERT INTO users (email, login, name, password, country, conditions)
                VALUES (:email, :login, :name, :password, :country, :conditions)";

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':country', $country, PDO::PARAM_INT);
        $result->bindParam(':conditions', $conditions, PDO::PARAM_STR);
        $result->execute();

        return $result;
    }

    /**
     * Get user by $email and login
     *
     * @param string $email
     * @param string $login
     * @return mixed
     */
    public static function getUserByEmailLogin(string $email, string $login)
    {
        $db = Db::connect();

        $sql = "SELECT email FROM users WHERE email = :email AND login = :login";

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':login', $login, PDO::PARAM_STR);

        $result->execute();

        return $result->fetch();

    }

    /**
     * Auth register user
     *
     * @param $value
     */
    public static function auth($value)
    {
        $_SESSION['user'] = $value;
    }

    /**
     * Check user is logged
     *
     * @return bool
     */
    public static function checkLogged()
    {
        if (Session::get('user')) {
            return Session::get('user');
        }
    }

    /**
     * Login user by login or email
     *
     * @param string $data
     * @param $password
     * @return mixed
     */
    public static function login(string $data, $password)
    {
        $db = Db::connect();

        $sql = 'SELECT email FROM users WHERE login = :data OR email = :data AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':data', $data, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        $result->execute();

        $user = $result->fetch();

        return $user;
    }


    /**
     * Get user by $email
     *
     * @param string $email
     * @return mixed
     */
    public static function getUserByEmail(string $email)
    {
        $db = Db::connect();

        $sql = "SELECT email, name FROM users WHERE email = :email";

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);

        $result->execute();

        return $result->fetch();
    }
}