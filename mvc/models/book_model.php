<?php

require '../config/db.php';

class BookModel
{
    private $db;

    public function __construct($dbConnection){
        $this->db = $dbConnection;
    }

    // Random konyv a kezdooldalra
    public function getRandomBooks(){
        $query = "SELECT k.id, k.cim, k.leiras, k.boritokep_url, sz.nev AS szerzo_nev, sz.profilkep_url,
                         AVG(e.ertekeles) AS atlag_ertekeles
                  FROM konyvek k
                  JOIN konyv_szerzo ksz ON k.id = ksz.konyv_id
                  JOIN szerzok sz ON sz.id = ksz.szerzo_id
                  LEFT JOIN ertekelesek e ON e.konyv_id = k.id
                  GROUP BY k.id, sz.id
                  ORDER BY RAND()
                  LIMIT 1;";

        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    // Legnepszerubb konyvek (legtobb ertekeles alapjan)
    public function getMostPopularBooks(){
        $query = "SELECT k.id, k.cim, k.leiras, k.boritokep_url, sz.nev AS szerzo_nev, 
                         COUNT(e.ertekeles) AS ertekelesek_szama, AVG(e.ertekeles) AS atlag_ertekeles
                  FROM konyvek k
                  JOIN konyv_szerzo ksz ON k.id = ksz.konyv_id
                  JOIN szerzok sz ON sz.id = ksz.szerzo_id
                  JOIN ertekelesek e ON e.konyv_id = k.id
                  GROUP BY k.id, sz.id
                  ORDER BY ertekelesek_szama DESC
                  LIMIT 10;";

        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Konyv info (konyv id alapjan)
    public function getBookInfo($bookId){
        $query = "SELECT k.id, k.cim, k.leiras, k.boritokep_url, sz.nev AS szerzo_nev, sz.profilkep_url,
                         AVG(e.ertekeles) AS atlag_ertekeles
                  FROM konyvek k
                  JOIN konyv_szerzo ksz ON k.id = ksz.konyv_id
                  JOIN szerzok sz ON sz.id = ksz.szerzo_id
                  LEFT JOIN ertekelesek e ON e.konyv_id = k.id
                  WHERE k.id = ?
                  GROUP BY k.id, sz.id;";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $bookId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Konyv velemenyek es hozzaszolasok (konyv id alapjan)
    public function getBookReviewsAndComments($bookId){
        $query = "SELECT v.id AS velemeny_id, v.velemeny, v.datum AS velemeny_datum, f.nev AS felhasznalo_nev,
                         h.id AS hozzaszolas_id, h.hozzaszolas, h.datum AS hozzaszolas_datum, hf.nev AS hozzaszolo_nev
                  FROM velemenyek v
                  JOIN felhasznalok f ON v.felhasznalo_id = f.id
                  LEFT JOIN hozzaszolasok h ON v.id = h.velemeny_id
                  LEFT JOIN felhasznalok hf ON h.felhasznalo_id = hf.id
                  WHERE v.konyv_id = ?
                  ORDER BY v.datum DESC, h.datum ASC;";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $bookId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Hasonlo konyvek (kategoria alapjan)
    public function getSimilarBooks($bookId){
        $query = "SELECT DISTINCT k2.id, k2.cim, k2.leiras, k2.boritokep_url, sz.nev AS szerzo_nev
                  FROM konyvek k
                  JOIN konyv_kategoria kk1 ON k.id = kk1.konyv_id
                  JOIN konyv_kategoria kk2 ON kk1.kategoria_id = kk2.kategoria_id
                  JOIN konyvek k2 ON kk2.konyv_id = k2.id
                  JOIN konyv_szerzo ksz ON k2.id = ksz.konyv_id
                  JOIN szerzok sz ON sz.id = ksz.szerzo_id
                  WHERE k.id = ? AND k2.id != ?
                  LIMIT 5;";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $bookId, $bookId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
