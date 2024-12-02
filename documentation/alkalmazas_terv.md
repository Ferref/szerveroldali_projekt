
## Célkitűzés
A Könyvnyilvántartó Rendszer célja az, hogy lehetővé tegye a felhasználók számára kedvenc könyveik nyilvántartását, értékelését, véleményezését és a különböző állapotok (olvasott, várólistás, kedvenc) szerinti kategorizálását is. A rendszer egyszerű, felhasználóbarát felülettel és könnyen elérhető funkciókkal támogatja a könyvkedvelőket.

## Célközönség
- Könyvkedvelők, akik szeretnék rendszerezni és követni olvasási szokásaikat.
- Adminisztrátorok, akik kezelik az adatbázist, felügyelik a véleményeket és értékeléseket.

## Funkciók
1. **Felhasználói Regisztráció és Bejelentkezés**:
   - Felhasználók regisztrációja és hitelesítése.
   - Belépés és kilépés kezelése.

2. **Könyvek Nyilvántartása**:
   - Könyvek hozzáadása, keresése és böngészése.
   - Kedvenc, olvasott és várólistás könyvek kategorizálása.

3. **Értékelések és Vélemények**:
   - Könyvek értékelése (1-5 csillag).
   - Vélemények írása és megtekintése.

4. **Adminisztrációs Funkciók**:
   - Felhasználók és könyvek kezelésének lehetősége.
   - Vélemények és értékelések moderálása.

## Oldaltípusok
1. **Nyitóoldal**:
   - Keresési mező és legnépszerűbb könyvek listája.

2. **Regisztráció/Bejelentkezés**:
   - Felhasználói regisztráció és belépési űrlap.

3. **Felhasználói Profil**:
   - Személyes adatok, kedvenc könyvek, olvasott és várólistás könyvek.

4. **Adminisztrációs Oldal**:
   - Adminisztrátorok számára a felhasználók, könyvek, értékelések és vélemények kezelése.

5. **Keresési Oldal**:
   - Könyvek keresése kulcsszó vagy kategória alapján.

## Felhasználói Élmény
- **Egyszerű navigáció**: Átlátható menük és gyors hozzáférés a legfontosabb funkciókhoz.
- **Reszponzív design**: Az alkalmazás asztali és mobil eszközökön egyaránt használható.
- **Színséma**: Egységes kék-fehér megjelenés, amely segíti az információk gyors feldolgozását.

## Technológiai Megoldások
- **Backend**: PHP és MySQL alapú adatkezelés.
- **Frontend**: HTML, CSS és JavaScript (Bootstrap keretrendszerrel).
- **Szerver**: Apache vagy bármely más kompatibilis HTTP-szerver.

## Fejlesztési Irányelvek
- Moduláris kódolás: A kód szétválasztása logikai egységekre (pl. `Generate` osztály).
- Reusability: Funkciók újrafelhasználhatósága különböző oldalak között.
- Hibakezelés: Részletes üzenetek megjelenítése a felhasználóknak és logolás a rendszergazdáknak.


