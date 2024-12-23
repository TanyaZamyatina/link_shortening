<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <meta name="description" content="Авторизация">

    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">

        <h1>Авторизация</h1>
        
        <p>Здесь вы можете авторизоваться на сайте</p>

        <form action="/user/auth" method="POST" class="form">
            <input type="text" name="login" placeholder="Введите логин" value="<?php echo isset($_POST['login']) ? $_POST['login'] : ''; ?>"><br>
            <input type="password" name="pass" placeholder="Введите пароль" value="<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>"><br>
            <div class="error"><?php echo isset($data['message']) ? htmlspecialchars($data['message']) : ''; ?> </div>
            <button class="btn" id="send">Готово</button>
        </form>
        
    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>
</html>