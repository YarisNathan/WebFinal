CREATE TABLE historique_animal_alimentation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT NOT NULL,
    alimentation_id INT NOT NULL,
    quantite DECIMAL(10,2) NOT NULL,
    date_consommation DATE NOT NULL,
    FOREIGN KEY (animal_id) REFERENCES animal(id) ON DELETE CASCADE,
    FOREIGN KEY (alimentation_id) REFERENCES alimentation(id) ON DELETE CASCADE
);
