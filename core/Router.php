<?php

    namespace app\core;
    class Router {
        protected array $routes = [];
        protected Request $request;
        protected Response $response;

        public function __construct($request, $response) {
            $this->request = $request;
            $this->response = $response;
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
                $this->response->setStatusCode(404);
                return $this->renderView('_404');
            }
            if (is_string($callback)) {
                return $this->renderView($callback);
            }

            if(is_array($callback)){
                $callback[0] = new $callback[0]();
            }

            return call_user_func($callback, $this->request);
        }

        public function renderView($view, $params=[]) {
            $layoutContent = $this->layoutContent();
            $viewContent = $this->renderOnlyView($view, $params);
            return str_replace('{{content}}', $viewContent, $layoutContent);
        }

        public function layoutContent() {
            ob_start();
            require_once Application::$ROOT_DIR . "/views/layouts/main.php";
            return ob_get_clean();
        }

        public function renderOnlyView($view, $params) {
            foreach ($params as $key => $value){
                $$key = $value;
            }
            ob_start();
            require_once Application::$ROOT_DIR . "/views/$view.php";
            return ob_get_clean();
        }
    }