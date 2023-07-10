<?php

$config = require base_path('config.php');
$db = new Core\Database($config['database']);

$query = "SELECT * FROM notes WHERE user_id = 1";

$notes = $db->query($query)->get();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes,
]);
