-- Insert statements with corrected table and field names
INSERT INTO User (id, email, password, role) VALUES
    ('a1b2c3d4-e5f6-7890-1234-56789abcdef0', 'alice@example.com', '$2y$10$uM2hV6Wz3yqKQZ3ZIrTBOuK8WLa6GVYppHTDbMwBt7k8RfiA/r1zC', 100),
    ('b2c3d4e5-f6a1-8901-2345-6789abcdef01', 'bob@example.com', '$2y$10$q3yk3DnEjwJdHeCeR1Ff7O9Q2K1rScI9AVCDrkOe1PtbHHuHZf8Wa', 1),
    ('c3d4e5f6-a1b2-9012-3456-789abcdef012', 'carol@example.com', '$2y$10$R38oxCNm4qMfYItmI6djZOmZPf.5BR7CV7miSBPpTltXEx7TmOWY.', 1),
    ('d4e5f6a1-b2c3-0123-4567-89abcdef0123', 'david@example.com', '$2y$10$biVYX2kVtPczK/r6lb2PReYOlgyuzs95b1uZC97hdP4kpU5U9AUBW', 1),
    ('e5f6a1b2-c3d4-1234-5678-9abcdef01234', 'eve@example.com', '$2y$10$ZVcYBAGYQZgQNNz0CTi7KeXXPNHs/8OovGZrGPh6XfPa4Gr1b2St2', 100),
    ('f6a1b2c3-d4e5-2345-6789-abcdef012345', 'frank@example.com', '$2y$10$NFvRtFURwdC/7qWhKBS0UOQFzkv4YoC8tQxZsc.2DRx2SiHBYn56G', 1),
    ('a1b2c3d4-e5f6-3456-789a-bcdef0123456', 'grace@example.com', '$2y$10$WFB6ETuRS/y0DCu9nDyvGOvXpCJrQLMQONq4VZ1eRKzvns06zxqJ2', 1),
    ('b2c3d4e5-f6a1-4567-89ab-cdef01234567', 'heidi@example.com', '$2y$10$QaE5s2Qb8K6k4og.RYPiF.3kUpK3EfJ0fv/8lAkxEX1zRtBPL3yZe', 1),
    ('c3d4e5f6-a1b2-5678-9abc-def012345678', 'ivan@example.com', '$2y$10$MzoWImOSwn4CE3vS29K6tuH7dvOJSUL1ksSOQMGt0LVF/fu10oe6O', 1),
    ('d4e5f6a1-b2c3-6789-abcd-ef0123456789', 'judy@example.com', '$2y$10$fxbrxWnQ1F1kuSkKZKkhiOoXtOZzsc0wYuNShMyZKHkS2IYjzdrFC', 100);

INSERT INTO Category (id, label, description) VALUES
    (1, 'Concert', 'Événements musicaux en direct, tous styles confondus'),
    (2, 'Conférence', 'Présentations ou discussions sur des sujets professionnels ou académiques'),
    (3, 'Atelier', 'Sessions pratiques pour apprendre ou créer'),
    (4, 'Exposition', 'Événements d’art ou de présentation de travaux'),
    (5, 'Festival', 'Événements festifs sur plusieurs jours regroupant plusieurs activités'),
    (6, 'Sport', 'Compétitions ou démonstrations sportives'),
    (7, 'Théâtre', 'Représentations de pièces et spectacles vivants'),
    (8, 'Cinéma', 'Projections de films ou courts-métrages'),
    (9, 'Networking', 'Rencontres professionnelles ou communautaires'),
    (10, 'Jeux', 'Événements autour du jeu : jeux de société, jeux vidéo, escape game');

INSERT INTO Event (id, title, description, price, start_date, end_date, time, category_id, is_published, user_id) VALUES
    (1, 'Concert de jazz', 'Soirée musicale avec des artistes locaux.', 15.00, '2025-07-10 20:00:00', '2025-07-10 22:00:00', '20:00:00', 1, FALSE, 'a1b2c3d4-e5f6-7890-1234-56789abcdef0'),
    (2, 'Exposition photo', 'Découvrez les œuvres de photographes contemporains.', 0.00, '2025-07-12 10:00:00', '2025-07-20 18:00:00', '10:00:00', 4, FALSE, 'b2c3d4e5-f6a1-8901-2345-6789abcdef01'),
    (3, 'Atelier cuisine', 'Apprenez à cuisiner des plats du monde entier.', 25.50, '2025-07-15 14:30:00', '2025-07-15 17:30:00', '14:30:00', 3, FALSE, 'c3d4e5f6-a1b2-9012-3456-789abcdef012'),
    (4, 'Théâtre de rue', 'Spectacle gratuit dans le centre-ville.', 0.00, '2025-07-18 18:00:00', '2025-07-18 20:00:00', '18:00:00', 7, FALSE, 'd4e5f6a1-b2c3-0123-4567-89abcdef0123'),
    (5, 'Conférence tech', 'Présentation sur les dernières innovations en intelligence artificielle.', 40.00, '2025-07-22 09:00:00', '2025-07-22 11:00:00', '09:00:00', 2, FALSE, 'e5f6a1b2-c3d4-1234-5678-9abcdef01234');

INSERT INTO Image (id, event_id, url) VALUES
    (1, 1, 'https://example.com/images/concert_jazz_1.jpg'),
    (2, 1, 'https://example.com/images/concert_jazz_2.jpg'),
    (3, 2, 'https://example.com/images/exposition_photo_1.jpg'),
    (4, 2, 'https://example.com/images/exposition_photo_2.jpg'),
    (5, 3, 'https://example.com/images/atelier_cuisine_1.jpg'),
    (6, 4, 'https://example.com/images/theatre_rue_1.jpg'),
    (7, 4, 'https://example.com/images/theatre_rue_2.jpg'),
    (8, 5, 'https://example.com/images/conference_tech_1.jpg');