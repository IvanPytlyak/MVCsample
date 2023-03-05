<?php


define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..'); // выход из папки config, если нужно выйти на несколько уровней применяем \..\..\..\
// определяет глобальную переменную типа стринг содержащую путь, можно вызвать в любом файле
define('ROUTES_CONFIG', __DIR__ . DIRECTORY_SEPARATOR . 'routes.php');
define('CONTROLLER_NAMESPACE', 'User\\Test\\controller');
define('TEMPLATES_PATH', ROOT_DIR . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'templates');
define('PAGES_PATH', ROOT_DIR . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'pages');
