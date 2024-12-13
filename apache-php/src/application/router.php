<?php 

require_once "application/core/controller.php";

class Router {
    private $userController = null;
    private $serviceController = null;
    private $pdfController = null;
    private $menuController = null;
    private $fixtureController = null;

    function __construct() {

    }

    function bind_controllers($user, $service, $pdf, $menu, $fixtures) {
        $this->userController = $user;
        $this->serviceController = $service;
        $this->pdfController = $pdf;
        $this->menuController = $menu;
        $this->fixtureController = $fixtures;
    }

    function route($action) {
        switch ($action) {
            case "user_list":
            case "user_create":
            case "user_delete":
            case "user_update":
                $this->userController->action_index($action);
                break;
            case "service_list":
            case "service_create":
            case "service_delete":
            case "service_update":
                $this->serviceController->action_index($action);
                break;
            case "admin_menu":
            case "settings":
                $this->menuController->action_index($action);
                break;
            case "pdf_upload":
            case "pdf_delete":
            case "pdf_list":
                $this->pdfController->action_index($action);
                break;
            case "fixtures_generate":
            case "fixtures_stats":
                $this->fixtureController->action_index($action);
        }
    }
}
?>