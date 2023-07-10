<?php

$config = require base_path('config.php');
$db = new Core\Database($config['database']);

$currentUserId = 1;

$query = "SELECT * FROM notes WHERE id = :id";
$id = $_GET['id'];

$note = $db->query($query, [
    'id' => $id
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note
]);
