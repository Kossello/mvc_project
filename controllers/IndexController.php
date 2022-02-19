<?php
namespace app\controllers;

    use app\core\Application;
    use app\core\Controller;
    use app\core\Request;

    class IndexController extends Controller {
        public function index(){
            $params = [
                'view' => 'kosa'
            ];
            return $this->render('index', $params);
        }
        public function post(Request $request){

            return "index controller";
        }
    }