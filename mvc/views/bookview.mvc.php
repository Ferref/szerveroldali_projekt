<?php 

class BookView extends BookModel {
    public function showRandomBook() {
        return $this->getRandomBook();
    }

    public function showAllBook() {
        return $this->getAllBook();
    }

    public function showCategories($bookId) {
        return $this->getCategories($bookId);
    }

    public function showBookInfo($bookId) {
        return $this->getBookInfo($bookId);
    }

    public function showSimilarBooks($bookId) {
        return $this->getSimilarBooks($bookId);
    }

    public function showMostPopularBooks() {
        return $this->getMostPopularBooks();
    }
    
    public function showBookRating($bookId) {
        return $this->getBookRating($bookId);
    }

    public function showAllBookInfo($page) {
        return $this->getAllBookInfo($page);
    }
    
    public function showAllBookInfoPageNumber() {
        return $this->getAllBookInfoPageNumber();
    }

    public function showBookInfoName($name,$page) {
        return $this->getBookInfoName($name,$page);
    }
    
    public function showBookInfoNamePageNumber($name) {
        return $this->getBookInfoNamePageNumber($name);
    }

    public function showBookBySearch($kereses) {
        return $this->getBookBySearch($kereses);
    }

    public function showBookByCategorySearch($keresesId) {
        return $this->getBookByCategorySearch($keresesId);
    }
}