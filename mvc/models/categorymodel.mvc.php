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

    protected function isCategoryExistByName($nev) {
        $query = "SELECT id FROM kategoriak WHERE nev=:nev";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",$nev,PDO::PARAM_STR); 
        $stmt->execute();
        if ($stmt->rowCount()!=0){
            return true;
        } else {
            return false;
        }
    }

    protected function getCategoryInfoName($name,$page) {
        $query = "SELECT id, nev FROM kategoriak WHERE nev LIKE :nev LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getCategoryInfoNamePageNumber($name) {
        $query = "SELECT COUNT(id) as oldalak_szama FROM kategoriak WHERE nev LIKE :nev;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getAllCategoryInfo($page) {
        $query = "SELECT id, nev FROM kategoriak LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getAllCategoryInfoPageNumber() {
        $query = "SELECT COUNT(id) as oldalak_szama FROM kategoriak;";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getCategoryInfo($id) {
        $query = "SELECT nev FROM kategoriak WHERE id=:id;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function insertCategory($nev) {
        $query="INSERT INTO kategoriak (nev) VALUES (:nev)";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",$nev, PDO::PARAM_STR);
        return $stmt->execute();
    }

    protected function updateCategory($id, $nev) {
        $query="UPDATE kategoriak SET nev=:nev WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",$nev, PDO::PARAM_STR);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    protected function deleteCategory($id) {
        $query="DELETE FROM kategoriak WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}