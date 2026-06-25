CREATE TABLE products
(
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    external_id         INT UNIQUE,
    title               VARCHAR(255),
    description         TEXT,
    price               DECIMAL(10, 2),
    brand               VARCHAR(100) NULL,
    category            VARCHAR(100),
    discount_percentage DECIMAL(5, 2),
    thumbnail           TEXT
);