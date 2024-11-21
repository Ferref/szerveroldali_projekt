<?php 

class UserView extends UserModel {

    public function showUserInfo($userId) {
        return $this->getUserInfo($userId);
    }

    public function showAllUserInfo($page) {
        return $this->getAllUserInfo($page);
    }

    public function showAllUserInfoPageNumber() {
        return $this->getAllUserInfoPageNumber();
    }
}
