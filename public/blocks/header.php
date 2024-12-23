<header>
    <div class="container menu">
        <div class="logo">
            <img src="/public/img/logo.png" alt="Logo">
            <span>Уберем все</br> лишнее из ссылки!</span>
        </div>

        <div class="nav">
            <a href="/">Главная</a>
            <a href="/contact">Контакты</a>

            <?php if(!isset($_COOKIE['log']) || $_COOKIE['log'] == ''): ?>
                <a href="/user/auth">Войти</a>
            <?php else: ?>
                <a href="/user/index">Кабинет пользователя</a>
            <?php endif; ?>
        </div>
    </div>
</header>