<?php

require_once('../vendor/autoload.php');
require_once('..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'parameters.php');

use User\Test\Component\Router;
use User\Test\Component\Database;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->load(ROOT_DIR . DIRECTORY_SEPARATOR . '.env'); // $_ENV создает суперглобальный массив

Database::initConnection();

$router = new Router(require_once(ROUTES_CONFIG));
$router->run();
