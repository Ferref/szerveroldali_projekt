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
}