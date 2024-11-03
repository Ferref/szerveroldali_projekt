<?php

class BookController extends BookModel
{
    public function insertNewBook($cim, $leiras, $oldalszam, $kiadasi_ev, $boritokep_url, $link_amazon, $link_bookline){
        $this->insertBook($cim, $leiras, $oldalszam, $kiadasi_ev, $boritokep_url, $link_amazon, $link_bookline);
    }

    public function updatingBook($id, $cim, $leiras, $oldalszam, $kiadasi_ev, $boritokep_url, $link_amazon, $link_bookline){
        $this->updateBook($id, $cim, $leiras, $oldalszam, $kiadasi_ev, $boritokep_url, $link_amazon, $link_bookline);
    }

    public function removeBook($id) {
        $this->deleteBook($id);
    }
}

