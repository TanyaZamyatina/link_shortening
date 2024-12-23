<?php
    require 'DB.php';

    class UserModel {
        private $email;
        private $login;
        private $pass;
        private $re_pass;

        private $_db = null;

        // Подключение к базе данных.
        public function __construct() {
            $this->_db = DB::getInstence();
        }

        // Устанавливает значения для свойств класса.
        public function setData($email, $login, $pass, $re_pass) {
            $this->email = $email;
            $this->login = $login;
            $this->pass = $pass;
            $this->re_pass = $re_pass;
        }

        // Проверяет корректность введенных данных.
        public function validForm() {
            if(strlen($this->email) < 3)
                return "Email слишком короткий";
            else if(strlen($this->login) < 3)
                return "Логин слишком короткий";
            else if($this->isLoginExists($this->login))
                return "Пользователь с таким логином уже существует";
            else if(strlen($this->pass) < 3)
                return "Пароль не менее 3 символов";
            else if($this->pass != $this->re_pass)
                return "Пароли не совпадают";
            else
                return "Верно";
        }

        // Получает данные пользователя по login из БД и проверяет существования логина
        public function isLoginExists($login) {
            $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
            return $result->fetchColumn() > 0; // Возвращает true, если логин существует
        }

        // Добавляет пользователя в БД.
        public function addUser() {
            $sql = 'INSERT INTO users(email, login, pass) VALUES(:email, :login, :pass)';
            $query = $this->_db->prepare($sql);

            $pass = password_hash($this->pass, PASSWORD_DEFAULT);
            $query->execute(['email' => $this->email, 'login' => $this->login, 'pass' => $pass]);

            $this->setAuth($this->login);
        }

        // Получает данные пользователя по login из БД.
        public function getUser() {
            $login = $_COOKIE['log'];
            $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }

        // Выход из аккаунта.
        public function logOut() {
            setcookie('log', $this->login, time() - 3600, '/');
            unset($_COOKIE['log']);
            header('Location: /user/auth');
        }

        // Авторизация пользователя.
        public function auth($login, $pass) {
            $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
            $user = $result->fetch(PDO::FETCH_ASSOC);

            if($user['login'] == '')
                return 'Пользователя с таким Логином не существует';
            else if(password_verify($pass, $user['pass']))
                $this->setAuth($login);
            else
                return 'Пароли не совпадают';
        }

        // Устанавливает cookie и переадресовывает на кабинет пользователя.
        public function setAuth($login) {
            setcookie('log', $login, time() + 3600, '/');
            header('Location: /user/index');
        }
    }