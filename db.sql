-- Create the database
CREATE DATABASE hms;
USE hms;

-- Create the Admin table
CREATE TABLE admin (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    profile VARCHAR(100) NOT NULL
);

-- Create the Doctors table
CREATE TABLE doctors (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    gender VARCHAR(100) NOT NULL,
    phone VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    salary VARCHAR(100) NOT NULL,
    data_reg VARCHAR(100) NOT NULL,
    status VARCHAR(100) NOT NULL,
    profile VARCHAR(100) NOT NULL
);
