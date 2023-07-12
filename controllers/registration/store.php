<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs
$errors = [];
if (!Validator::email($email)) {
    $errors['$email'] = 'Please provide a valid email adress.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);
// check if the account already excists
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if ($user) {
    header('location: /login');
    exit();
} else {
    // if not, save one to the database, then log the userr in, and redirect
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
    ]);
}


login([
    'email' => $email
]);

header('location: /');
exit();
