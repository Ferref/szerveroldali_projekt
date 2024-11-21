<?php

class BookController extends BookModel
{
    public function insertNewBook($cim, $leiras, $oldalszam, $kiadasi_ev, $boritokep_url, $link_amazon, $link_bookline){
        return $this->insertBook($cim, $leiras, $oldalszam, $kiadasi_ev, $boritokep_url, $link_amazon, $link_bookline);
    }

    public function updatingBook($id, $cim, $leiras, $oldalszam, $kiadasi_ev, $boritokep_url, $link_amazon, $link_bookline){
        return $this->updateBook($id, $cim, $leiras, $oldalszam, $kiadasi_ev, $boritokep_url, $link_amazon, $link_bookline);
    }

    public function removeBook($id) {
        return $this->deleteBook($id);
    }

    public function latestBookId() {
        return $this->getLatestBookId();
    }

    public function getIsBookExist($bookId) {
        return $this->isBookExist($bookId);
    }
}

