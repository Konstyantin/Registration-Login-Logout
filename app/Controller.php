<?php

/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 23.02.17
 * Time: 18:18
 */
namespace App;

/**
 * Controller is a simple implementation of a Controller.
 *
 * It provides methods to common features needed in controllers.
 *
 * @package App
 */
abstract class Controller
{
    /**
     * Return redirect response to the given URL
     *
     * @param string $url The URL to redirect
     */
    protected function redirect(string $url)
    {
        return header('Location: ' . $url);
    }


    /**
     * Return a render view
     *
     * @param string $view The view name
     * @param null $data
     * @return mixed
     */
    protected function render(string $view, $data = null)
    {
        $path = ROOT . '/src/UserBundle/View/' . $view . '.phtml';
        if (file_exists($path)) {
            return require_once($path);
        }
    }
}