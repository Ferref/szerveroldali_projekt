<?php 

class CategoryView extends CategoryModel {

    public function showBookCategories($bookId){
        return $this->getBookCategories($bookId);
    }
}