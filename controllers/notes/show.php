<?php

$config = require('config.php');
$db = new Database($config['database']);

$heading = "Note";
$currentUserId = 1;

$query = "SELECT * FROM notes WHERE id = :id";
$id = $_GET['id'];

$note = $db->query($query, [
    'id' => $id
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

require "views/notes/show.view.php";