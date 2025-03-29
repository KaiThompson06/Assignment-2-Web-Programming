CREATE table users (
   userId INT primary key auto_increment,
   username VARCHAR(255) NOT NULL UNIQUE,
   password VARCHAR(255) NOT NULL
);