<?php 
require_once "application/core/controller.php";
require_once "application/models/service.php";
require_once "application/views/service_view.php";

class ServiceController extends Controller {
    function __construct() {
        $this->model = new Service();
        $this->view = new ServiceView("services/service_list");
        $this->message = "";
    }

    public function action_index() {
        $action = (isset($_GET["action"]) ? $_GET["action"] : null);
        switch ($action) {
            case "service_list":
                $this->service_list();
                break;
            case "service_create":
                if (isset($_GET["state"]) && ($_GET["state"] == "post")) {
                    $this->service_create_post();
                }
                else {
                    $this->service_create();
                }
                break;
            case "service_delete":
                if (!isset($_GET["id"])) {
                    $this->service_list("Ошибка: не передан id услуги.");
                }
                else {
                    $id = $_GET["id"];
                    if (isset($_GET["state"]) && ($_GET["state"] == "post")) {
                        $this->service_delete_post($id);
                    }
                    else {
                        $this->service_delete($id);
                    }
                }
                break;
            case "service_update":
                if (!isset($_GET["id"])) {
                    $this->service_list("Ошибка: не передан id услуги.");
                }
                else {
                    $id = $_GET["id"];
                    if (isset($_GET["state"]) && ($_GET["state"] == "post")) {
                        $this->service_update_post($id);
                    }
                    else {
                        $this->service_update($id);
                    }
                }
                break;
            default:
                $this->action_view();
        }
    }
    
    public function action_view() {
        $data = $this->model->get_all();
        $this->view->generate(null, $data);
    }

    public function service_list() {
        $data = $this->model->get_all();
        $this->view->generate("services/service_list", $data, $this->message);
    }

    public function service_create() {
        $this->view->generate("services/service_create", null);
    }

    public function service_create_post() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $desc = $_POST["description"];
            $cost = $_POST["cost"];
        
            $success = $this->model->create([$title, $desc, $cost]);
            if ($success[0] == false) {
                $this->message = "Ошибка при создании услуги. " . $success[1];
            }
            else {
                $this->message = "Услуга создана успешно.";
            }
            $this->service_list();
        }
    }

    public function service_delete_post($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $success = $this->model->delete($id);
            if ($success[0] == false) {
                $this->message = "Ошибка при удалении услуги с id=" . $id . ". " . $success[1];
            }
            else {
                $this->message = "Услуга с id=" . $id . " удалена успешно.";
            }
            $this->service_list();
        }
    }

    public function service_delete($id) {
        $data = $this->model->get($id);
        if ($data == []) {
            $this->message = "Услуги с id=" . $id . " не существует.";
            $this->service_list();
        }
        else {
            $this->view->generate("services/service_delete", $data);
        }
    }

    public function service_update_post($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $desc = $_POST["description"];
            $cost = $_POST["cost"];
        
            $success = $this->model->update($id, [$title, $desc, $cost]);
            if ($success[0] == false) {
                $this->message = "Ошибка при обновлении услуги с id=" . $id . ". " . $success[1];
            }
            else {
                $this->message = "Услуга с id=" . $id . " обновлена успешно.";
            }
            $this->service_list();
        }
    }

    public function service_update($id) {
        $data = $this->model->get($id);
        if ($data == []) {
            $this->message = "Услуги с id=" . $id . " не существует.";
            $this->service_list();
        }
        else {
            $this->view->generate("services/service_update", $data);
        }
    }
}
?>