CREATE DATABASE IF NOT EXISTS touche_pas_au_klaxon CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE touche_pas_au_klaxon;
CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table des agences
CREATE TABLE agence (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table des trajets
CREATE TABLE trajet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_depart DATE NOT NULL,
    heure_depart TIME NOT NULL,
    date_arrivee DATE NOT NULL,
    heure_arrivee TIME NOT NULL,
    places_total INT NOT NULL,
    places_disponibles INT NOT NULL,
    utilisateur_id INT NOT NULL,
    agence_depart_id INT NOT NULL,
    agence_arrivee_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id) ON DELETE CASCADE,
    FOREIGN KEY (agence_depart_id) REFERENCES agence(id) ON DELETE CASCADE,
    FOREIGN KEY (agence_arrivee_id) REFERENCES agence(id) ON DELETE CASCADE,
    CONSTRAINT check_places CHECK (places_disponibles <= places_total),
    CONSTRAINT check_agences CHECK (agence_depart_id != agence_arrivee_id),
    CONSTRAINT check_dates CHECK (
        (date_arrivee > date_depart) OR 
        (date_arrivee = date_depart AND heure_arrivee > heure_depart)
    )
) ENGINE=InnoDB;