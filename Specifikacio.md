# Könyvajánló Fejlesztési Specifikáció

## 1. Projekt Célja
A projekt célja egy olyan könyves weboldal létrehozása, ahol a felhasználók könyveket böngészhetnek, olvashatnak róluk véleményeket (hozzászólásokat), és külső linkeken keresztül megvásárolhatják azokat. A felhasználók véleményeket írhatnak a könyvekről, mások véleményeit kommentálhatják, és a könyveket is értékelhetik. A szűrési lehetőségek több szerzőre és kategóriára is kiterjednek. 

## 2. Szerepkörök Felosztása (1. hét)

- **Frontend fejlesztő**: HTML, CSS, Bootstrap, JavaScript alapú frontend komponensek készítése. Ezek PHP modulokra bontása.
- **Backend fejlesztő**: PHP alapú backend fejlesztés, adatbázis kezelés.
- **Fullstack fejlesztő**: Frontend és backend fejlesztés kombinációja, valamint dokumentáció és ppt.

## 3. Funkciók és Követelmények

### Oldalak
   - **Belépés nélkül elérhető**
      - Főoldal
      - Belépés
      - Regisztráció
      - Könyv részletes megtekintő
      - Író részletes megtekintő
      - Keresés
   - **Alap felhasználó**
      - Felhasználói profil
      - Mentett könyvek
      - Kedvencek
   - **Tartalomkezelő felhasználó**
      - Tartalomkezelés
   - **Admin**
      - Felhasználókezelés

### Frontend

Bootstrap alapú reszponzív dizájn használata.
Színek, betűtípusok és elrendezés előre meghatározott sablon alapján.

1. **Főoldal**
   - Keresés
      - Kategóriák és szerzők szerinti böngészés (HTML dropdown listák és gombok).
      - Keresési lehetőség cím, szerző, kiadási év vagy kategória alapján.
      - Több szűrő egyidejű alkalmazása (pl. szerzők és kategóriák egyszerre).
   - Random kedv csináló, egy Véletlenszerű könyvet megjelenít meg.
   - Legjobb könyvek megjelenítése kártyaformátumban (Bootstrap kártyák).

2. **Könyv Részletei Oldal**
   - Könyv adatainak kiírása, mint címe, szerzője, borítóképe, leírása, kiadási éve, kategóriáji.
   - A könyvek értékelhetőek 1-5 csillag alapján, amely az összesített értékelést adja meg.
   - Könyv kedvencelése.
   - Könyv mentése (elolvasott, várólistás).
   - Felhasználói vélemények megjelenítése, új vélemény és hozzászólás a véleményhez lehetősége.
   - Vélemények és hozzászólások értékelése:
     - **Vélemények**: Fel és le gombokkal értékelhetőek.
     - **Hozzászólások**: Fel és le gombokkal értékelhetőek.
   - Hozzászólást csak véleményre lehet írni, utána pedig az arra adott hozzászólásra lehet újabb hozzászólást írni.
   - Külső linkek a könyv megvásárlásához.
   - Kategória alapján hasonló könyvek ajánlása.
   - Más könyvek az alkotótól.

3. **Felhasználói Profil**
   - Fiókadatok megjelenítése és módosítása (pl. jelszó, e-mail, profilkép).
   - Profilkép feltöltési lehetőség.
   - Regisztrációs dátum megjelenítése.
   - Kedvenc könyvek és írók megjelenítése.
   - Mentett könyvek megjelenítése (Elolvasott, Várólistás)
   - Vélemények és hozzászólások listázása, szerkesztése és törlése.

### Backend

1. **Adatbázis Tervezés (SQL)**
   - **Könyvek tábla**: `id`, `cim`, `szerzo_id`, `kategoria_id`, `leiras`, `kiadasi_ev`, `boritokep_url`, `link_amazon`, `link_bookline`.
   - **Kategoriak tábla**: `id`, `nev`.
   - **Szerzok tábla**: `id`, `nev`.
   - **Felhasznalok tábla**: `id`, `nev`, `email`, `jelszo`, `profil_kep`, `regisztracios_datum`.
   - **Velemenyek tábla**: `id`, `felhasznalo_id`, `konyv_id`, `velemeny`, `datum`.
   - **Hozzaszolasok tábla**: `id`, `velemeny_id`, `felhasznalo_id`, `hozzaszolas`, `datum`.

2. **Backend Logika (PHP)**
   - **Regisztráció és bejelentkezés**: PHP session kezelés, jelszavak biztonságos tárolása hash-eléssel.
   - **Könyvek listázása és keresés**: Könyvek adatainak lekérdezése és keresés cím, szerző, kiadási év vagy kategória alapján. Több szűrő egyidejű alkalmazása.
   - **Vélemények és hozzászólások kezelése**: Vélemények és hozzászólások hozzáadása, módosítása, törlése.
   - **Tiltószavak kezelése**: Vélemények és hozzászólások ellenőrzése tiltószavak alapján.

3. **API Végpontok (PHP)**
   - `GET /books`: Könyvek listázása.
   - `GET /books/:id`: Könyv részletei.
   - `POST /reviews`: Vélemény hozzáadása.
   - `POST /comments`: Hozzászólás hozzáadása véleményhez vagy más hozzászóláshoz.
   - `POST /user`: Felhasználói regisztráció és bejelentkezés.
   - `POST /profile`: Felhasználói adatok és profilkép módosítása.

4. **Biztonsági Szempontok**
   - Input validálás minden formnál.
   - SQL injection elleni védelem.
   - Jelszavak hash-elése a regisztrációnál.
   - Egyedi e-mail cím biztosítása a felhasználók számára.

### Integrációk

1. **Külső Linkek Kezelése**
   - Külső könyvesboltok linkjeinek megjelenítése.
   - Linkek validálása és érvényességük ellenőrzése.

2. **SEO Optimalizálás**
   - Kulcsszavak és kategóriák használata a jobb keresőoptimalizálás érdekében.

## 4. Ütemterv (6 hetes ütemezés)

### 1. Sprint (1. hét): 2024. szeptember 16-22.

- **Szerepkörök felosztása**: Frontend, backend, fullstack és specifikáció felelősök kijelölése.
- **Projekt célok meghatározása**: Alapvető funkciók definiálása.
- **Technológiai alapok**: Adatbázis séma megtervezése, projekt szerkezet felállítása (mappastruktúra).
- **Első HTML oldalak készítése**: Főoldal és regisztrációs oldal alapjainak elkészítése.

### 2. Sprint (2. hét): 2024. szeptember 23-29.

- **Backend**: Felhasználó regisztráció és bejelentkezés PHP és SQL segítségével.
- **Frontend**: Regisztrációs és bejelentkezési formok elkészítése.
- **Validáció**: Hibakezelés és üzenetek megjelenítése frontend oldalon.

### 3. Sprint (3. hét): 2024. szeptember 30 - október 6.

- **Backend**: Könyvek adatainak lekérdezése SQL lekérdezésekkel.
- **Frontend**: Könyvlista megjelenítése kártyákban (Bootstrap grid rendszer).
- **Kategória és szerző szűrés**: Dropdown lista a kategóriák és szerzők szerinti szűréshez, több szűrő egyidejű alkalmazása.

### 4. Sprint (4. hét): 2024. október 7-13.

- **Frontend**: Könyv részletei oldal fejlesztése, dinamikus tartalom megjelenítése.
- **Backend**: Vélemények és hozzászólások hozzáadása és megjelenítése a könyv részletei oldalon.
- **Véleménykezelés**: Felhasználói vélemények megírása, tiltószavak ellenőrzése.

### 5. Sprint (5. hét): 2024. október 14-20.

- **Frontend**: Felhasználói profil oldal elkészítése, vélemények és hozzászólások kezelése.
- **Backend**: Vélemények és hozzászólások módosítása és törlése API végpontokon keresztül.
- **Értékelési funkciók**: Könyvek értékelése 1-5 csillag alapján. Vélemények és hozzászólások értékelése fel és le gombokkal.

### 6. Sprint (6. hét): 2024. október 21-27.

- **Dokumentáció**: Fejlesztői és felhasználói dokumentáció elkészítése .md fájl formátumban.
- **Alkalmazás telepítőjének elkészítése**:
  - Fájlok összegyűjtése és csomagolása, amelyek szükségesek az alkalmazás futtatásához.
  - Adatbázis exportálása tesztadatokkal feltöltve.
- **Élesítés előkészítése**:
  - Telepítő és adatbázis export feltöltése.
  - Ellenőrzés, hogy az alkalmazás helyesen működik a telepítő segítségével.
- **Monitoring és utókövetés**:
  - Felhasználói visszajelzések gyűjtése.
  - Hibák észlelése és javítása.

## Végső Határidő

- **2024. október 27.**: A teljes alkalmazás telepítőjének és dokumentációnak a feltöltése, tesztadatokkal ellátott adatbázis exporttal együtt.

## Jegyzet
- A tényleges végső határidő 2024. december 3. Az időpont az esetleges csúszások miatt lett ennyire koraira állítva, de egy héttel előtte, 2024.11.26, tervezzük az utolsó időpontot az elküldésre.


