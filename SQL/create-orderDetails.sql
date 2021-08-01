create table if not exists orderDetails
(
    orderDetails_id INTEGER not null
primary key autoincrement,
orderCode TEXT not null,
customerID INTEGER not null,
productCode TEXT not null,
orderDate DATETIME,
quantity INTEGER,
status TEXT default 'open' not null
);