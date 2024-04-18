CREATE DATABASE proyect_Ticos_Rides;

USE proyect_Ticos_Rides;

CREATE TABLE IF NOT EXISTS users(
    id INT  PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    confirm_password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS rides (
 id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
 ride_name VARCHAR(255) NOT NULL,
 start_from VARCHAR(255) NOT NULL,
 end_to VARCHAR(255) NOT NULL,
 description VARCHAR(255) NOT NULL,
 departure_time TIME NOT NULL,
 arrival_time TIME NOT NULL,
 days VARCHAR(255) not NULL,
 user_id INT NOT NULL,
 FOREIGN KEY (user_id) REFERENCES users(id)
);