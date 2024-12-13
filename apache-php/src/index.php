<?php 
require_once '/var/www/vendor/autoload.php';
require_once 'application/core/session_reader.php';
require_once 'application/core/localizator.php';
require_once "application/router.php";
require_once "application/controllers/user_controller.php";
require_once "application/controllers/service_controller.php";
require_once "application/controllers/pdf_controller.php";
require_once "application/controllers/menu_controller.php";
require_once "application/controllers/fixture_controller.php";

applyStyle();

$action = (isset($_GET["action"])) ? $_GET["action"] : null;

if ($action == null) {
    echo "<script>window.location = 'index.html';</script>";
}
else {
    $userController = new UserController();
    $serviceController = new ServiceController();
    $pdfController = new PDFController();
    $menuController = new MenuController();
    $fixtureController = new FixtureController();
    $router = new Router();
    $router->bind_controllers($userController, $serviceController, $pdfController, $menuController, $fixtureController);
    $router->route($action);
}
?>