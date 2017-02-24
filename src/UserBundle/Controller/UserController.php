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
use Acme\UserBundle\Model\LoginForm;
use App\Session;

/**
 * Class UserController
 */
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

    /**
     * Login user
     *
     * @return mixed
     */
    public function loginAction()
    {
        /**
         * Check user is logged
         */
        if (User::checkLogged()) {
            $this->redirect('/index');
        }

        $form = new LoginForm();

        if($form->isSubmit()) {
            $form->checkData();
            $form->checkPassword();

            if($form->getErrors() === null) {

                $data = $_POST['data'];
                $password = $_POST['password'];

                $user = User::login($data, $password);

                $email = $user['email'];

                User::auth($email);

                $this->redirect('/index');
            }
        }

        $errors = $form->getErrors();

        return $this->render('login', $errors);
    }

    /**
     * Index it is main page
     */
    public function indexAction()
    {
        $user = User::checkLogged();
    }

    /**
     * Logout User and redirect to login
     */
    public function logoutAction()
    {
        $user = User::checkLogged();
        if ($user) {
            Session::delete('user');

            $this->redirect('/login');
        }
    }
}