<?php 

class UserController extends UserModel {

    public function isUserExists ($userNev) {
        return $this->userExists($userNev);
    } 

    public function isEmailExists ($userNev) {
       return $this->emailExists($userNev);
    } 

    public function getUserPassword ($userNev) {
       return $this->userPassword($userNev);
    } 

    public function registerUser ($nev, $email, $jelszo, $szerep) {
        return $this->insertUser($nev, $email, $jelszo, $szerep);
    } 

}