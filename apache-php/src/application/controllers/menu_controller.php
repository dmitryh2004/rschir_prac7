<?php 
require_once "application/core/controller.php";
require_once "application/views/menu_view.php";

class MenuController extends Controller {
    function __construct() {
        $this->view = new MenuView("menu/admin_menu");
    }

    public function action_index() {
        $action = (isset($_GET["action"]) ? $_GET["action"] : null);
        switch ($action) {
            case "settings":
                $this->settings();
                break;
            case "admin_menu":
            default:
                $this->action_view();
        }
    }
    
    public function action_view() {
        $this->view->generate(null, null);
    }

    public function settings() {
        $this->view->generate("menu/settings", null);
    }
}
?>