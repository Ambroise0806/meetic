DROP DATABASE IF EXISTS meetic;

CREATE DATABASE meetic;

USE meetic;


CREATE TABLE user
(
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    date_naissance DATE,
    genre VARCHAR(100),
    ville VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE,
    mdp VARCHAR(100),
    loisir VARCHAR(255)
);
INSERT INTO user (nom, prenom, date_naissance, genre, ville, email, mdp, loisir)
VALUES 
('Bosch', 'Ambroise', '2000-06-08', 'Homme', 'Gournay', 'ambroise.bosch@gmail.com','youhou', 'foot');
