create table if not exists products
(
id             INTEGER
        constraint products_pk
      primary key autoincrement,
      productName TEXT,
      category TEXT,
      quantity INTEGER,
      price REAL,
      image TEXT,
      code TEXT
);