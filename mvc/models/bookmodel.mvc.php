<?php
class BookModel extends DatabaseHandler
{

    // Random konyv a kezdooldalra
     function getRandomBook(){
        $query = "SELECT * FROM konyvek ORDER BY RAND() LIMIT 1;";
        $result = $this->connect()->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Legnepszerubb konyvek (legtobb ertekeles alapjan)
    protected function getMostPopularBooks(){
        $query = "SELECT k.id, k.cim, k.leiras, k.boritokep_url, 
                         COUNT(e.ertekeles) AS ertekelesek_szama, AVG(e.ertekeles) AS atlag_ertekeles
                  FROM konyvek k
                  JOIN ertekelesek e ON e.konyv_id = k.id
                  GROUP BY k.id
                  ORDER BY atlag_ertekeles DESC
                  LIMIT 5;";

        $result = $this->connect()->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Konyv info (konyv id alapjan)
    protected function getBookInfo($bookId){
        $query = "SELECT k.*,
                         AVG(e.ertekeles) AS atlag_ertekeles
                  FROM konyvek k
                  LEFT JOIN ertekelesek e ON e.konyv_id = k.id
                  WHERE k.id = :konyvid
                  GROUP BY k.id;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Konyv velemenyek es hozzaszolasok (konyv id alapjan)
    protected function getBookReviewsAndComments($bookId){
        $query = "SELECT v.id AS velemeny_id, v.velemeny, v.datum AS velemeny_datum, f.nev AS felhasznalo_nev,
                         h.id AS hozzaszolas_id, h.hozzaszolas, h.datum AS hozzaszolas_datum, hf.nev AS hozzaszolo_nev
                  FROM velemenyek v
                  JOIN felhasznalok f ON v.felhasznalo_id = f.id
                  LEFT JOIN hozzaszolasok h ON v.id = h.velemeny_id
                  LEFT JOIN felhasznalok hf ON h.felhasznalo_id = hf.id
                  WHERE v.konyv_id = :konyvid
                  ORDER BY v.datum DESC, h.datum ASC;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Hasonlo konyvek (kategoria alapjan)
    protected function getSimilarBooks($bookId){
        $query = "SELECT DISTINCT k2.id, k2.cim, k2.leiras, k2.boritokep_url, sz.nev AS szerzo_nev
                  FROM konyvek k
                  JOIN konyv_kategoria kk1 ON k.id = kk1.konyv_id
                  JOIN konyv_kategoria kk2 ON kk1.kategoria_id = kk2.kategoria_id
                  JOIN konyvek k2 ON kk2.konyv_id = k2.id
                  JOIN konyv_szerzo ksz ON k2.id = ksz.konyv_id
                  JOIN szerzok sz ON sz.id = ksz.szerzo_id
                  WHERE k.id = :konyvid AND k2.id != :konyvid
                  LIMIT 5;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getCategories($bookId){
        $query = "SELECT DISTINCT nev
                  FROM kategoriak
                  JOIN konyv_kategoria ON kategoriak.id = konyv_kategoria.kategoria_id
                  JOIN konyvek ON konyvek.id = konyv_kategoria.konyv_id
                  WHERE konyvek.id = :konyvid;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getBookRating($bookId){
        $query = "SELECT COUNT(ertekeles) AS ertekelesek_szama, AVG(ertekeles) AS atlag_ertekeles
                  FROM konyvek 
                  JOIN ertekelesek  ON ertekelesek.konyv_id = konyvek.id
                  WHERE konyvek.id = :konyvid;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function insertBook($cim, $leiras, $oldalszam, $kiadasi_ev, $boritokep_url, $link_amazon, $link_bookline) {
        $query="INSERT INTO konyvek (cim, leiras, oldalszam, kiadasi_ev, boritokep_url, link_amazon, link_bookline) VALUES (:cim, :leiras, :oldalszam, :kiadasi_ev, :boritokep_url, :link_amazon, :link_bookline)";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("cim",$cim,PDO::PARAM_STR);
        $stmt->bindValue("leiras",$leiras,PDO::PARAM_STR);
        $stmt->bindValue("oldalszam",$oldalszam, PDO::PARAM_INT);
        $stmt->bindValue("kiadasi_ev",$kiadasi_ev,PDO::PARAM_INT);
        $stmt->bindValue("boritokep_url",$boritokep_url,PDO::PARAM_STR);
        $stmt->bindValue("link_amazon",$link_amazon,PDO::PARAM_STR);
        $stmt->bindValue("link_bookline",$link_bookline,PDO::PARAM_STR);
        return $stmt->execute();
    }

    protected function updateBook($id, $cim, $leiras, $oldalszam, $kiadasi_ev, $boritokep_url, $link_amazon, $link_bookline) {
        $query="UPDATE konyvek SET cim=:cim, leiras=:leiras, oldalszam=:oldalszam, kiadasi_ev=:kiadasi_ev, boritokep_url=:boritokep_url, link_amazon=:link_amazon, link_bookline=:link_bookline WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        $stmt->bindValue("cim",$cim,PDO::PARAM_STR);
        $stmt->bindValue("leiras",$leiras,PDO::PARAM_STR);
        $stmt->bindValue("oldalszam",$oldalszam, PDO::PARAM_INT);
        $stmt->bindValue("kiadasi_ev",$kiadasi_ev,PDO::PARAM_INT);
        $stmt->bindValue("boritokep_url",$boritokep_url,PDO::PARAM_STR);
        $stmt->bindValue("link_amazon",$link_amazon,PDO::PARAM_STR);
        $stmt->bindValue("link_bookline",$link_bookline,PDO::PARAM_STR);
        return $stmt->execute();
    }

    protected function deleteBook($id) {
        $query= "DELETE FROM konyvek WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}