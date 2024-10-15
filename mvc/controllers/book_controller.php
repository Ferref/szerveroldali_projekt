<?php

class BookController
{
    private $bookModel;

    public function __construct($dbConnection){
        $this->bookModel = new BookModel($dbConnection);
    }

    public function showRandomBook(){
        $book = $this->bookModel->getRandomBooks();

        include 'views/book_view.php';
    }
}
?>
