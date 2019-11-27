<?php

interface IUserDao {
    public function insertUsers($users);
    public function deleteUsers($users);
    public function updateUsers($users);
    public function getAllUsers();
    public function getUserById($userId);
    public function getUserByUsername($username);
    public function getUserByEmail($email);
}