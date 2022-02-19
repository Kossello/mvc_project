<?php

    use app\controllers\AuthController;
    use app\core\Application;
    use app\controllers\IndexController;


    require_once __DIR__ . "/../vendor/autoload.php";

    $app = new Application(dirname(__DIR__));

    $app->router->get("/", [IndexController::class, "index"]);
    $app->router->post("/", [IndexController::class, 'post']);
    $app->router->get("/login", [AuthController::class, 'login']);
    $app->router->post("/login", [AuthController::class, 'login']);
    $app->router->get("/signup", [AuthController::class, 'signup']);
    $app->router->post("/signup", [AuthController::class, 'signup']);




    $app->router->get("/user", function (){
        return "User page";
    });
    $app->router->get("/about", "about");

    $app->run();

