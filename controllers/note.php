<?php

$config = require('config.php');
$db = new Database($config['database']);

$heading = "Note";

$id = $_GET['id'];
$currentUserId = 1;
$query = "select * from notes where id = :id";

$note = $db->query($query, [
    'id' => $id
])->fetch();

if (! $note) {
    abort();
}

if ($note['user_id'] !== $currentUserId) {
    abort(Response::FORBIDDEN);
}

require "views/note.view.php";
