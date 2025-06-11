SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';


-- Insert statements with corrected table and field names
INSERT INTO User (id, email, password, role) VALUES
    ('68bc3360-1831-450e-bfd5-dfc8b5367ae1', 'user1@mail.com', '$2y$10$kAPrT9SPUSTrd6a1XuhwlOVLur.ESuLgGmfVHn7.Ov6NGeoAYEEKW', 1000),
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

INSERT INTO Event (
    id, title, description, price, start_date, end_date, time, category_id, is_published, user_id
) VALUES
      (1, 'Jazz à Vienne', 'Festival emblématique de jazz en plein air dans le théâtre antique de Vienne.', 35.00, '2025-07-01 20:30:00', '2025-07-01 23:00:00', '20:30:00', 1, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (2, 'Paris Photo 2025', 'Grande exposition internationale de photographie au Grand Palais Éphémère.', 22.00, '2025-11-06 10:00:00', '2025-11-09 19:00:00', '10:00:00', 4, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (3, 'Atelier pâtisserie avec Pierre Hermé', 'Session exclusive de pâtisserie avec un chef renommé.', 90.00, '2025-10-15 14:00:00', '2025-10-15 17:00:00', '14:00:00', 3, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (4, 'Festival d`Avignon - Théâtre de rue', 'Performances artistiques gratuites dans les rues d`Avignon.', 0.00, '2025-07-10 18:00:00', '2025-07-10 20:00:00', '18:00:00', 7, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (5, 'VivaTech 2025', 'Le plus grand salon européen des startups et technologies innovantes.', 50.00, '2025-06-11 09:00:00', '2025-06-14 18:00:00', '09:00:00', 2, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (6, 'Festival de Cannes 2025', '78ᵉ édition du célèbre festival de cinéma.', 0.00, '2025-05-13 18:00:00', '2025-05-26 23:00:00', '18:00:00', 8, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (7, 'Boucles de l’Aulne', 'Course cycliste UCI Europe Tour (1.1)', 10.00, '2025-05-08 09:00:00', '2025-05-08 17:00:00', '09:00:00', 6, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (8, 'Festival du Court Métrage Clermont-Ferrand', 'Festival international de courts métrages.', 7.50, '2025-02-07 10:00:00', '2025-02-15 22:00:00', '10:00:00', 8, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (9, 'Annecy Festival 2025', 'Festival international du film d’animation.', 12.00, '2025-06-09 09:00:00', '2025-06-14 22:00:00', '09:00:00', 8, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (10, 'Festival International de la Musique de Nice', 'Exposition « Action! – Sport au cinéma » au Musée National du Sport.', 8.00, '2025-04-11 10:00:00', '2025-04-16 18:00:00', '10:00:00', 4, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (11, 'Quatre Jours de Dunkerque', 'Course cycliste UCI ProSeries, 5 étapes.', 15.00, '2025-05-14 08:00:00', '2025-05-18 18:00:00', '08:00:00', 6, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (12, 'Salon du Livre de Paris 2025', 'Festival du livre et littérature au Grand Palais.', 14.00, '2025-04-11 10:00:00', '2025-04-13 19:00:00', '10:00:00', 4, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (13, 'Fête de la Musique', 'Concerts gratuits dans toute la France.', 0.00, '2025-06-21 18:00:00', '2025-06-21 23:59:00', '18:00:00', 1, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (14, 'Festival du Film de Montagne d’Autrans', 'Film aventure/montagne et conférences.', 6.00, '2025-12-03 10:00:00', '2025-12-07 20:00:00', '10:00:00', 8, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (15, 'Montagne en Scène (Nancy)', 'Projections et rencontres autour de l’aventure en montagne.', 5.00, '2025-06-12 19:00:00', '2025-06-12 22:00:00', '19:00:00', 8, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (16, 'Networking Tech Nancy', 'Apéro rencontres entre professionnels tech à Nancy.', 10.00, '2025-09-18 18:00:00', '2025-09-18 21:00:00', '18:00:00', 9, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (17, 'Falling In Reverse', 'Concert du groupe Falling In Reverse à Rockhal (Esch-sur-Alzette, Luxembourg).', 45.00, '2025-06-10 19:00:00', '2025-06-10 22:00:00', '19:00:00', 1, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (18, 'Heavy Week‑End', 'Festival metal Rock/Hard Rock au Nancy Open Air (Zénith du Grand Nancy), avec Slipknot, Powerwolf, Dream Theater…', 90.00, '2025-06-06 17:30:00', '2025-06-08 23:00:00', '17:30:00', 1, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (19, 'Ado en concert à Paris', 'Concert de la star japonaise Ado à Accor Arena de Paris.', 73.00, '2025-06-25 20:30:00', '2025-06-25 23:00:00', '20:30:00', 1, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1'),
      (20, 'BABYMETAL Live in Paris', 'Concert de BABYMETAL au Zénith Paris – La Villette.', 55.00, '2025-05-28 19:00:00', '2025-05-28 22:00:00', '19:00:00', 1, TRUE, '68bc3360-1831-450e-bfd5-dfc8b5367ae1');

INSERT INTO Image (id, event_id, url) VALUES
    (1, 1, '/images/jazz_vienne.jpg'),
    (2, 2, '/images/paris_photo.jpg'),
    (3, 3, '/images/patisserie_herme.webp'),
    (4, 4, '/images/avignon_rue.jpg'),
    (5, 5, '/images/vivatech_2025.jpg'),
    (6, 6, '/images/cannes_2025.jpg'),
    (7, 7, '/images/boucles_aulne.jpg'),
    (8, 8, '/images/clermont_court.jpg'),
    (9, 9, '/images/annecy_2025.jpg'),
    (10, 10, '/images/nice_musique.jpg'),
    (11, 11, '/images/dunkerque_4jours.webp'),
    (12, 12, '/images/salon_livre_paris.jpg'),
    (13, 13, '/images/fete_musique_france.jpg'),
    (14, 14, '/images/film_autrans.jpg'),
    (15, 15, '/images/montagne_scene_nancy.jpg'),
    (23, 15, '/images/montagne_scene_nancy_2.jpg'),
    (18, 17, '/images/falling_reverse_lux.webp'),
    (19, 18, '/images/heavy_weekend_nancy.jpg'),
    (20, 19, '/images/ado_paris2025.jpg'),
    (21, 19, '/images/ado_paris2025_2.webp'),
    (22, 20, '/images/babymetal_paris2025.webp');
