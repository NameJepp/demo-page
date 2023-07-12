<?php

# Login the user if entered credentials match a user in the database

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_SESSION['email'];
$password = $_SESSION['password'];

$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email adress';
}

if (!Validator::string($password)) {
    $errors['email'] = 'Please provide a valid password';
}

if (!empty($errors)) {
    return view('sessions/create.view.php', [
        'errors' => $errors,
    ]);
}

// match the credentials
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email,
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        login([
            'email' => $email,
        ]);
        header('location: /');
        exit();
    }
}

if (! $user) {
    return view('sessions/create.view.php', [
        'errors' => [
            'email' => 'No matching account found for that email adress and password',
        ],
    ]);
}
