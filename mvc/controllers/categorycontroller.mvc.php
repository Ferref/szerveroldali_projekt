<?php

class CategoryController extends CategoryModel {

    public function addBookCategory($bookid,$categoryId) {
        return $this->insertBookCategory($bookid,$categoryId);
    }

    public function removeBookCategories($bookid) {
        return $this->deleteBookCategories($bookid);
    }

    public function getIsCategoryExist($categoryId) {
        return $this->isCategoryExist($categoryId);
    }

    public function getIsCategoryExistByName($categoryId) {
        return $this->isCategoryExistByName($categoryId);
    }


    public function createCategory($nev) {
        return $this->insertCategory($nev);
    }

    public function modifyCategory($id, $nev) {
        return $this->updateCategory($id, $nev);
    }

    public function removeCategory($id) {
        return $this->deleteCategory($id);
    }

}