<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 23.02.17
 * Time: 19:19
 */

use App\Controller;

class UserController extends Controller
{
    public function registerAction()
    {

        $this->render('login');
    }
}