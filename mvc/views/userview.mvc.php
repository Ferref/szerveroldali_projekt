<?php 

class UserView extends UserModel {

    public function showUserInfo($userName) {
        return $this->getUserInfo($userName);
    }

    public function showUserInfoById($userId) {
        return $this->getUserInfoById($userId);
    }

    public function showAllUserInfo($page) {
        return $this->getAllUserInfo($page);
    }
    

    public function showAllUserInfoPageNumber() {
        return $this->getAllUserInfoPageNumber();
    }

    public function showUserInfoName($name,$page) {
        return $this->getUserInfoName($name,$page);
    }

    public function showUserInfoNamePageNumber($name) {
        return $this->getUserInfoNamePageNumber($name);
    }

    public function showUserInfoEmail($email,$page) {
        return $this->getUserInfoEmail($email,$page);
    }

    public function showUserInfoEmailPageNumber($email) {
        return $this->getUserInfoEmailPageNumber($email);
    }

    public function showUserInfoNameEmail($name,$email,$page) {
        return $this->getUserInfoNameEmail($name,$email,$page);
    }

    public function showUserInfoNameEmailPageNumber($name,$email) {
        return $this->getUserInfoNameEmailPageNumber($name,$email);
    }

    public function showUserBookRate($userId, $bookId) {
        return $this->getUserBookRate($userId, $bookId);
    }

    public function showAllUserRate($page) {
        return $this->getAllUserRate($page);
    }
    

    public function showAllUserRatePageNumber() {
        return $this->getAllUserRatePageNumber();
    }

    public function showUserRate($name,$page) {
        return $this->getUserRate($name,$page);
    }

    public function showUserRatePageNumber($name) {
        return $this->getUserRatePageNumber($name);
    }

    public function showBookRate($book,$page) {
        return $this->getBookRate($book,$page);
    }

    public function showBookRatePageNumber($book) {
        return $this->getBookRatePageNumber($book);
    }

    public function showUserBookRates($name,$book,$page) {
        return $this->getUserBookRates($name,$book,$page);
    }

    public function showUserBookRatesPageNumber($name,$book) {
        return $this->getUserBookRatesPageNumber($name,$book);
    }

}
