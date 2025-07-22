-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS football_scout;

-- Create additional user with full privileges
CREATE USER IF NOT EXISTS 'football_user'@'%' IDENTIFIED BY 'football_password';
GRANT ALL PRIVILEGES ON football_scout.* TO 'football_user'@'%';
FLUSH PRIVILEGES;

-- Use the database
USE football_scout;
