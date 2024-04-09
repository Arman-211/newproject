CREATE DATABASE IF NOT EXISTS notebook;

USE notebook;

CREATE TABLE notebook
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    full_name  VARCHAR(255) NOT NULL,
    company    VARCHAR(255),
    phone      VARCHAR(20)  NOT NULL,
    email      VARCHAR(255) NOT NULL,
    birth_date DATE,
    photo      VARCHAR(255)
);