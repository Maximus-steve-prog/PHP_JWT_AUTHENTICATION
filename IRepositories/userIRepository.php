<?php

    // require_once(dirname(__FILE__) ."../../Models/userModel.php");

    interface userIRepository {
        public function register(userModal $userModal);
        public function delete($id);
        public function update(userModal $userModal);
        public function findById($id);
        public function isExistEmail($email);
        public function findAll():array;
        public function login($email,$password);
        public function logout();
        public function isLoggedIn();
        public function isLoggedOut();

        public function changePassword();
        public function updatePassword();

    }

?>