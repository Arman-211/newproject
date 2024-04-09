# My PHP Project

This is a simple PHP project with an API for managing notebook records.

## Description

This project provides a RESTful API for creating, reading, updating, and deleting notebook records. It's built using PHP
and can be easily integrated into other applications.

## Installation

To run the API, you need to have PHP installed on your machine.

1. Clone this repository to your local machine:

```bash
git clone https://github.com/your-username/my-php-project.git
```

### Navigate to the project directory:

```bash
cd my-php-project
```

### Start the PHP built-in server:

```bash
php -S localhost:8000
```

## Usage

### You can interact with the API using HTTP requests. Here are the available endpoints:

GET /record/{id}: Get a notebook record by ID

POST /record: Create a new notebook record

PUT /record/{id}: Update an existing notebook record

DELETE /record/{id}: Delete a notebook record by ID

### Example Requests and Responses

Get a notebook record by ID

#### Request:

```bash
GET /record/1
```

#### Response:

```bash
{
  "id": 1,
  "title": "Example Title",
  "content": "Example Content"
}
```

## Swagger Documentation

#### You can find the Swagger documentation for this API here.

## Testing

#### To run the unit tests for this project, you need to have PHPUnit installed. Install PHPUnit using Composer:

```bash
composer require --dev phpunit/phpunit
```

#### Then, run the tests:

```bash
vendor/bin/phpunit tests/NotebookControllerTest.php
```

## Contributing

#### Contributions are welcome! If you find any issues or have suggestions for improvement, please open an issue or submit a pull request.

