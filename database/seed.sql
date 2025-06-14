-- Utilisation de la base de donnees
USE touche_pas_au_klaxon;

-- Insertion des agences
INSERT INTO agence (nom) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');

-- Insertion des utilisateurs
-- Note: Les mots de passe sont definis comme 'password' hache avec password_hash()
INSERT INTO utilisateur (nom, prenom, telephone, email, role, password) VALUES
('Martin', 'Alexandre', '0612345678', 'alexandre.martin@email.fr', 'user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Dubois', 'Sophie', '0698765432', 'sophie.dubois@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Bernard', 'Julien', '0622446688', 'julien.bernard@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Moreau', 'Camille', '0611223344', 'camille.moreau@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Lefevre', 'Lucie', '0777889900', 'lucie.lefevre@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Leroy', 'Thomas', '0655443322', 'thomas.leroy@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Roux', 'Chloe', '0633221199', 'chloe.roux@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Petit', 'Maxime', '0766778899', 'maxime.petit@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Garnier', 'Laura', '0688776655', 'laura.garnier@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Dupuis', 'Antoine', '0744556677', 'antoine.dupuis@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Lefebvre', 'Emma', '0699887766', 'emma.lefebvre@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Fontaine', 'Louis', '0655667788', 'louis.fontaine@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Chevalier', 'Clara', '0788990011', 'clara.chevalier@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Robin', 'Nicolas', '0644332211', 'nicolas.robin@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Gauthier', 'Marine', '0677889922', 'marine.gauthier@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Fournier', 'Pierre', '0722334455', 'pierre.fournier@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Girard', 'Sarah', '0688665544', 'sarah.girard@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Lambert', 'Hugo', '0611223366', 'hugo.lambert@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Masson', 'Julie', '0733445566', 'julie.masson@email.fr', 'user', '$2y$10$LTQtcmXUB3dmMNr5va8hUOE4KTtt7aFtB13jbU0WNjX9MN1gWCHnW'),
('Henry', 'Arthur', '0666554433', 'arthur.henry@email.fr', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insertion de quelques trajets d'exemple
-- Dates futures pour que les trajets soient visibles
INSERT INTO trajet (date_depart, heure_depart, date_arrivee, heure_arrivee, places_total, places_disponibles, utilisateur_id, agence_depart_id, agence_arrivee_id) VALUES
('2025-06-10', '08:00:00', '2025-06-10', '10:30:00', 4, 2, 1, 1, 2),
('2025-06-12', '09:15:00', '2025-06-12', '12:00:00', 3, 3, 3, 2, 3),
('2025-06-15', '14:00:00', '2025-06-15', '16:45:00', 5, 1, 5, 3, 4),
('2025-06-18', '07:30:00', '2025-06-18', '11:15:00', 2, 2, 7, 4, 5),
('2025-06-20', '17:00:00', '2025-06-20', '19:30:00', 4, 4, 9, 5, 6),
('2025-06-22', '08:30:00', '2025-06-22', '11:00:00', 3, 2, 2, 1, 3),
('2025-06-25', '13:00:00', '2025-06-25', '15:30:00', 4, 3, 4, 2, 4),
('2025-06-28', '09:00:00', '2025-06-28', '12:30:00', 5, 5, 6, 3, 5);
