CREATE DATABASE elevage;
USE elevage;

-- Table des utilisateurs (éleveurs)
CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    capital_initial DECIMAL(10,2) NOT NULL,
    capital_actuel DECIMAL(10,2) NOT NULL
);

-- Type d'animal
CREATE TABLE type_animal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

-- Table des animaux
CREATE TABLE animal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    type_id INT NOT NULL,
    poids_actuel DECIMAL(10,2) NOT NULL,
    poids_min_vente DECIMAL(10,2) NOT NULL,
    poids_max DECIMAL(10,2) NOT NULL,
    prix_vente_kg DECIMAL(10,2) NOT NULL,
    jours_sans_manger INT NOT NULL,
    perte_poids_par_jour DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id) ON DELETE CASCADE,
    FOREIGN KEY (type_id) REFERENCES type_animal(id) ON DELETE CASCADE
);

-- Animal Shop
CREATE TABLE animal_shop (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_id INT NOT NULL,
    poids_actuel DECIMAL(10,2) NOT NULL,
    poids_min_vente DECIMAL(10,2) NOT NULL,
    poids_max DECIMAL(10,2) NOT NULL,
    prix_vente_kg DECIMAL(10,2) NOT NULL,
    jours_sans_manger INT NOT NULL,
    perte_poids_par_jour DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (type_id) REFERENCES type_animal(id) ON DELETE CASCADE
);

-- Table des aliments
CREATE TABLE alimentation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    type_animal VARCHAR(50) NOT NULL,
    pourcentage_gain_poids DECIMAL(5,2) NOT NULL,
    prix DECIMAL(10,2) NOT NULL
);
ALTER TABLE alimentation 
DROP COLUMN type_animal, 
ADD COLUMN type_id INT NOT NULL,
ADD FOREIGN KEY (type_id) REFERENCES type_animal(id) ON DELETE CASCADE;


-- Table des transactions
CREATE TABLE transaction (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('achat_animal', 'vente_animal', 'achat_aliment') NOT NULL,
    date DATE NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    animal_id INT NULL,
    alimentation_id INT NULL,
    FOREIGN KEY (animal_id) REFERENCES animal(id) ON DELETE SET NULL,
    FOREIGN KEY (alimentation_id) REFERENCES alimentation(id) ON DELETE SET NULL
);

-- Table de l'historique de l'élevage
CREATE table jourpasser (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jour INT NOT NULL
);

CREATE TABLE historique_animal_alimentation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT NOT NULL,
    alimentation_id INT NOT NULL,
    quantite DECIMAL(10,2) NOT NULL,
    date_consommation DATE NOT NULL,
    FOREIGN KEY (animal_id) REFERENCES animal(id) ON DELETE CASCADE,
    FOREIGN KEY (alimentation_id) REFERENCES alimentation(id) ON DELETE CASCADE
);
