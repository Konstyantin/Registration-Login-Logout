<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 23.02.17
 * Time: 19:19
 */

use App\Controller;
use Acme\UserBundle\Model\Country;
use Acme\UserBundle\Model\User;
use Acme\UserBundle\Model\RegisterForm;

class UserController extends Controller
{

    /**
     * Registration user
     *
     * @return mixed|void
     */
    public function registerAction()
    {
        if (User::checkLogged()) {
            return $this->redirect('/index');
        }

        $form = new RegisterForm();

        if ($form->isSubmit()) {

            $form->checkLogin();
            $form->checkPassword();
            $form->checkEmail();
            $form->checkName();

            if ($form->getErrors() === null) {
                echo 'form is valid';

                $email = $_POST['email'];
                $login = $_POST['login'];

                $user = User::getUserByEmailLogin($email, $login);

                if (!$user) {
                    $name = $_POST['name'];
                    $password = $_POST['password'];
                    $country = $_POST['country'];
                    $conditions = $_POST['conditions'];

                    User::register($email, $login, $name, $password, $country, $conditions);

                    User::auth($email);

                    $this->redirect('/index');
                }
            }
        }
        $countries = Country::getCountryList();

        $errors = $form->getErrors();

        return $this->render('register', ['countries' => $countries, 'errors' => $errors]);
    }

    public function loginAction()
    {
        if (User::checkLogged()) {
            $this->redirect('/index');
        }
        return $this->render('login');
    }

    public function indexAction()
    {
        $user = User::checkLogged();
    }
}