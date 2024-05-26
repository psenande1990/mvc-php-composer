<?php
    namespace Core;

    require '../app/config.php';

    use Exception;

    class App
    {

        function __construct()
        {
            if (isset($_GET['url'])) {
                $url = $_GET['url'];
            } else {
                $url = DEFAULT_CONTROLLER;
            }

            $arguments = explode('/', trim($url, '/'));
            $controllerBasename = array_shift($arguments);
            $controllerName = ucwords($controllerBasename) . "Controller";
            if (count($arguments)) {
                $method =  array_shift($arguments);
            } else {
                if(!isset($_GET['url'])) {
                    $method = DEFAULT_METHOD;
                } else {
                    $method = $controllerBasename;
                }
            }

            // echo "Controller: $controllerName <br>";
            // echo "Method: $method <br>";

            $file = "../app/controllers/$controllerName" . ".php";
            if (file_exists($file)) {
                require_once $file;
            } else {
                header("HTTP/1.0 404 Not Found");
                echo "No encontrado";
                die();
            }

            $controllerName = '\\App\\Controllers\\' . $controllerName;
            $controllerObject = new $controllerName;
            if (method_exists($controllerName, $method)) {
                $controllerObject->$method($arguments);
            } else {
                header("HTTP/1.0 404 Not Found");
                echo "No encontrado";
                die();
            }
        }

        public static function render($view, $args = [], $header = 'header.php', $footer = 'footer.php', $layout = DEFAULT_LAYOUT)
        {
            extract($args, EXTR_SKIP);

            $layout_url = LAYOUTS . $layout . DIRECTORY_SEPARATOR;

            if ($header != "") {
                $file = $layout_url . $header;
                if (is_readable($file)) {
                    require $file;
                } else {
                    throw new Exception("$file not found");
                }
            }

            $file = PAGES."$view.php";
            if (is_readable($file)) {
                require $file;
            } else if(is_readable(PAGES.$view."/index.php")) {
                require PAGES.$view."/index.php";
            } else {
                throw new Exception("$file not found");
            }

            if($footer != ""){
                $file = $layout_url . $footer;
                if (is_readable($file)) {
                    require $file;
                } else {
                    throw new Exception("$file not found");
                }
            }
            exit;
        }

        public static function renderJson($data, $code = 200, $charset = 'utf-8')
        {
            $response = json_encode($data);
            http_response_code($code);
            header("Content-type: application/json; charset=".$charset);
            echo $response;
            exit;
        }

        public static function load_model($model)
        {   
            $file = MODELS. $model . ".php";
            if(file_exists($file)) {
                require $file;
                return new $model;
            }
            else {
                throw new Exception("Model $model not found");
            }
        }
    }