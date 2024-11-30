<?php
class BookModel extends DatabaseHandler
{

    // Random konyv a kezdooldalra
    protected function getRandomBook(){
        $query = "SELECT * FROM konyvek ORDER BY RAND() LIMIT 1;";
        $result = $this->connect()->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    protected function getAllBook(){
        $query = "SELECT * FROM konyvek ORDER BY RAND();";
        $result = $this->connect()->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getLatestBookId(){
        $query = "SELECT id FROM konyvek ORDER BY id DESC LIMIT 1;";
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
        $query = "SELECT DISTINCT k.id, k.cim, k.boritokep_url
                    FROM konyvek k
                    JOIN konyv_kategoria kk ON k.id = kk.konyv_id
                    JOIN konyv_kategoria kk2 ON kk.kategoria_id = kk2.kategoria_id
                    WHERE kk2.konyv_id = :konyvid AND k.id != kk2.konyv_id
                    ORDER BY RAND()
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
        $query = "SELECT DISTINCT konyvek.id AS konyv_id, COUNT(ertekeles) AS ertekelesek_szama, AVG(ertekeles) AS atlag_ertekeles
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

    protected function isBookExist($bookId) {
        $query = "SELECT id FROM konyvek WHERE id=:bookId";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("bookId",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        if ($stmt->rowCount()!=0){
            return true;
        } else {
            return false;
        }
    }

    protected function getBookInfoName($name,$page) {
        $query = "SELECT id, cim, oldalszam, kiadasi_ev FROM konyvek WHERE cim LIKE :cim LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("cim",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getBookInfoNamePageNumber($name) {
        $query = "SELECT COUNT(id) as oldalak_szama FROM konyvek WHERE cim LIKE :cim;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("cim",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getAllBookInfo($page) {
        $query = "SELECT id, cim, oldalszam, kiadasi_ev FROM konyvek LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getAllBookInfoPageNumber() {
        $query = "SELECT COUNT(id) as oldalak_szama FROM konyvek;";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getBookBySearch($kereses){
        $query = "SELECT k.* 
                    FROM konyvek k 
                    INNER JOIN konyv_szerzo ksz ON ksz.konyv_id=k.id
                    INNER JOIN szerzok sz ON ksz.szerzo_id=sz.id
                    WHERE k.cim LIKE :kereses OR sz.nev LIKE :kereses;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("kereses",'%'.$kereses.'%',PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getBookByCategorySearch($keresesId){
        $query = "SELECT k.* 
                    FROM konyvek k 
                    INNER JOIN konyv_kategoria kk ON kk.konyv_id=k.id
                    INNER JOIN kategoriak ka ON kk.kategoria_id=ka.id
                    WHERE ka.id=:keresesId;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("keresesId",$keresesId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getFavouriteBooks($userId){
        $query = "SELECT k.id, k.cim, k.boritokep_url
                    FROM konyvek k
                    JOIN kedvencek ke ON k.id = ke.konyv_id
                    WHERE ke.felhasznalo_id = :userId";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userId",$userId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getReadBooks($userId){
        $query = "SELECT k.id, k.cim, k.boritokep_url
                    FROM konyvek k
                    JOIN olvasott o ON k.id = o.konyv_id
                    WHERE o.felhasznalo_id = :userId";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userId",$userId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getWaitBooks($userId){
        $query = "SELECT k.id, k.cim, k.boritokep_url
                    FROM konyvek k
                    JOIN varolistak v ON k.id = v.konyv_id
                    WHERE v.felhasznalo_id = :userId";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userId",$userId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}