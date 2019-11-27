<?php

interface IChatDao {
    public function insertChats($chats);
    public function deleteChats($chats);
    public function updateChats($chats);
    public function getAllChats();
    public function getChatById($chatId);
}