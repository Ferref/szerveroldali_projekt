<?php 

class CategoryView extends CategoryModel {

    public function showBookCategories($bookId){
        return $this->getBookCategories($bookId);
    }

    public function showSpecificCategoryNumber($categoryId) {
        return $this->getSpecificCategoryNumber($categoryId);
    }

    public function showCategories() {
        return $this->getCategories();
    }

    public function showIsCategoryInBook($bookId, $categoryId) {
        return $this->isCategoryInBook($bookId, $categoryId);
    }

    function showCategoryInfoName($name,$page) {
        return $this->getCategoryInfoName($name,$page);
    }

    public function showCategoryInfoNamePageNumber($name) {
        return $this->getCategoryInfoNamePageNumber($name);
    }

    function showAllCategoryInfo($page) {
        return $this->getAllCategoryInfo($page);
    }

    public function showAllCategoryInfoPageNumber() {
        return $this->getAllCategoryInfoPageNumber();
    }

    public function showCategoryInfo($id) {
        return $this->getCategoryInfo($id);
    }
}