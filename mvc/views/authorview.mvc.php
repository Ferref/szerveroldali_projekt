<?php 

class AuthorView extends AuthorModel {

    function showAuthorInfo($authorId) {
        return $this->getWriterInfo($authorId);
    }

    function showAuthorBooks($authorId) {
        return $this->getWriterBooks($authorId);
    }

    function showBookAuthors($bookId) {
        return $this->getBookWriters($bookId);
    }

    function showAuthorBooksAvgRating($authorId) {
        return $this->getWriterBooksAvgRating($authorId);
    }

    function showWriterCategories($authorId) {
        return $this->getWriterCategories($authorId);
    }

}