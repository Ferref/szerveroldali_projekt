<?php 

class ReviewController extends ReviewModel {

    public function addBookReview($felhasznalo_id, $konyv_id, $velemeny) {
        return $this->insertBookReview($felhasznalo_id, $konyv_id, $velemeny);
    }

    public function getIsReviewExist($id) {
        return $this->isReviewExist($id);
    }

    public function refreshReview($id, $velemeny) {
        return $this->updateReview($id, $velemeny);
    }

    public function removeReview($id) {
        return $this->deleteReview($id);
    }
}