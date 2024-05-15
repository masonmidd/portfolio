DROP DATABASE IF EXISTS my_web_db;
CREATE DATABASE my_web_db CHARACTER SET utf8mb4;

USE my_web_db;

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email_address VARCHAR(100),
    first_name VARCHAR(45),
    last_name VARCHAR(45)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE downloads (
    download_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    product_id INT,
    download_date DATETIME,
    file_name VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users (user_id),
    FOREIGN KEY (product_id) REFERENCES Products (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_user_id ON downloads (user_id);
CREATE INDEX idx_product_id ON downloads (product_id);
