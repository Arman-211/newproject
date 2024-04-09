<?php
class NotebookService {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createRecord($fullName, $company, $phone, $email, $birthDate, $photo): bool
    {
        $sql = "INSERT INTO notebook (full_name, company, phone, email, birth_date, photo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssss", $fullName, $company, $phone, $email, $birthDate, $photo);

        if (!$stmt->execute()) {
            echo "Ошибка выполнения запроса: " . $stmt->error;
            return false;
        }

        $insertedId = $stmt->insert_id;

        echo "Запись успешно добавлена. ID новой записи: " . $insertedId;

        return $insertedId;
    }

    public function readRecord($id) {
        $sql = "SELECT * FROM notebook WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateRecord($id, $fullName, $company, $phone, $email, $birthDate, $photo) {
        $sql = "UPDATE notebook SET full_name = ?, company = ?, phone = ?, email = ?, birth_date = ?, photo = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssssi", $fullName, $company, $phone, $email, $birthDate, $photo, $id);
        return $stmt->execute();
    }

    public function deleteRecord($id) {
        $sql = "DELETE FROM notebook WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
