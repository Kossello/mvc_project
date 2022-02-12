<?php
    namespace app\core;

    class Application {
        public Router $router;
        public Request $request;
        public static string $ROOT_DIR;

        public function __construct($rootPath) {
            $this->request = new Request();
            $this->router = new Router($this->request);
            self::$ROOT_DIR = $rootPath;
        }

        public function run(){
            echo $this->router->resolve();
        }

    }