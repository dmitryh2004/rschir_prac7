<?php 
require_once "application/core/controller.php";
require_once "application/models/user.php";
require_once "application/views/user_view.php";

class UserController extends Controller {
    function __construct() {
        $this->model = new User();
        $this->view = new UserView("users/user_list");
        $this->message = "";
    }

    public function action_index() {
        $action = (isset($_GET["action"]) ? $_GET["action"] : null);
        switch ($action) {
            case "user_list":
                $this->user_list();
                break;
            case "user_create":
                if (isset($_GET["state"]) && ($_GET["state"] == "post")) {
                    $this->user_create_post();
                }
                else {
                    $this->user_create();
                }
                break;
            case "user_delete":
                if (!isset($_GET["id"])) {
                    $this->user_list("Ошибка: не передан id пользователя.");
                }
                else {
                    $id = $_GET["id"];
                    if (isset($_GET["state"]) && ($_GET["state"] == "post")) {
                        $this->user_delete_post($id);
                    }
                    else {
                        $this->user_delete($id);
                    }
                }
                break;
            case "user_update":
                if (!isset($_GET["id"])) {
                    $this->user_list("Ошибка: не передан id пользователя.");
                }
                else {
                    $id = $_GET["id"];
                    if (isset($_GET["state"]) && ($_GET["state"] == "post")) {
                        $this->user_update_post($id);
                    }
                    else {
                        $this->user_update($id);
                    }
                }
                break;
            default:
                $this->action_view();
        }
    }
    
    public function action_view() {
        $data = $this->model->get_all();
        $this->view->generate(null, $data, $this->message);
    }

    public function user_list() {
        $data = $this->model->get_all();
        $this->view->generate("users/user_list", $data, $this->message);
    }

    public function user_create() {
        $this->view->generate("users/user_create", null);
    }

    public function user_create_post() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $password = $_POST["password"];
        
            $success = $this->model->create([$name, $password]);
            if ($success[0] == false) {
                $this->message = "Ошибка при создании пользователя. " . $success[1];
            }
            else {
                $this->message = "Пользователь создан успешно.";
            }
            $this->user_list();
        }
    }

    public function user_delete_post($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $success = $this->model->delete($id);
            if ($success[0] == false) {
                $this->message = "Ошибка при удалении пользователя с id=" . $id . ". " . $success[1];
            }
            else {
                $this->message = "Пользователь с id=" . $id . " удален успешно.";
            }
            $this->user_list();
        }
    }

    public function user_delete($id) {
        $data = $this->model->get($id);
        if ($data == []) {
            $this->message = "Пользователя с id=" . $id . " не существует.";
            $this->user_list();
        }
        else {
            $this->view->generate("users/user_delete", $data);
        }
    }

    public function user_update_post($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $password = $_POST["password"];
        
            $success = $this->model->update($id, [$name, $password]);
            if ($success[0] == false) {
                $this->message = "Ошибка при обновлении пользователя с id=" . $id . ". " . $success[1];
            }
            else {
                $this->message = "Пользователь с id=" . $id . " обновлен успешно.";
            }
            $this->user_list();
        }
    }

    public function user_update($id) {
        $data = $this->model->get($id);
        if ($data == []) {
            $this->message = "Пользователя с id=" . $id . " не существует.";
            $this->user_list();
        }
        else {
            $this->view->generate("users/user_update", $data);
        }
    }
}
?>