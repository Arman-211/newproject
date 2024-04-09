<?php

use JetBrains\PhpStorm\NoReturn;

require_once 'NotebookService.php';

class NotebookController {
    private NotebookService $service;

    public function __construct($db) {
        $this->service = new NotebookService($db);
    }

    #[NoReturn] public function handleRequest(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        echo "Request method: $method\n";

        // Получение данных из тела запроса POST
        $postData = file_get_contents('php://input');
        echo "POST data: $postData\n";

        switch ($method) {
            case 'GET':
                error_log('Method called: handlePostRequest');

                $id = $_GET['id'] ?? null;
                echo $this->handleGetRequest($id);
                break;
            case 'POST':
                error_log('Method called: handlePostRequest');

                $fullName = $_POST['full_name'] ?? null;
                $company = $_POST['company'] ?? null;
                $phone = $_POST['phone'] ?? null;
                $email = $_POST['email'] ?? null;
                $birthDate = $_POST['birth_date'] ?? null;
                $photo = $_POST['photo'] ?? null;
                echo $this->handlePostRequest($fullName, $company, $phone, $email, $birthDate, $photo);
                break;
            case 'PUT':
                parse_str(file_get_contents('php://input'), $putParams);
                $id = $putParams['id'] ?? null;
                $fullName = $putParams['full_name'] ?? null;
                $company = $putParams['company'] ?? null;
                $phone = $putParams['phone'] ?? null;
                $email = $putParams['email'] ?? null;
                $birthDate = $putParams['birth_date'] ?? null;
                $photo = $putParams['photo'] ?? null;
                echo $this->handlePutRequest($id, $fullName, $company, $phone, $email, $birthDate, $photo);
                break;
            case 'DELETE':
                $id = $_GET['id'] ?? null;
                echo $this->handleDeleteRequest($id);
                break;
            default:
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed'], JSON_UNESCAPED_UNICODE);
                break;
        }
    }

    private function handleGetRequest($id): bool|string
    {
        if ($id === null) {
            http_response_code(400);
            return json_encode(['error' => 'Missing ID parameter'], JSON_UNESCAPED_UNICODE);
        }

        $record = $this->service->readRecord($id);

        if ($record === null) {
            http_response_code(404);
            return json_encode(['error' => 'Record not found'], JSON_UNESCAPED_UNICODE);
        }

        return json_encode($record, JSON_UNESCAPED_UNICODE);
    }

    private function handlePostRequest($fullName, $company, $phone, $email, $birthDate, $photo): bool|string
    {
        if ($fullName === null || $phone === null || $email === null) {
            http_response_code(400);
            return json_encode(['error' => 'Missing required parameters'], JSON_UNESCAPED_UNICODE);
        }

        $id = $this->service->createRecord($fullName, $company, $phone, $email, $birthDate, $photo);
        return json_encode(['id' => $id, 'message' => 'Record created successfully'], JSON_UNESCAPED_UNICODE);
    }

    private function handlePutRequest($id, $fullName, $company, $phone, $email, $birthDate, $photo): bool|string
    {
        if ($id === null || $fullName === null || $phone === null || $email === null) {
            http_response_code(400);
            return json_encode(['error' => 'Missing required parameters'], JSON_UNESCAPED_UNICODE);
        }

        $success = $this->service->updateRecord($id, $fullName, $company, $phone, $email, $birthDate, $photo);

        if (!$success) {
            http_response_code(500);
            return json_encode(['error' => 'Failed to update record'], JSON_UNESCAPED_UNICODE);
        }

        return json_encode(['message' => 'Record updated successfully'], JSON_UNESCAPED_UNICODE);
    }

    private function handleDeleteRequest($id): bool|string
    {
        if ($id === null) {
            http_response_code(400);
            return json_encode(['error' => 'Missing ID parameter'], JSON_UNESCAPED_UNICODE);
        }

        $success = $this->service->deleteRecord($id);

        if (!$success) {
            http_response_code(500);
            return json_encode(['error' => 'Failed to delete record'], JSON_UNESCAPED_UNICODE);
        }

        return json_encode(['message' => 'Record deleted successfully'], JSON_UNESCAPED_UNICODE);
    }
}
?>
