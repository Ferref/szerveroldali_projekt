<?php 

class UserController extends UserModel {

    public function isUserExists ($userNev) {
        return $this->userExists($userNev);
    } 

    public function isEmailExists ($userEmail) {
       return $this->emailExists($userEmail);
    } 

    public function isIdExists ($userId) {
        return $this->idExists($userId);
     } 

    public function getUserPassword ($userNev) {
       return $this->userPassword($userNev);
    } 

    public function registerUser ($nev, $email, $jelszo, $szerep) {
        return $this->insertUser($nev, $email, $jelszo, $szerep);
    } 

    public function modifyUserWithoutPassword ($id, $nev, $email, $profilkep_url) {
        return $this->updateUserWithoutPassword($id, $nev, $email, $profilkep_url);
    } 

    public function modifyUserWithPassword ($id, $nev, $email, $jelszo, $profilkep_url) {
        return $this->updateUserWithPassword($id, $nev, $email, $jelszo,$profilkep_url);
    } 

    public function removeUser ($id) {
        return $this->deleteUser($id);
    } 

    public function getIsBookFavourite ($userId, $bookId) {
        return $this->isBookFavourite($userId, $bookId);
    } 

    public function removeBookFavourite ($userId, $bookId) {
        return $this->deleteBookFavourite($userId, $bookId);
    }

    public function createBookFavourite ($userId, $bookId) {
        return $this->insertBookFavourite($userId, $bookId);
    }

    public function getIsBookRead ($userId, $bookId) {
        return $this->isBookRead($userId, $bookId);
    } 

    public function removeBookRead($userId, $bookId) {
        return $this->deleteBookRead($userId, $bookId);
    }

    public function createBookRead ($userId, $bookId) {
        return $this->insertBookRead($userId, $bookId);
    }

    public function getIsBookWaited ($userId, $bookId) {
        return $this->isBookWaited($userId, $bookId);
    } 

    public function removeBookWaited($userId, $bookId) {
        return $this->deleteBookWaited($userId, $bookId);
    }

    public function createBookWaited ($userId, $bookId) {
        return $this->insertBookWaited($userId, $bookId);
    }

    public function getIsBookRated ($userId, $bookId) {
        return $this->isBookRated($userId, $bookId);
    } 

    public function removeBookRate($id) {
        return $this->deleteBookRate($id);
    }

    public function createBookRate ($userId, $bookId, $ertekeles) {
        return $this->insertBookRate($userId, $bookId, $ertekeles);
    }

    public function modifyBookRate ($userId, $bookId, $ertekeles) {
        return $this->updateBookRate($userId, $bookId, $ertekeles);
    }

    public function getIsUserAdmin ($userId) {
        return $this->isUserAdmin($userId);
    }

}