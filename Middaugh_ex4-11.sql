SELECT email_address, first_name, last_name, download_date, file_name, product_name
FROM users U JOIN downloads D
ON u.user_id = d.user_id
JOIN products p
ON d.product_id = p.product_id

ORDER BY email_address DESC, product_name ASC