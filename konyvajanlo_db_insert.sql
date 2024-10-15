USE konyvajanlo;

-- Kategóriák adatainak beszúrása
INSERT INTO kategoriak (nev) VALUES
('Fantasy'),
('Történelem'),
('Sci-Fi'),
('Szépirodalom');

-- Szerzők adatainak beszúrása
INSERT INTO szerzok (nev) VALUES
('J.K. Rowling'),
('Isaac Asimov'),
('George Orwell'),
('Márai Sándor');

-- Könyvek adatainak beszúrása
INSERT INTO konyvek (cim, leiras, kiadasi_ev, boritokep_url, link_amazon, link_bookline) VALUES
('Harry Potter és a Bölcsek Köve', 'Egy fiatal fiú rájön, hogy varázsló.', 1997, 'https://example.com/hp1.jpg', 'https://amazon.com/hp1', 'https://bookline.com/hp1'),
('Alapítvány', 'Egy jövőbeli történet egy galaktikus birodalom összeomlásáról.', 1951, 'https://example.com/alapitvany.jpg', 'https://amazon.com/alapitvany', 'https://bookline.com/alapitvany'),
('1984', 'Egy disztópikus regény a totalitarizmusról.', 1949, 'https://example.com/1984.jpg', 'https://amazon.com/1984', 'https://bookline.com/1984'),
('Egy polgár vallomásai', 'Márai Sándor regénye a polgári világról.', 1934, 'https://example.com/egy_polgar.jpg', 'https://amazon.com/egy_polgar', 'https://bookline.com/egy_polgar');

-- Felhasználók adatainak beszúrása
INSERT INTO felhasznalok (nev, email, jelszo) VALUES
('Kovács Péter', 'peter@example.com', 'titkositott_jelszo1'),
('Szabó Anna', 'anna@example.com', 'titkositott_jelszo2');

-- Vélemények adatainak beszúrása
INSERT INTO velemenyek (felhasznalo_id, konyv_id, velemeny) VALUES
(1, 1, 'Nagyszerű könyv gyerekeknek és felnőtteknek is!'),
(2, 2, 'Egy klasszikus sci-fi, ami sosem megy ki a divatból.');

-- Hozzászólások adatainak beszúrása
INSERT INTO hozzaszolasok (velemeny_id, felhasznalo_id, hozzaszolas) VALUES
(1, 2, 'Teljesen egyetértek, időtálló történet.'),
(2, 1, 'Valóban, Asimov megelőzte a korát.');

-- Könyv és szerző összekapcsolása
INSERT INTO konyv_szerzo (konyv_id, szerzo_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- Könyv és kategória összekapcsolása
INSERT INTO konyv_kategoria (konyv_id, kategoria_id) VALUES
(1, 1),
(2, 3),
(3, 3),
(4, 4);
