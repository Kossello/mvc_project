<?php

    namespace app\controllers;

    use app\core\Controller;
    use app\core\Request;

    class AuthController extends Controller {
        public function login(Request $request){
            if($request->isPost()){
                echo '<pre>';
                var_dump($request->getBody());
                echo '</pre>';
                exit();
                return 0;
            }
            return $this->render('login');
        }

        public function signup(){

        }

    }