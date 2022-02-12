<?php

    use app\core\Application;

    require_once __DIR__ . "/../vendor/autoload.php";

    $app = new Application(dirname(__DIR__));

    $app->router->get("/", "index");
    $app->router->get("/user", function (){

        return "User page";
    });
    $app->router->get("/about", "about");

    $app->run();

