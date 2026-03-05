<!DOCTYPE html>
<html>
    <head>
        <?php wp_head(); ?>
            
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?= get_template_directory_uri(); ?>/images/favicon.ico">
        <title>調査法人ツミトル</title>
        <meta property="og:title" content="調査法人ツミトル">
        <meta property="og:description" content="調査法人ツミトルは、">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <meta property="og:site_name" content="調査法人ツミトル">
        <meta name="twitter:card" content="summary_large_image">

        <link href="https://www.tsumitoru.com/wp-content/themes/tsumitoru/css/fontawesome-free-7.1.0-web/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://www.tsumitoru.com/wp-content/themes/tsumitoru/css/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>

    <body>

        <header id="header" class="header pc">
            <div class="header__inner">
                <h1 class="header__title"> <a href="https://www.tsumitoru.com/"><img src="<?= get_template_directory_uri(); ?>/images/logo.png" alt="調査法人ツミトル"></a></h1>
                <nav class="header__nav">
                    <ul class="header__list">
                    <li class="header__list-item"><a href="https://www.tsumitoru.com/">HOME</a></li>
                    <li class="header__list-item"><a href="https://www.tsumitoru.com/#service">サービス</a></li>
                    <li class="header__list-item"><a href="https://www.tsumitoru.com/#flow">利用の流れ</a></li>
                    <li class="header__list-item"><a href="https://www.tsumitoru.com/#faq">FAQ</a></li>
                    <li class="header__list-item"><a href="https://www.tsumitoru.com/#contact">問合せ</a></li>
                    <li class="header__list-item"><a href="https://www.tsumitoru.com/news/">コラム</a></li>
                    <li class="header__list-item header__list-item--end"><a href="https://www.mitsutakeshoji.com/">会社情報</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <header class="sp_header sp">
            <div class="sp_header__box">
                <h1 class="header__title">
                <a href="https://www.tsumitoru.com/"><img src="<?= get_template_directory_uri(); ?>/images/logo.png" alt="調査法人ツミトル"></a>
                </h1>
                <div class="global__hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="menu">Menu</span>
                </div>
                <nav class="global__menu-sp">
                    <ul class="bold">
                    <li class="global__menu-item global__menu-item--sp"><a href="https://www.tsumitoru.com/">HOME</a></li>
                    <li class="global__menu-item global__menu-item--sp"><a href="https://www.tsumitoru.com/#service">サービス</a></li>
                    <li class="global__menu-item global__menu-item--sp"><a href="https://www.tsumitoru.com/#flow">利用の流れ</a></li>
                    <li class="global__menu-item global__menu-item--sp"><a href="https://www.tsumitoru.com/#faq">FAQ</a></li>
                    <li class="global__menu-item global__menu-item--sp"><a href="https://www.tsumitoru.com/#contact">問合せ</a></li>
                    <li class="global__menu-item global__menu-item--sp"><a href="https://www.tsumitoru.com/news">コラム</a></li>
                    <li class="global__menu-item global__menu-item--sp"><a href="https://www.mitsutakeshoji.com/">会社情報</a></li>
                    </ul>
                </nav>
            </div>
        </header>





