<?php 
require_once "application/core/controller.php";
require_once "application/models/user.php";
require_once "application/views/pdf_view.php";

class PDFController extends Controller {
    function __construct() {
        $this->model = new User();
        $this->view = new PDFView("pdf/pdf_list");
        $this->message = "";
    }

    public function action_index() {
        $action = (isset($_GET["action"]) ? $_GET["action"] : null);
        switch ($action) {
            case "pdf_upload":
                if (isset($_GET["state"]) && ($_GET["state"] == "post")) {
                    $this->pdf_upload_post();
                }
                else {
                    $this->pdf_upload();
                }
                break;
            case "pdf_delete":
                $this->pdf_delete();
                break;
            case "pdf_list":
            default:
                $this->action_view();
        }
    }
    
    public function action_view() {
        $data = $this->model->get_all();

        $user_id = null;

        foreach ($data as $item) {
            if ($item["name"] == $_SERVER['REMOTE_USER']) { $user_id = $item["ID"]; break; }
        }

        $data = [];
        if ($user_id == null) {
            $data["directory"] = null;
        }
        else {
            $data["directory"] = "storage/pdfs/$user_id/";
        }
        $data["user_id"] = $user_id;
        $this->view->generate(null, $data, $this->message);
    }

    public function pdf_delete() {
        global $language;
        if (isset($_GET['filepath'])) {
            $filePath = $_GET['filepath']; // Получаем путь к файлу из GET-запроса
        
            // Проверяем, существует ли файл
            if (file_exists($filePath)) {
                // Удаляем файл
                if (unlink($filePath)) {
                    $this->message = getLocalizedText("file-delete-success", $language);
                } else {
                    $this->message = getLocalizedText("file-delete-error", $language);
                }
            } else {
                $this->message = getLocalizedText("file-delete-not-found", $language);
            }
        } else {
            $this->message = getLocalizedText("file-delete-not-selected", $language);
        }
        $this->action_view();
    }

    public function pdf_upload() {
        $data = $this->model->get_all();

        $user_id = null;

        foreach ($data as $item) {
            if ($item["name"] == $_SERVER['REMOTE_USER']) { $user_id = $item["ID"]; break; }
        }

        $this->view->generate("pdf/pdf_upload", ["user_id" => $user_id]);
    }

    public function pdf_upload_post() {
        global $language;

        $data = $this->model->get_all();

        $user_id = null;

        foreach ($data as $item) {
            if ($item["name"] == $_SERVER['REMOTE_USER']) { $user_id = $item["ID"]; break; }
        }

        $target_dir = "storage/pdfs/$user_id/";

        // Создаем директорию, если она не существует
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $target_file = $target_dir . basename($_FILES["pdf_file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Проверка на тип файла
        if ($fileType != "pdf") {
            $this->message = htmlspecialchars(getLocalizedText("error-only-pdf-accepted", $language));
            $uploadOk = 0;
        }

        // Проверка на существование файла
        if (file_exists($target_file)) {
            $this->message = htmlspecialchars(getLocalizedText("error-file-already-exists", $language));
            $uploadOk = 0;
        }

        // Проверка размера файла (например, максимум 5MB)
        if ($_FILES["pdf_file"]["size"] > 5000000) {
            $this->message = htmlspecialchars(getLocalizedText("error-file-too-big", $language));
            $uploadOk = 0;
        }

        // Если все проверки пройдены, загружаем файл
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $target_file)) {
                $this->message = getLocalizedText("file", $language) . htmlspecialchars(basename($_FILES["pdf_file"]["name"])) . getLocalizedText("uploaded", $language);
            } else {
                $this->message = getLocalizedText("upload-error", $language);
            }
        }
        $this->action_view();
    }
}
?>