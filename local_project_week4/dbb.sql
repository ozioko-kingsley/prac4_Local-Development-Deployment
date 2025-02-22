-- Create database
CREATE DATABASE IF NOT EXISTS skilllink_db;
USE skilllink_db;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create skilllink_users table to store career recommendations
CREATE TABLE IF NOT EXISTS skilllink_users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    skills TEXT NOT NULL,
    interests TEXT NOT NULL,
    career_recommendation TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
