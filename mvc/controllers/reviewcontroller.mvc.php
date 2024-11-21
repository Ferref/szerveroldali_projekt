<?php 

class ReviewController extends ReviewModel {

    public function addBookReview($felhasznalo_id, $konyv_id, $velemeny) {
        return $this->insertBookReview($felhasznalo_id, $konyv_id, $velemeny);
    }
}