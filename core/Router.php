<?php

    namespace app\core;
    class Router {
        protected array $routes = [];
        protected Request $request;

        public function __construct($request) {
            $this->request = $request;
        }

        /**
         * @return array
         */
        public function get($path, $callback) {
            $this->routes['get'][$path] = $callback;
        }

        public function post($path, $callback) {
            $this->routes['post'][$path] = $callback;
        }

        public function resolve() {
            $path = $this->request->getPath();
            $method = $this->request->getMethod();
            $callback = $this->routes[$method][$path] ?? false;
            if (!$callback) {
                return "page not found";
            }
            if (is_string($callback)) {
                return $this->renderView($callback);
            }

            return call_user_func($callback);

        }

        public function renderView($view) {
            $layoutContent = $this->layoutContent();
            $viewContent = $this->renderOnlyView($view);
            return str_replace('{{content}}', $viewContent, $layoutContent);
        }

        public function layoutContent() {
            ob_start();
            require_once Application::$ROOT_DIR . "/views/layouts/main.php";
            return ob_get_clean();
        }

        public function renderOnlyView($view) {
            ob_start();
            require_once Application::$ROOT_DIR . "/views/$view.php";
            return ob_get_clean();
        }
    }