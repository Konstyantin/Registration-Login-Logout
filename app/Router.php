<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 23.02.17
 * Time: 18:19
 */

namespace App;

/**
 * Class Router
 * @package App
 */
class Router
{
    /**
     * @var array
     */
    private $routes;

    /**
     * Router constructor.
     *
     * Get all routes
     */
    public function __construct()
    {
        $routePath = ROOT . '/app/config/routes.php';

        $this->routes = include($routePath);
    }

    /**
     * Get URI
     *
     * @return string
     */
    public function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }

    /**
     * Initiate Router
     */
    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {

                if ($uriPattern !== $uri) {
                    $uri = substr(strstr($uri, '/'), 1);
                }

                return $this->defineComponents($uriPattern, $path, $uri);
            }
        }
    }

    /**
     * Determine Bundle Controller and Action by URI
     *
     * @param string $pattern
     * @param string $path
     * @param string $uri
     * @return bool
     */
    public function defineComponents($pattern, $path, $uri)
    {
        $internalRoute = preg_replace("~$pattern~", $path, $uri);

        $segments = explode('/', $internalRoute);

        $bundleName = ucfirst(reset($segments)) . 'Bundle';

        $controllerName = ucfirst(array_shift($segments)) . 'Controller';

        $actionName = array_shift($segments) . 'Action';

        if ($segments !== null) {
            $parameters = $segments;
        }

        $controllerFile = ROOT . '/src/' . $bundleName . '/Controller/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            include_once($controllerFile);

            $controllerObject = new $controllerName;

            $result = call_user_func_array([$controllerObject, $actionName], $parameters);

            if ($result != null) {
                return false;
            }
        }
    }
}