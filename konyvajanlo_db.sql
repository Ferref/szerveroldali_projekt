CREATE DATABASE IF NOT EXISTS konyvajanlo;
USE konyvajanlo;

CREATE TABLE konyvek (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cim VARCHAR(255) NOT NULL,
    leiras TEXT,
    kiadasi_ev INT,
    boritokep_url VARCHAR(255),
    link_amazon VARCHAR(255),
    link_bookline VARCHAR(255)
);

CREATE TABLE kategoriak (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nev VARCHAR(255) NOT NULL
);

CREATE TABLE szerzok (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nev VARCHAR(255) NOT NULL,
    profilkep_url VARCHAR(255)
);

CREATE TABLE felhasznalok (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nev VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    jelszo VARCHAR(255) NOT NULL,
    profilkep_url VARCHAR(255),
    regisztracios_datum DATETIME DEFAULT NOW()
);

CREATE TABLE velemenyek (
    id INT PRIMARY KEY AUTO_INCREMENT,
    felhasznalo_id INT NOT NULL,
    konyv_id INT NOT NULL,
    velemeny TEXT NOT NULL,
    datum DATETIME DEFAULT NOW(),
    -- Ha egy felhasználó törlődik, a kapcsolódó vélemények is törlődjenek
    FOREIGN KEY (felhasznalo_id) REFERENCES felhasznalok(id) ON DELETE CASCADE,
    FOREIGN KEY (konyv_id) REFERENCES konyvek(id) ON DELETE CASCADE
);

CREATE TABLE hozzaszolasok (
    id INT PRIMARY KEY AUTO_INCREMENT,
    velemeny_id INT,
    felhasznalo_id INT,
    hozzaszolas TEXT NOT NULL,
    datum DATETIME DEFAULT NOW(),
    -- Ha egy vélemény törlődik, a hozzászólások is törlődjenek
    FOREIGN KEY (velemeny_id) REFERENCES velemenyek(id) ON DELETE CASCADE,
    -- Ha egy felhasználó törlődik, a kapcsolódó hozzászólások is törlődjenek
    FOREIGN KEY (felhasznalo_id) REFERENCES felhasznalok(id) ON DELETE CASCADE
);

-- Összekötő tábla a könyvek és szerzők között a N-N kapcsolat kezelésére
CREATE TABLE konyv_szerzo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    konyv_id INT,
    szerzo_id INT,
    FOREIGN KEY (konyv_id) REFERENCES konyvek(id) ON DELETE CASCADE,
    FOREIGN KEY (szerzo_id) REFERENCES szerzok(id) ON DELETE CASCADE
);

-- Összekötő tábla a könyvek és kategóriák között a N-N kapcsolat kezelésére
CREATE TABLE konyv_kategoria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    konyv_id INT,
    kategoria_id INT,
    FOREIGN KEY (konyv_id) REFERENCES konyvek(id) ON DELETE CASCADE,
    FOREIGN KEY (kategoria_id) REFERENCES kategoriak(id) ON DELETE CASCADE
);

-- Konyvek ertekelese tabla
CREATE TABLE ertekelesek (
    id INT PRIMARY KEY AUTO_INCREMENT,
    felhasznalo_id INT NOT NULL,
    konyv_id INT NOT NULL,
    ertekeles TINYINT NOT NULL CHECK (ertekeles BETWEEN 1 AND 5),
    datum DATETIME DEFAULT NOW(),
    FOREIGN KEY (felhasznalo_id) REFERENCES felhasznalok(id) ON DELETE CASCADE,
    FOREIGN KEY (konyv_id) REFERENCES konyvek(id) ON DELETE CASCADE
);
