<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Обратная связь</title>
    <meta name="description" content="Обратная связь">

    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">

        <h1>Обратная связь</h1>

        <p>Напишите нам, если у вас есть вопросы</p>

        <form action="contact/index" method="POST" class="form">
            <input type="text" name="name" placeholder="Введите имя" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"><br>
            <input type="email" name="email" placeholder="Введите email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"><br>
            <input type="text" name="age" placeholder="Введите возраст" value="<?php echo isset($_POST['age']) ? $_POST['age'] : ''; ?>"><br>
            <textarea name="message" placeholder="Введите само сообщение"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea><br>
            <div class="error"><?php echo isset($data['message']) ? htmlspecialchars($data['message']) : ''; ?> </div>
            <button class="btn" id="send">Отправить</button>
        </form>

    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>
</html>