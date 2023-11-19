<?php

/* $request = $_SERVER['REQUEST_URI'];
define('BASE_PATH', '/Tourist-office-reservations/mvc/');

require_once  __DIR__.'/config/config.php';
require_once  __DIR__.'/app/controllers/BookingController.php';
require_once  __DIR__.'/app/models/BookingModel.php';
require_once  __DIR__.'/Lib/DB/MysqliDb.php';

$config = require __DIR__.'/config/config.php';
$db = new MysqliDb (
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$model = new BookingModel($db);
$controller = new BookingController($model);
?>
    <form method="post" action="add">

        <button type="submit">add</button>
    </form>
    
<?php
switch ($request) {
    case BASE_PATH:
        $controller->index();
        break;
    case BASE_PATH . "add":
        $controller->addBooking();
            break;
    case BASE_PATH . 'updata?id='.$_GET['id']:
        $controller->updataBooking();
            break;
    
    } */

?>