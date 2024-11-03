<?php

class BookController
{
    private $bookModel;

    public function __construct($dbConnection){
        // Hasznaljuk fel a book_modelt
        $this->bookModel = new BookModel($dbConnection);
    }

    // Dolgok lekerese a book_model-bol
    public function showRandomBook(){

        // Ha van konyv
        $book = $this->bookModel->getRandomBooks();

        include 'views/book_view.php';

        // Ha nincs konyv, akkor ne jelenitsen meg semmit
        if($book){
            include 'views/book_random_view.php';
        }
        else {
            echo "Nincs elérhető könyv!";
        }
    }
    public function listMostPopularBooks()
    {
        // Legnebszerubb konyvek lekerese
        $popularBooks = $this->bookModel->getMostPopularBooks();

        // Ha vannak konyvek jelenitsuk meg, ha nincs akkor ne
        if ($popularBooks) {
            include 'views/books_popular_view.php';
        } else {
            echo "Nincs elérhető népszerű könyv.";
        }
    }

    public function showBookDetails($bookId)
    {
        // Konyv reszleteinek lekerese (id alapjan)
        $bookDetails = $this->bookModel->getBookInfo($bookId);
        // velemenyek, kommentek lekerese
        $reviews = $this->bookModel->getBookReviewsAndComments($bookId);

        // Konyv reszleteinek megjelenitese, ha van
        if ($bookDetails) {
            include 'views/book_details_view.php';
        } else {
            echo "A megadott könyv nem található.";
        }
    }

    public function showBookReviewsAndComments($bookId)
    {
        // Velemenyek es hozzaszolasok lekerese
        $reviews = $this->bookModel->getBookReviewsAndComments($bookId);

        // Ha vannak velemenyek, jelenitsuk meg
        if ($reviews) {
            include 'views/book_reviews_view.php';
        } else {
            echo "Ehhez a könyvhöz még nincsenek vélemények.";
        }
    }

    public function showSimilarBooks($bookId)
    {
        // Hasonlo konyvek lekerese
        $similarBooks = $this->bookModel->getSimilarBooks($bookId);
        // Ha vannak hasonlo konyvek
        if ($similarBooks) {
            include 'views/books_similar_view.php';
        } else {
            echo "Nincsenek hasonló könyvek.";
        }
    }

}

?>
