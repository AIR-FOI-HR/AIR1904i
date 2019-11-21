<?php

interface MessageDao {
    public function insertMessages($messages);
    public function deleteMessages($messages);
    public function updateMessages($messages);
    public function getAllMessages();
    public function getMessageById($messageId);
    public function getMessagesByChat($chatId);
    public function getMessagesBySender($senderId);
}