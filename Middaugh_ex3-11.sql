INSERT INTO users (email_address, first_name, last_name) VALUES
('user1@gmail.com', 'John', 'DOE'),
('user2@gmail.com', 'Jane', 'DOE');

INSERT INTO products (product_name) VALUES
('Product 1'),
('Product 2');

INSERT INTO downloads (user_id, product_id, download_date, file_name) VALUES
(1, 2, NOW(),'file1.txt'),
(2, 1, NOW(),'file2.txt'),
(2, 2, NOW(),'file3.text');