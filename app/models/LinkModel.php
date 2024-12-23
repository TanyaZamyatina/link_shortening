<?php
    require 'DB.php';

    class LinkModel {
        private $longLink;
        private $shortLink;

        private $_db = null;

        // Подключение к базе данных.
        public function __construct() {
            $this->_db = DB::getInstence();
        }

        // Устанавливает значения для свойств класса.
        public function setData($longLink, $shortLink) {
            $this->longLink = $longLink;
            $this->shortLink = $shortLink;
        }

        // Проверяет корректность введенных данных.
        public function validLink() {
            if($this->isShortLinkExists($this->shortLink))
                return "Такое сокращение уже используется в базе";
            else
                return "Верно";
        }

        // Получает данные ссылки по shortLink из БД и проверяет существования shortLink
        public function isShortLinkExists($shortLink) {
            $shortLink = 'http://localhost/'. $shortLink;
            $result = $this->_db->query("SELECT * FROM `links` WHERE `shortLink` = '$shortLink'");
            return $result->fetchColumn() > 0; // Возвращает true, если shortLink существует
        }

        // Добавляет ссылку в БД.
        public function addLink() {
            $sql = 'INSERT INTO links(longLink, shortLink, user_login) VALUES(:longLink, :shortLink, :user_login)';
            $query = $this->_db->prepare($sql);

            $shortLink = 'http://localhost/' . $this->shortLink;
            $user_login = $_COOKIE['log'];
            $query->execute(['longLink' => $this->longLink, 'shortLink' => $shortLink, 'user_login' => $user_login]);
        }

        // Получает все ссылки пользователя по user_login из БД.
        public function getLink() {
            $user_login = $_COOKIE['log'];
            $result = $this->_db->query("SELECT * FROM `links` WHERE `user_login` = '$user_login'");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        // Удаляет ссылку пользователя по shortLink из БД.
        public function delLink($shortLink) {
            $this->_db->query("DELETE FROM `links` WHERE `shortLink` = '$shortLink'");
        }

        // Перенаправляет на оригинальную ссылку по короткой ссылке
        public function linkRedirect($shortLink) {

            $result = $this->_db->query("SELECT longLink FROM `links` WHERE `shortLink` = '$shortLink'");
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $longLink = $row['longLink'];
            header("Location: " . $longLink);   
        }
    }