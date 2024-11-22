<?php 

class ReviewView extends ReviewModel {

    public function showBookReviews($bookId) {
        return $this->getBookReviews($bookId);
    }
}
