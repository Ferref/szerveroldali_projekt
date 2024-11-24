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

}