<?php

namespace Core\Classes;

class Router
{
    protected $RoutesArr = [];

    public function add($MethodStr, $UriStr, $ControllerStr)
    {
        $this->RoutesArr[] = [
            'uri' => APP_DIR . $UriStr,
            'controller' => $ControllerStr,
            'method' => $MethodStr,
            'access' => null
        ];
        return $this;
    }

    public function get($UriStr, $ControllerStr)
    {
        return $this->add('GET', $UriStr, $ControllerStr);
    }

    public function post($UriStr, $ControllerStr)
    {
        return $this->add('POST', $UriStr, $ControllerStr);
    }

    public function access($key)
    {
        $this->RoutesArr[array_key_last($this->RoutesArr)]['access'] = $key;

        return $this;
    }

    public function route($UriStr, $MethodStr)
    {
        foreach ($this->RoutesArr as $Route) {
            if ($Route['uri'] === $UriStr && $Route['method'] === strtoupper($MethodStr)) {
                //echo base_path('controllers/' . $route['controller']);
                switch($Route['access']) {
                    case 'auth':
                        if (!$_SESSION['user'] ?? false) {
                            header("location: " . APP_DIR . "/login");
                            exit();
                        }
                        break;
                    case 'guest':
                        if ($_SESSION['user'] ?? false) {
                            header("location: " . APP_DIR . "/");
                            exit();
                        }
                        break;
                }
                
                return require getBasePath('controllers/' . $Route['controller']);
            }
        }

        $this->abort();
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    protected function abort($CodeInt = 404)
    {
        http_response_code($CodeInt);

        require getBasePath("/views/{$CodeInt}.php");

        die();
    }
}