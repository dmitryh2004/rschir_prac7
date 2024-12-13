<?php
class Controller {
    public $model;
    public $view;
    private $message;

    function __construct() {

    }

    public function action_index() {
        $action = (isset($_GET["action"]) ? $_GET["action"] : null);
        if ($action == null) {
            $this->action_view();
        }
    }

    public function action_view() {
        $this->view->generate();
    }
}
?>