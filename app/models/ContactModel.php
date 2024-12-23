<?php
    // Подключаем библиотеку PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Загрузка автозагрузчика Composer 
    require 'vendor/autoload.php';

    class ContactModel {
        private $name;
        private $email;
        private $age;
        private $message;
        private $mail;

        // Устанавливает значения для свойств класса.
        public function setData($name, $email, $age, $message) {
            $this->name = $name;
            $this->email = $email;
            $this->age = $age;
            $this->message = $message;
            $this->mail = new PHPMailer(true);
        }

        // Проверяет корректность введенных данных.
        public function validForm() {
            if(strlen($this->name) < 3)
                return "Имя слишком короткое";
            else if(strlen($this->email) < 3)
                return "Email слишком короткий";
            else if(!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
                return "Вы ввели не возраст";
            else if(strlen($this->message) < 5)
                return "Сообщение слишком короткое";
            else
                return "Верно";
        }

        public function sendMail() {

            try {
                // Настройки сервера
                // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER; - режим отладки для получения детализированной информации о процессе отправки
                $this->mail->SMTPDebug = 0;
                $this->mail->isSMTP();  
                $this->mail->Host = 'smtp.mail.ru';
                $this->mail->SMTPAuth = true;
                $this->mail->Username = 'byc14@mail.ru'; 
                $this->mail->Password = '...'; // тут необходимо указать пароль для внешних приложений
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $this->mail->Port = 587;  
                $this->mail->CharSet = 'UTF-8';

                // Отправитель
                $this->mail->setFrom('byc14@mail.ru', 'Татьяна'); 
                // Получатель
                $this->mail->addAddress('byc14@mail.ru', 'Татьяна');

                // Контент
                $body = 'Имя: ' . $this->name . '. Возраст: ' . $this->age . '. Email для ответа: ' . $this->email . '. Сообщение: ' . $this->message;

                $this->mail->Subject = 'Сообщение с сайта'; 
                $this->mail->msgHTML($body);

                // Отправка сообщения
                $this->mail->send();
                return 'Сообщение отправлено';
            } catch (Exception $e) {
                return "Сообщение не может быть отправлено. Ошибка почтовой программы: {$this->mail->ErrorInfo}";
            }
        }
    }