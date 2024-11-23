<?php
class AuthorModel extends DatabaseHandler
{

    // Iro informacioinak lekerese
    protected function getWriterInfo($writerId) {
        $query = "SELECT * FROM szerzok WHERE id = :writerid";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("writerid",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getAllWriter() {
        $query = "SELECT id, nev FROM szerzok";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Iro konyveinek lekerese
    protected function getWriterBooks($writerId) {
        $query = "SELECT k.id, k.cim, k.leiras, k.boritokep_url 
                  FROM konyvek k
                  JOIN konyv_szerzo ksz ON k.id = ksz.konyv_id
                  WHERE ksz.szerzo_id = :writerid";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("writerid",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Iro konyveinek atlagos ertekelese
    protected function getWriterBooksAvgRating($writerId) {
        $query = "SELECT COUNT(ertekeles) AS ertekelesek_szama, AVG(e.ertekeles) as atlag_ertekeles
                  FROM ertekelesek e
                  JOIN konyv_szerzo ksz ON e.konyv_id = ksz.konyv_id
                  WHERE ksz.szerzo_id = :writerid";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("writerid",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getBookWriters($bookId){
        $query = "SELECT *
                  FROM szerzok
                  JOIN konyv_szerzo ON konyv_szerzo.szerzo_id = szerzok.id
                  JOIN konyvek ON konyvek.id = konyv_szerzo.konyv_id
                  WHERE konyvek.id = :konyvid;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getWriterCategories($writerId) {
        $query = "SELECT DISTINCT nev
                  FROM kategoriak
                  JOIN konyv_kategoria ON konyv_kategoria.kategoria_id = kategoriak.id
                  JOIN konyv_szerzo ON konyv_szerzo.konyv_id = konyv_kategoria.konyv_id
                  WHERE konyv_szerzo.szerzo_id = :writerId;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("writerId",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function isWriterWroteBook($bookId, $writerId) {
        $query = "SELECT * FROM konyv_szerzo WHERE konyv_id=:bookId AND szerzo_id=:writerId";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("bookId",$bookId,PDO::PARAM_INT); 
        $stmt->bindValue("writerId",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        if ($stmt->rowCount()==1){
            return true;
        } else {
            return false;
        }
    }

    protected function insertBookWriter($bookId, $writerId) {
        $query="INSERT INTO konyv_szerzo (konyv_id, szerzo_id) VALUES (:bookId, :writerId)";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("bookId",$bookId, PDO::PARAM_INT);
        $stmt->bindValue("writerId",$writerId,PDO::PARAM_INT);
        return $stmt->execute();
    }

    protected function deleteBookWriters($id) {
        $query= "DELETE FROM konyv_szerzo WHERE konyv_id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    protected function isWriterExist($writerId) {
        $query = "SELECT id FROM szerzok WHERE id=:writerId";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("writerId",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        if ($stmt->rowCount()!=0){
            return true;
        } else {
            return false;
        }
    }

    protected function insertWriter($nev, $profilkep_url, $szuletesi_ido, $halal_ido, $szarmazas) {
        $query="INSERT INTO szerzok (nev, profilkep_url, szuletesi_ido, halal_ido, szarmazas) VALUES (:nev, :profilkep_url, :szuletesi_ido, :halal_ido, :szarmazas)";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",$nev,PDO::PARAM_STR);
        $stmt->bindValue("profilkep_url",$profilkep_url,PDO::PARAM_STR);
        $stmt->bindValue("szuletesi_ido",$szuletesi_ido, PDO::PARAM_STR);
        $stmt->bindValue("halal_ido",$halal_ido,PDO::PARAM_STR);
        $stmt->bindValue("szarmazas",$szarmazas,PDO::PARAM_STR);
        return $stmt->execute();
    }

    protected function updateWriter($id, $nev, $profilkep_url, $szuletesi_ido, $halal_ido, $szarmazas) {
        $query="UPDATE szerzok SET nev=:nev, profilkep_url=:profilkep_url, szuletesi_ido=:szuletesi_ido, halal_ido=:halal_ido, szarmazas=:szarmazas WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id,PDO::PARAM_INT);
        $stmt->bindValue("nev",$nev,PDO::PARAM_STR);
        $stmt->bindValue("profilkep_url",$profilkep_url,PDO::PARAM_STR);
        $stmt->bindValue("szuletesi_ido",$szuletesi_ido, PDO::PARAM_STR);
        $stmt->bindValue("halal_ido",$halal_ido,PDO::PARAM_STR);
        $stmt->bindValue("szarmazas",$szarmazas,PDO::PARAM_STR);
        return $stmt->execute();
    }

    protected function deleteWriter($id) {
        $query= "DELETE FROM szerzok WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    protected function getSpecificWriterBookNumber($writerId) {
        $query = "SELECT COUNT(id) as konyv_mennyiseg
                    FROM konyv_szerzo 
                    WHERE szerzo_id=:writerId;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("writerId",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result['konyv_mennyiseg'];
    }

    protected function getWriterInfoName($name,$page) {
        $query = "SELECT id, nev, szarmazas FROM szerzok WHERE nev LIKE :nev LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getWriterInfoNamePageNumber($name) {
        $query = "SELECT COUNT(id) as oldalak_szama FROM szerzok WHERE nev LIKE :nev;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getAllWriterInfo($page) {
        $query = "SELECT id, nev, szarmazas FROM szerzok LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getAllWriterInfoPageNumber() {
        $query = "SELECT COUNT(id) as oldalak_szama FROM szerzok;";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

