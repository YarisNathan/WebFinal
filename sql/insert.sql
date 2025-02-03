-- Insérer des utilisateurs (éleveurs)
INSERT INTO utilisateur (id, nom) VALUES 
(1, 'Jean Dupont'),
(2, 'Marie Curie'),
(3, 'Paul Martin');

-- Insérer des types d'animaux
INSERT INTO type_animal (id, nom) VALUES 
(1, 'Bœuf'),
(2, 'Porc'),
(3, 'Poulet');

INSERT INTO animal (utilisateur_id, type_id, poids_actuel, poids_min_vente, poids_max, prix_vente_kg, jours_sans_manger, perte_poids_par_jour) VALUES
(1, 1, 450.00, 400.00, 500.00, 3.50, 2, 0.50),
(1, 2, 120.00, 100.00, 150.00, 2.80, 1, 0.30),
(2, 3, 2.50, 2.00, 3.00, 5.00, 0, 0.10),
(3, 1, 520.00, 450.00, 600.00, 3.70, 5, 0.60),
(3, 2, 135.00, 110.00, 160.00, 2.90, 3, 0.40),
(2, 1, 490.00, 430.00, 550.00, 3.60, 4, 0.55);

INSERT INTO alimentation (id, nom, type_id, pourcentage_gain_poids, prix) VALUES 
(1, 'Foin enrichi', 1, 5.0, 1000),
(2, 'Granulés de maïs', 2, 3.5, 800),
(3, 'Herbe sèche', 3, 2.0, 500);

INSERT INTO historique_animal_alimentation (id, animal_id, alimentation_id, quantite, date_consommation) VALUES 
(1, 1, 1, 10, '2025-02-01'),  -- La vache 1 a mangé 10 kg de Foin enrichi
(2, 2, 2, 5, '2025-02-02'),   -- Le mouton 1 a mangé 5 kg de Granulés de maïs
(3, 3, 3, 8, '2025-02-03');   -- La chèvre 1 a mangé 8 kg d'Herbe sèche

INSERT INTO animal (id, nom, type_id, poids_actuel) VALUES 
(1, 'Vache 1', 1, 200.0),
(2, 'Mouton 1', 2, 50.0),
(3, 'Chèvre 1', 3, 40.0);
