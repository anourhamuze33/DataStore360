CREATE TABLE core.customers (
    customer_id VARCHAR(50) PRIMARY KEY,
    customer_name VARCHAR(64) NOT NULL,
    segment VARCHAR(100),
    country VARCHAR(100),
    city VARCHAR(100),
    state VARCHAR(100),
    postal_code VARCHAR(20),
    region VARCHAR(100)
);

CREATE TABLE core.products (
    product_id VARCHAR(50) PRIMARY KEY,
    category VARCHAR(100),
    sub_category VARCHAR(100),
    product_name TEXT NOT NULL
);

CREATE TABLE core.orders (
    row_id INTEGER PRIMARY KEY,
    order_id VARCHAR(50) NOT NULL,
    customer_id VARCHAR(50) NOT NULL,
    product_id VARCHAR(50) NOT NULL,
    order_date DATE NOT NULL,
    ship_date DATE NOT NULL,
    ship_mode VARCHAR(50),
    sales NUMERIC,
    quantity INTEGER,
    discount NUMERIC,
    profit NUMERIC,
    delivery_time INTEGER,
    profit_margin NUMERIC,
    CONSTRAINT fk_orders_customer
        FOREIGN KEY (customer_id)
        REFERENCES core.customers(customer_id),
    CONSTRAINT fk_orders_product
        FOREIGN KEY (product_id)
        REFERENCES core.products(product_id)
);