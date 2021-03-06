<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 23.02.17
 * Time: 18:18
 */

namespace App;


/**
 * Class Session provides methods to common features needed for work with session
 *
 * @package App
 */
class Session
{
    /**
     * Session start
     */
    public static function start()
    {
        if (session_status() == 1) {
            session_start();
        }
    }

    /**
     * Set value to session
     *
     * @param string $key
     * @param $value
     */
    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get data from session by $key
     *
     * @param string $key
     * @return bool
     */
    public static function get(string $key)
    {
        if (self::checkExists($key)) {
            return $_SESSION[$key];
        }
        return false;
    }

    /**
     * Check exists data in session by $key
     *
     * @param string $key
     * @return bool
     */
    public static function checkExists(string $key)
    {
        if (isset($_SESSION[$key])) {
            return true;
        }

        return false;
    }

    /**
     * Delete data from session
     *
     * @param string $key
     */
    public static function delete(string $key)
    {
        if (self::checkExists($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroy session if it exists
     */
    public static function destroy()
    {
        if (session_status() == 2) {
            session_destroy();
        }
    }
}