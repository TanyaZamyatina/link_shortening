<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная страница</title>
    <meta name="description" content="Главная страница интернет магазина">

    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">

        <h1 class="title">Сокра.тим</h1>

        <?php if(!isset($_COOKIE['log']) || $_COOKIE['log'] == ''): ?>
            <div>
                <p>Вам нужно сократить ссылку?</br> Прежде чем это сделать, зарегистрируйтесь на сайте</p>

                <form action="/home/reg" method="POST" class="form">
                    <input type="email" name="email" placeholder="Введите email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"><br>
                    <input type="text" name="login" placeholder="Введите логин" value="<?php echo isset($_POST['login']) ? $_POST['login'] : ''; ?>"><br>
                    <input type="password" name="pass" placeholder="Введите пароль" value="<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>"><br>
                    <input type="password" name="re_pass" placeholder="Повторите пароль" value="<?php echo isset($_POST['re_pass']) ? $_POST['re_pass'] : ''; ?>">
                    <div class="error"><?php echo isset($data['message']) ? htmlspecialchars($data['message']) : ''; ?> </div>
                    <button class="btn" id="send">Зарегистрироваться</button>
                </form>

                <p>Есть аккаунт? Тогда вы можете <a href="/user/auth">авторизоваться</a></p>
            </div>
        <?php else: ?>
            <div>
                <p>Вам нужно сократить ссылку?</br> Сейчас мы это сделаем!</p>

                <form action="/home/index" method="POST" class="form">
                    <input type="text" name="longLink" placeholder="Длинная ссылка" value="<?php echo isset($_POST['longLink']) ? $_POST['longLink'] : ''; ?>"><br>
                    <input type="text" name="shortLink" placeholder="Короткое название"><br>
                    <div class="error"><?php echo isset($data['message']) ? htmlspecialchars($data['message']) : ''; ?> </div>
                    <button class="btn" id="send">Уменьшить</button>
                </form>
            </div>

            <div class="blockLinks">
                <?php if(count($data['link']) > 0): ?>
                    <h1>Сокращенные ссылки</h1>

                    <div class="links">
                        <?php for($i = 0; $i < count($data['link']); $i++): ?>
                            <div class="link">
                                <p><b>Длинная: </b><?=$data['link'][$i]['longLink']?></p>
                                <p><b>Короткая: </b><a href="<?=$data['link'][$i]['longLink']?>"><?=$data['link'][$i]['shortLink']?></a></p>

                                <form action="/home/index" method="POST" class="form">
                                    <input type="hidden" name="shortLink" value="<?=$data['link'][$i]['shortLink']?>">
                                    <button type="submit" class="btn btnDel">Удалить</button>
                                </form>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>
</html>