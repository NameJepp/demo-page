<?php

require 'functions.php';
require 'Database.php';
//require 'router.php';



//connect to our MySQL database. and execute a query


$db = new Database();

$posts = $db->query("select * from posts where id = 1")->fetchAll(PDO::FETCH_ASSOC);



foreach ($posts as $post) {
    echo "<h1>" . $post['title'] . "</h1>";
    echo "<li>" . $post['content'] . "</li>";
}
