<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 24.02.17
 * Time: 9:19
 */

namespace Acme\UserBundle\Model;

/**
 * Class LoginForm
 * @package Acme\UserBundle\Model
 */
class LoginForm
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
     * Check valid data (email or login) form field
     *
     * @return bool
     */
    public function checkData()
    {
        $dataLenght = strlen($_POST['data']);

        if($dataLenght > 5 && $dataLenght < 25) {
            return true;
        }

        $this->errors[] = 'Login or Email is not valid';
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

        $this->errors[] = 'Password not valid';
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