CREATE OR REPLACE VIEW customer_addresses AS
SELECT
    c.customer_id,
    c.email_address,
    c.last_name,
    c.first_name,
    a.line1 AS bill_line1,
    a.line2 AS bill_line2,
    a.city AS bill_city,
    a.state AS bill_state,
    a.zip_code AS bill_zip,
    b.line1 AS ship_line1,
    b.line2 AS ship_line2,
    b.city AS ship_city,
    b.state AS ship_state,
    b.zip_code AS ship_zip
FROM customers c LEFT JOIN addresses a ON c.billing_address_id = a.address_id
LEFT JOIN addresses b ON c.shipping_address_id = b.address_id

