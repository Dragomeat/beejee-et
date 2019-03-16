<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link rel="stylesheet" href="<?= $this->asset('/css/main.css') ?>">

    <title><?= $this->e($title) ?></title>
</head>
<body>

<div id="app">
    <nav class="navbar navbar-expand-md navbar-light my-navbar">
        <div class="container">
            <a class="navbar-brand" href="/tasks">
                BeeJeeET
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                </ul>

                <ul class="navbar-nav ml-auto">
                    <?php if (!$this->auth()->isAuthenticated()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Войти</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <?= $this->auth()->getUser()->getName() ?> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" id="logout-button" href="/logout">
                                    Выйти
                                </a>

                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    <input type="hidden" name="<?= $this->csrf()->getFormKey() ?>"
                                           value="<?= $this->csrf()->generateToken() ?>"/>
                                </form>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <?= $this->section('content') ?>
    </main>
</div>
<script src="<?= $this->asset('/js/main.js') ?>"></script>
</body>
</html>
