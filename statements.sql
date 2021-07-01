-- -- Drops database if exists
DROP DATABASE IF EXISTS examenoefeningjonathan;

-- Creates new database
CREATE DATABASE examenoefeningjonathan;

-- Select database as the default database
USE examenoefeningjonathan;

-- Statement to create table 

CREATE TABLE gebruiker(
    id INT NOT NULL AUTO_INCREMENT,
    voornaam VARCHAR(255) NOT NULL,
    achternaam VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    wachtwoord VARCHAR(250) NOT NULL,
    is_admin boolean,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    -- KEYS
    PRIMARY KEY(id)
);

CREATE TABLE groep(
    id INT NOT NULL AUTO_INCREMENT,
    naam VARCHAR(255) NOT NULL,
    beschrijving VARCHAR(255),
    -- KEYS
    PRIMARY KEY(id)
);

CREATE TABLE groepsleden(
    groeps_id INT,
    lid_id INT,
    is_moderator BOOLEAN,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    -- KEYS
    FOREIGN KEY(groeps_id) REFERENCES groep(id),
    FOREIGN KEY(lid_id) REFERENCES gebruiker(id)
    );

CREATE TABLE post(
    id INT NOT NULL AUTO_INCREMENT,
    inhoud VARCHAR(255) NOT NULL,
    poster_id INT,
    groep_id INT,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    -- KEYS
    PRIMARY KEY(id),
    FOREIGN KEY(poster_id) REFERENCES gebruiker(id),
    FOREIGN KEY(groep_id) REFERENCES groep(id)
);

CREATE TABLE comment(
    id INT NOT NULL AUTO_INCREMENT,
    inhoud VARCHAR(255) NOT NULL,
    commenter_id INT,
    post_id INT,
    -- KEYS
    PRIMARY KEY(id),
    FOREIGN KEY(commenter_id) REFERENCES gebruiker(id),
    FOREIGN KEY(post_id) REFERENCES post(id)
);

CREATE TABLE image(
    id INT NOT NULL,
    Filename VARCHAR(255) NOT NULL,
    -- KEYS
    PRIMARY KEY(id)
);

