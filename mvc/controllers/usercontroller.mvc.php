<?php 

class UserController extends UserModel {

    public function isUserExists ($userNev) {
        return $this->userExists($userNev);
    } 

    public function isEmailExists ($userNev) {
       return $this->emailExists($userNev);
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

}