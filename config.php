<?php

define('DB_PATH', __DIR__ . '/src/database/chatapp.db');

function getDatabaseConnection()
{
    if (!file_exists(DB_PATH)) {
        $db = new PDO('sqlite:' . DB_PATH);
        $db->exec('CREATE TABLE IF NOT EXISTS groups (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT)');
        $db->exec('CREATE TABLE IF NOT EXISTS messages (id INTEGER PRIMARY KEY AUTOINCREMENT, group_id INTEGER, user_id INTEGER, messages TEXT)');
    } else {
        $db = new PDO('sqlite:' . DB_PATH);
    }
    return $db;
}
