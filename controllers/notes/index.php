<?php

$config = require('config.php');
$db = new Database($config['database']);

$heading = "My Notes";

$query = "SELECT * FROM notes WHERE user_id = 1";

$notes = $db->query($query)->get();


require "views/notes/index.view.php";