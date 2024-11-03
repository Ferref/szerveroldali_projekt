<?php 

class BookView extends BookModel {
    public function showRandomBook() {
        return $this->getRandomBook();
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
}