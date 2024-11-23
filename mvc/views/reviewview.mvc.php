<?php 

class ReviewView extends ReviewModel {

    public function showBookReviews($bookId) {
        return $this->getBookReviews($bookId);
    }

    public function showReview($id) {
        return $this->getReview($id);
    }

    public function showAllReviewInfo($page) {
        return $this->getAllReviewInfo($page);
    }
    
    public function showAllReviewInfoPageNumber() {
        return $this->getAllReviewInfoPageNumber();
    }

    public function showReviewInfoName($name,$page) {
        return $this->getReviewInfoName($name,$page);
    }

    public function showReviewInfoNamePageNumber($name) {
        return $this->getReviewInfoNamePageNumber($name);
    }

    public function showReviewInfoBook($book,$page) {
        return $this->getReviewInfoBook($book,$page);
    }

    public function showReviewInfoBookPageNumber($book) {
        return $this->getReviewInfoBookPageNumber($book);
    }

    public function showReviewInfoNameBook($name,$book,$page) {
        return $this->getReviewInfoNameBook($name,$book,$page);
    }

    public function showReviewInfoNameBookPageNumber($name,$book) {
        return $this->getReviewInfoNameBookPageNumber($name,$book);
    }
}
