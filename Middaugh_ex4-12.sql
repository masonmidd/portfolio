CREATE OR REPLACE VIEW order_item_products AS
SELECT
    o.order_id,
    o.order_date,
    o.tax_amount,
    o.ship_date,
    p.product_name,
    oi.item_price,
    oi.discount_amount,
	oi.quantity,
    (oi.item_price - oi.discount_amount) AS final_price, 
    (oi.quantity * oi.item_price) AS item_total
FROM orders o JOIN order_items oi ON o.order_id = oi.order_id
JOIN products p ON oi.product_id = p.product_id;
