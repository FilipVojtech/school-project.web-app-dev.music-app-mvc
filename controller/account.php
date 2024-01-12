<?php
if (PHP_SESSION_ACTIVE != session_status()) {
    session_start();
}
$action = null;

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($action) {
    case 'login':
        login();
        break;
    case 'register':
        register();
        break;
    case 'verify':
        verify();
        break;
    case 'logout':
        logout();
        break;
    default:
        header('Location: ../');
        die;
}
die;

function login(): void
{
    $rememberLogin = isset($_POST['rememberLogin']);
    $hasError = false;

    if (empty($_POST['email'])) {
        $_SESSION['invalid']['email'] = 'Please enter a valid email.';
        $hasError = true;
    }
    $email = $_POST['email'];

    if (empty($_POST['password'])) {
        $_SESSION['invalid']['password'] = 'Please enter a password.';
        $hasError = true;
    }
    $password = $_POST['password'];

    if ($hasError) {
        header('Location: ../?p=login');
        return;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    // todo: Verify password

    // todo: Login user or return back to login with error message
}

function register(): void
{

}

function verify(): void
{

}

function logout(): void
{
    setcookie(session_name(), '', 100);
    session_unset();
    session_destroy();
    $_SESSION = array();
}

function goto_login(): void
{
    header('Location: ../?p=login');
    die();
}


