<?php
    namespace app\core;

    class Application {
        public Router $router;
        public Request $request;
        public static string $ROOT_DIR;
        public Response $response;
        public static Application $app;
        public function __construct($rootPath) {
            self::$app = $this;
            $this->response = new Response();
            $this->request = new Request();
            $this->router = new Router($this->request, $this->response);
            self::$ROOT_DIR = $rootPath;
        }

        public function run(){
            echo $this->router->resolve();
        }

    }