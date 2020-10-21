CREATE DATABASE 'pagination_ci4';

USE pagination_ci4;

CREATE TABLE TB_Posts(
    id INT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL
);

