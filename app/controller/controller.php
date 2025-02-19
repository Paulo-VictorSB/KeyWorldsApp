<?php

require_once('config/config.php');
require_once('config/database.php');

$routes = require_once('routes/routes.php');

$route = $_GET['route'] ?? 'index';

if(!in_array($route, $routes)){
    $route = '404';
}

switch($route){
    case '404':
        require_once('app/view/inc/header.php');
        require_once('app/view/404.php');
        break;
    case 'login':
        require_once('app/view/inc/header.php');
        require_once('app/view/login.php');
        break;
    case 'forgot_password':
        require_once('app/view/inc/header.php');
        require_once('app/view/forgot_password.php');
        break;
    case 'register':
        require_once('app/view/inc/header.php');
        require_once('app/view/register.php');
        break;
    case 'home':
        require_once('app/view/inc/header.php');
        require_once('app/view/home.php');
        require_once('app/view/inc/footer.php');
        break;
    case 'termos':
        require_once('app/view/inc/header.php');
        require_once('app/view/termos.php');
        require_once('app/view/inc/footer.php');
        break;
    default:
        require_once('app/view/inc/header.php');
        require_once('app/view/index.php');
        require_once('app/view/inc/footer.php');
        break;
}