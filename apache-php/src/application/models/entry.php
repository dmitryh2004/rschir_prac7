<?php 
require_once("application/core/model.php");
require_once("application/core/functions.php");

require_once("application/models/service.php");

class Entry extends Model {
    private int $entry_id;
    private string $customer_name;
    private int $service_id;
    private int $amount;
    private $comment;
    
    private $database;

    public function __construct() {
        $this->database = openMysqli();
    }

    public function __destruct() {
        $this->database->close();
    }

    public function get_all_with_cost() {
        $query = "SELECT entry_id, customer_name, services.title, amount, comment, cost FROM entries INNER JOIN services on entries.service_id = services.ID ORDER BY entry_id";
        $stmt = $this->database->prepare($query);
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

    public function get_all($with_name = false) {
        $query = "";
        if ($with_name) {
            $query = "SELECT entry_id, customer_name, services.title, amount, comment FROM entries INNER JOIN services on entries.service_id = services.ID ORDER BY entry_id";
        }
        else {
            $query = "SELECT * FROM entries";
        }
        $stmt = $this->database->prepare($query);
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
        $stmt = $this->database->prepare("SELECT * FROM entries WHERE entry_id=?");
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
                return [false, "Запись с таким ID не существует."];
            }

            $stmt = $this->database->prepare("DELETE FROM entries WHERE entry_id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return [true];
        }
        catch (Throwable $ex) {
            return [false, "Ошибка при обработке: " . $ex];
        }
    }

    public function delete_all() {
        try {
            $stmt = $this->database->prepare("DELETE FROM entries");
            $stmt->execute();
            $stmt = $this->database->prepare("ALTER TABLE entries AUTO_INCREMENT = 1");
            $stmt->execute();
            return [true];
        }
        catch (Throwable $ex) {
            return [false, "Ошибка при обработке: " . $ex];
        }
    }

    public function fill($data_set) {
        try {
            foreach($data_set as $data) {
                $result = $this->create($data);
                if ($result[0] == false)
                {
                    return $result;
                }
            }
            return [true];
        }
        catch (Throwable $ex) {
            return [false, "Ошибка при обработке: " . $ex];
        }
    }

    public function create($data) {
        try {
            $this->customer_name = $data[0];
            $this->service_id = $data[1];
            $this->amount = $data[2];
            $this->comment = $data[3];

            $service = new Service();
            if ($service->get($this->service_id) == []) {
                return [false, "Отсутствует услуга с ID=" . $this->service_id];
            }

            $stmt = $this->database->prepare("INSERT INTO entries (customer_name, service_id, amount, comment) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siis", $this->customer_name, $this->service_id, $this->amount, $this->comment);
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
                return [false, "Запись с таким ID не существует."];
            }
            
            $this->title = $data[0];
            $this->description = $data[1];
            $this->cost = $data[2];

            $stmt = $this->database->prepare("UPDATE entries SET customer_name=?, service_id=?, amount=?, comment=? WHERE entry_id=?");
            $stmt->bind_param("siisi", $this->customer_name, $this->service_id, $this->amount, $this->comment, $id);
            $stmt->execute();
            return [true];
        }
        catch (Throwable $ex) {
            return [false, "Ошибка при обработке: " . $ex];
        }
    }
}
?>