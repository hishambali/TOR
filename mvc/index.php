<?php


session_start();
if (isset($_SESSION['email'])) {
    echo 'gi';
require_once __DIR__ . '/config/config.php';
SPL_autoload_register(function($class){
    if(file_exists(__DIR__.'/app/controllers/'.$class.'.php'))
        {
        require __DIR__.'/app/controllers/'.$class.'.php';
        }
    if(file_exists(__DIR__ . '/lib/DB/'.$class.'.php'))
        {
        require __DIR__ . '/lib/DB/'.$class.'.php';
        }
});

$config = require 'config/config.php';
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$controller1 = new AdminController($db);
$controller2 = new BookingController($db);
$controller3 = new CityController($db);
$controller4 = new CompanyController($db);
$controller5 = new CustomerController($db);
$controller6 = new HotelController($db);
$controller7= new RateController($db);
$controller8 = new TicketController($db);

$request = $_SERVER['REQUEST_URI']; 
define('BASE_PATH', '/mvc/');
       /*  var_dump($request); */
switch ($request) {
            case BASE_PATH:
                 $controller1->index();
                /* echo "fkfkf"; */
                break;
            case BASE_PATH .'Admin/add':
                $controller1->addAdmin();
                break;
            case BASE_PATH .'Booking/show':
                $controller2->index();
                break;
            case BASE_PATH .'Booking/add':
                $controller2->addBooking();
                break;
            case BASE_PATH .'Booking/update?id=' . $_GET['id']:
                 $controller2->updataBooking($_GET['id']);
                break;
            case BASE_PATH .'Booking/delete?id=' . $_GET['id']:
                $controller2->deleteBooking($_GET['id']);
                break;
            case BASE_PATH . 'City/add':
                // var_dump($_SERVER);
                $controller3->addCity();
                break;
            case BASE_PATH . 'Company':
                // var_dump($_SERVER);
                $controller4->index();
                break;
            case BASE_PATH . 'Company/add':
                // var_dump($_SERVER);
                $controller4->addCompany();
                break;
            case BASE_PATH . 'Company/delete?id=' . $_GET['id']:
                // var_dump($_GET['id']);
                $controller4->deleteCompany($_GET['id']);
                break;
            case BASE_PATH . 'Customer/add':
                // var_dump($_SERVER);
                $controller5->addCustomer();
                break;
            case BASE_PATH . 'Customer/show':
                $controller5->showCustomers();
                break;
            case BASE_PATH . 'Customer/delete?id=' . $_GET['id']:
                // var_dump($_GET['id']);
                $controller5->deleteCustomer($_GET['id']);
                break;
            case BASE_PATH . 'Customer/update?id=' . $_GET['id']:
                $controller5->updateCustomer($_GET['id']);
                break;
            case BASE_PATH . 'Hotel/add':
                // var_dump($_SERVER);
                $controller6->addHotel();
                break;
            case BASE_PATH . 'Hotel/show':
                $controller6->showHotels();
                break;
            case BASE_PATH . 'Hotel/delete?id=' . $_GET['id']:
                // var_dump($_GET['id']);
                $controller6->deleteHotel($_GET['id']);
                break;
            case BASE_PATH . 'Hotel/update?id=' . $_GET['id']:
                $controller6->updateHotel($_GET['id']);
                break;
            case BASE_PATH . 'Rate/add' :
                $controller7->addRate();
                break;
            case BASE_PATH . 'Ticket/add' :
                $controller8->addTicket();
                break;
            case BASE_PATH . 'Ticket/delete?id=' . $_GET['id']:
                // var_dump($_GET['id']);
                $controller8->deleteTicket($_GET['id']);
                break;
            default:
            // var_dump($request);
                break;
            }
}
else {
   
    require_once __DIR__ . '/config/config.php';
SPL_autoload_register(function($class){
    if(file_exists(__DIR__.'/app/controllers/'.$class.'.php'))
        {
        require __DIR__.'/app/controllers/'.$class.'.php';
        }
    if(file_exists(__DIR__ . '/lib/DB/'.$class.'.php'))
        {
        require __DIR__ . '/lib/DB/'.$class.'.php';
        }
});

$config = require 'config/config.php';
$db = new MysqliDb(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

$controller1 = new AdminController($db);
$x=$controller1->login($_POST["email"],$_POST['password']);

}


?>
