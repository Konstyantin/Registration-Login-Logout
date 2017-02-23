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
    public function start()
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
    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get data from session by $key
     *
     * @param string $key
     * @return bool
     */
    public function get(string $key)
    {
        if ($this->checkExists($key)) {
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
    public function checkExists(string $key)
    {
        return ($_SESSION[$key]) ? true : false;
    }

    /**
     * Delete data from session
     *
     * @param string $key
     */
    public function delete(string $key)
    {
        if ($this->checkExists($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroy session if it exists
     */
    public function destroy()
    {
        if (session_status() == 2) {
            session_destroy();
        }
    }
}