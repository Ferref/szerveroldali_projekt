# Telepítési és Üzemeltetési Útmutató

## Telepítési Útmutató

### 1. Rendszerkövetelmények
- **Szoftverek**: PHP (7.4 vagy újabb), MySQL, Apache.
- **Eszközök**: XAMPP (ajánlott) vagy hasonló webszerver környezet.

---

### 2. Mappastruktúra
- **Fő mappa**: Az alkalmazás összes fájlja.
  - `components`: Komponens fájlok (pl. fejléc, lábléc).
  - `controllers`: MVC vezérlők (pl. könyvek, felhasználók).
  - `models`: Adatbázis-lekérdezéseket kezelő modellek.
  - `views`: Nézetek (megjelenítés).
  - `pages`: Egyes funkciókhoz tartozó PHP-oldalak (pl. profil, regisztráció).
  - `documentation`: Dokumentációs fájlok.
  - `test`: Tesztelési fájlok és adatbázis.
  - `generate.php`: Főoldal generáló fájl.

---

### 3. Adatbázis beállítása
1. Hozzon létre egy MySQL adatbázist.
2. Importálja a `test/konyvajanlo.sql` fájlt az adatbázisába. (a konyvajanlo.sql automatikusan létrehozza ha még nem létezik)

---

### 4. Konfiguráció
- Nyissa meg a `mvc/config/databasehandler.mvc.php` fájlt.
- Állítsa be:
  - **Szerver**: localhost
  - **Felhasználónév**: root
  - **Jelszó**: (hagyja üresen, ha nem állított be)
  - **Adatbázis**: a korábban létrehozott adatbázis neve.

---

### 5. Webszerver indítása
1. Indítsa el az Apache-ot és MySQL-t a webszerver környezetében.
2. Nyissa meg böngészőben: `http://localhost/<alkalmazás_mappája>`.

---

## Üzemeltetési Útmutató

### 1. Hibaelhárítás
- Ellenőrizze, hogy a szerver fut (Apache, MySQL).
- Adatbázis-hiba esetén ellenőrizze a konfigurációt.

### 2. Mentés és frissítés
- Rendszeres adatbázis-mentés javasolt.
- Ellenőrizze a PHP, Apache, és MySQL frissítéseit.
