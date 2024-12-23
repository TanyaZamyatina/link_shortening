<?php
    class Home extends Controller {
        public function index() {

            $data = [];
            $message = "";

            $link = $this->model('LinkModel');

            if(isset($_POST['longLink'])) {
                $link->setData($_POST['longLink'], $_POST['shortLink']);

                $isValid = $link->validLink();
                if($isValid == "Верно")
                    $link->addLink();
                else
                    $message = $isValid;
            }

            if(isset($_POST['shortLink'])) {
                $link->delLink($_POST['shortLink']);
            }

            if ($_SERVER['REQUEST_URI']) {
                $shortLink = 'http://localhost' . $_SERVER['REQUEST_URI'];
                $link->linkRedirect($shortLink);
            }

            $data = [
                'link' => $link->getLink(),
                'message' => $message,
            ];

            $this->view('home/index', $data);
        }
        public function reg() {

            $data = [];
            $message = "";

            if(isset($_POST['email'])) {
                $user = $this->model('UserModel');
                $user->setData($_POST['email'], $_POST['login'], $_POST['pass'], $_POST['re_pass']);

                $isValid = $user->validForm();
                if($isValid == "Верно")
                    $user->addUser();
                else
                    $message = $isValid;
            }

            $data = [
                'message' => $message
            ];

            $this->view('home/index', $data);
        }
    }