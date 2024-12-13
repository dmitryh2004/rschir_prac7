<?php 
require_once("application/core/model.php");
require_once("application/core/functions.php");

class Service extends Model {
    private int $id;
    private string $title;
    private string $description;
    private int $cost;
    private $database;

    public function __construct() {
        $this->database = openMysqli();
    }

    public function __destruct() {
        $this->database->close();
    }

    public function get_all() {
        $stmt = $this->database->prepare("SELECT * FROM services");
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
        $stmt = $this->database->prepare("SELECT * FROM services WHERE ID=?");
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
                return [false, "Услуга с таким ID не существует."];
            }
            
            $stmt = $this->database->prepare("DELETE FROM services WHERE ID=?");
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
            $this->title = $data[0];
            $this->description = $data[1];
            $this->cost = $data[2];

            $stmt = $this->database->prepare("INSERT INTO services (title, description, cost) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $this->title, $this->description, $this->cost);
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
                return [false, "Услуга с таким ID не существует."];
            }

            $this->title = $data[0];
            $this->description = $data[1];
            $this->cost = $data[2];

            $stmt = $this->database->prepare("UPDATE services SET title=?, description=?, cost=? WHERE ID=?");
            $stmt->bind_param("ssii", $this->title, $this->description, $this->cost, $id);
            $stmt->execute();
            return [true];
        }
        catch (Throwable $ex) {
            return [false, "Ошибка при обработке: " . $ex];
        }
    }
}
?>