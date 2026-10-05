-- Jobsheet 8: initial schema for the simpus_mini database (PostgreSQL)
-- Run this after creating the database, e.g.:
--   createdb simpus_mini
--   psql -d simpus_mini -f sql/01_books_members.sql

CREATE TABLE IF NOT EXISTS books (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    year INTEGER NOT NULL,
    isbn VARCHAR(50),
    stock INTEGER NOT NULL DEFAULT 0,
    category VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS members (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    member_id VARCHAR(50) NOT NULL UNIQUE,
    address VARCHAR(255),
    phone VARCHAR(30)
);
