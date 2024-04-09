<?php
use PHPUnit\Framework\TestCase;

class NotebookControllerTest extends TestCase
{
    public function testGetRecordById()
    {
        // Создаем экземпляр вашего контроллера или используем mock, если необходимо
        $controller = new NotebookController();

        // Предположим, что метод getRecordById возвращает JSON-ответ с кодом 200
        $expectedResponse = '{"id": 1, "title": "Example Title", "content": "Example Content"}';

        // Вызываем метод API
        $actualResponse = $controller->getRecordById(1);

        // Проверяем, что ответ соответствует ожиданиям
        $this->assertEquals($expectedResponse, $actualResponse);
    }
}