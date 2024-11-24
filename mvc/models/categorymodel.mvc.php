<?php
class CategoryModel extends DatabaseHandler
{

    protected function getBookCategories($bookId) {
        $query = "SELECT kategoriak.nev, kategoriak.id
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

    protected function getSpecificCategoryNumber($categoryId) {
        $query = "SELECT COUNT(id) as kategoria_mennyiseg
                    FROM konyv_kategoria 
                    WHERE kategoria_id=:categoryId;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("categoryId",$categoryId,PDO::PARAM_INT); 
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result['kategoria_mennyiseg'];
    }

    protected function getCategories() {
        $query = "SELECT * FROM kategoriak";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function isCategoryInBook($bookId, $categoryId) {
        $query = "SELECT * FROM konyv_kategoria WHERE konyv_id=:bookId AND kategoria_id=:categoryId";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("bookId",$bookId,PDO::PARAM_INT); 
        $stmt->bindValue("categoryId",$categoryId,PDO::PARAM_INT); 
        $stmt->execute();
        if ($stmt->rowCount()==1){
            return true;
        } else {
            return false;
        }
    }

    protected function insertBookCategory($bookId, $categoryId) {
        $query="INSERT INTO konyv_kategoria (konyv_id, kategoria_id) VALUES (:bookId, :categoryId)";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("bookId",$bookId, PDO::PARAM_INT);
        $stmt->bindValue("categoryId",$categoryId,PDO::PARAM_INT);
        return $stmt->execute();
    }

    protected function deleteBookCategories($id) {
        $query= "DELETE FROM konyv_kategoria WHERE konyv_id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    protected function isCategoryExist($categoryId) {
        $query = "SELECT id FROM kategoriak WHERE id=:categoryId";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("categoryId",$categoryId,PDO::PARAM_INT); 
        $stmt->execute();
        if ($stmt->rowCount()!=0){
            return true;
        } else {
            return false;
        }
    }

}