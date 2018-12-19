
-- Base de datos curso Introduccion a PHP platzi

CREATE DATABASE IF NOT EXISTS platzi_curso DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE platzi_curso;

-- Create the table in the specified schema
CREATE TABLE tbl_users
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, -- primary key column
    mail varchar(60) NOT NULL,
    password text NOT NULL,
    image text,
    created_at DATETIME,
    updated_at DATETIME
    -- specify more columns here
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create the table in the specified schema
CREATE TABLE IF NOT EXISTS jobs
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, -- primary key column
    title text NOT NULL,
    description text NOT NULL,
    logo text,
    visible BOOLEAN NOT NULL,
    months TINYINT NOT NULL
    -- specify more columns here
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- projects

CREATE TABLE IF NOT EXISTS projects
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, -- primary key column
    title text NOT NULL,
    description text NOT NULL,
    logo text,
    visible BOOLEAN NOT NULL,
    months TINYINT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
    -- specify more columns here
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- cambios para ORM eloquent

ALTER TABLE `jobs` ADD `created_at` DATETIME NOT NULL AFTER `months`, ADD `updated_at` DATETIME NOT NULL AFTER `created_at`;

