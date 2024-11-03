<?php
class CategoryModel extends DatabaseHandler
{

    protected function getBookCategories($bookId) {
        $query = "SELECT kategoriak.nev 
                    FROM kategoriak 
                    JOIN konyv_kategoria ON kategoriak.id=konyv_kategoria.kategoria_id
                    JOIN konyvek ON konyv_kategoria.konyv_id=konyvek.id
                    WHERE konyvek.id=:konyvid;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getWirterCategories($bookId) {
        $query = "SELECT kategoriak.nev 
                    FROM kategoriak 
                    JOIN konyv_kategoria ON kategoriak.id=konyv_kategoria.kategoria_id
                    JOIN konyvek ON konyv_kategoria.konyv_id=konyvek.id
                    WHERE konyvek.id=:konyvid;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}