<?php 

class UserView extends UserModel {

    public function showUserInfo($userId) {
        return $this->getUserInfo($userId);
    }

    public function showAllUserInfo() {
        return $this->getAllUserInfo();
    }
}