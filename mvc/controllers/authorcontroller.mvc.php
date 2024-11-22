<?php 
class AuthorController extends AuthorModel {

    public function addBookWriter($bookid,$categoryId) {
        return $this->insertBookWriter($bookid,$categoryId);
    }
    function removeBookWriters($bookId) {
        return $this->deleteBookWriters($bookId);
    }
    
    function getIsWriterExist($writerId) {
        return $this->isWriterExist($writerId);
    }

    function insertNewWriter($nev, $profilkep_url, $szuletesi_ido, $halal_ido, $szarmazas) {
        return $this->insertWriter($nev, $profilkep_url, $szuletesi_ido, $halal_ido, $szarmazas);
    }

    function updatingWriter($id, $nev, $profilkep_url, $szuletesi_ido, $halal_ido, $szarmazas) {
        return $this->updateWriter($id,$nev, $profilkep_url, $szuletesi_ido, $halal_ido, $szarmazas);
    }

    function removeWriter($id) {
        return $this->deleteWriter($id);
    }


}