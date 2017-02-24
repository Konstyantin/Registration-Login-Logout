<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 24.02.17
 * Time: 8:27
 */

namespace Acme\UserBundle\Model;


/**
 * Class RegisterForm
 * @package Acme\UserBundle\Model
 */
class RegisterForm
{
    /**
     * @var array
     *
     * Stored for form field error validation
     */
    private $errors;

    /**
     * Check submitted form
     *
     * @return bool
     */
    public function isSubmit()
    {
        if (isset($_POST['submit'])) {
            return true;
        }
        return false;
    }

    /**
     * Check valid email form filed
     *
     * @return bool
     */
    public function checkEmail()
    {
        $emailLength = strlen($_POST['email']);

        if ($emailLength > 5 && $emailLength < 25) {
            return true;
        }

        $this->errors[] = 'email not valid';
    }

    /**
     * Check valid login form field
     *
     * @return bool
     */
    public function checkLogin()
    {
        $loginLength = strlen($_POST['login']);

        if ($loginLength > 7 && $loginLength < 20) {
            return true;
        }

        $this->errors[] = 'login not valid';
    }

    /**
     * Check valid password form field
     *
     * @return bool
     */
    public function checkPassword()
    {
        $passwordLength = strlen($_POST['password']);

        if ($passwordLength > 5 && $passwordLength < 20) {
            return true;
        }

        $this->errors[] = 'password not valid';
    }

    /**
     * Check valid name form field
     *
     * @return bool
     */
    public function checkName()
    {
        $nameLength = strlen($_POST['name']);

        if ($nameLength > 5 && $nameLength < 15) {
            return true;
        }

        $this->errors[] = 'name not valid';
    }

    /**
     * Get errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}