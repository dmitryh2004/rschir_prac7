<?php 
require_once("application/core/model.php");
require_once("application/core/functions.php");

class User extends Model {
    private int $id;
    private string $name;
    private string $password;
    private $database;

    public function __construct() {
        $this->database = openMysqli();
    }

    public function __destruct() {
        $this->database->close();
    }

    public function get_all() {
        $stmt = $this->database->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function get($id) {
        $stmt = $this->database->prepare("SELECT * FROM users WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        if ($result) {
            $data = $result->fetch_assoc();
        }

        return $data;
    }

    public function delete($id) {
        try {
            if ($this->get($id) == []) {
                return [false, "Пользователь с таким ID не существует."];
            }
            $stmt = $this->database->prepare("DELETE FROM users WHERE ID=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return [true];
        }
        catch (Throwable $ex) {
            return [false, "Ошибка при обработке: " . $ex];
        }
    }

    public function create($data) {
        try {
            $this->name = $data[0];
            $this->password = hash_password($data[1]);

            $stmt = $this->database->prepare("INSERT INTO users (name, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $this->name, $this->password);
            $stmt->execute();
            return [true];
        }
        catch (Throwable $ex) {
            return [false, "Ошибка при обработке: " . $ex];
        }
    }

    public function update($id, $data) {
        try {
            if ($this->get($id) == []) {
                return [false, "Пользователь с таким ID не существует."];
            }

            $this->name = $data[0];
            $this->password = hash_password($data[1]);

            $stmt = $this->database->prepare("UPDATE users SET name=?, password=? WHERE ID=?");
            $stmt->bind_param("ssi", $this->name, $this->password, $id);
            $stmt->execute();
            return [true];
        }
        catch (Throwable $ex) {
            return [false, "Ошибка при обработке: " . $ex];
        }
    }
}
?>