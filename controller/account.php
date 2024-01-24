<?php
include '../includes.php';

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
}
header('Location: ../');
die;

function login(): void
{
    $db = new Database();
    $rememberLogin = isset($_POST['rememberLogin']);
    $hasError = false;
    $wrongPassOrEmail = "Email or password is incorrect";

    if (empty($_POST['email'])) {
        $_SESSION['invalid']['email'] = 'Please enter a valid email address.';
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
        die;
    }

    // Check email
    $userExists = $db->checkUser($email);
    if (!$userExists) {
        $_SESSION['ui-message'] = $wrongPassOrEmail;
        header('Location: ../?p=login');
        die;
    }

    // Verify password
    $dbPassword = $db->getPassword($email);
    if (!password_verify($password, $dbPassword)) {
        $_SESSION['ui-message'] = "Email or password is incorrect";
        header('Location: ../?p=login');
        die;
    }

    $_SESSION['user'] = $db->getUser($email);
}

function register(): void
{
    if (empty($_POST['gdpr'])) {
        $_SESSION['invalid']['gdpr'] = 'Please agree to the Privacy policy to continue.';
        header('Location: ../?p=register');
        die;
    }
    $gdpr = new DateTime();

    $hasError = false;
    $db = new Database();

    if (empty($_POST['email'])) {
        $_SESSION['invalid']['email'] = 'Please enter a valid email address.';
        $hasError = true;
    }
    $email = $_POST['email'];

    // Check if email exists
    if ($db->checkUser($email)) {
        $_SESSION['invalid']['email'] = 'A user with this email address already exists.';
        header('Location: ../?p=register');
        die;
    }
    // If not, continue
    // If it does, inform the user and do not create an account

    if (empty($_POST['firstName'])) {
        $_SESSION['invalid']['firstName'] = 'Please fill out your first name.';
        $hasError = true;
    }
    $firstName = $_POST['firstName'];

    if (empty($_POST['lastName'])) {
        $_SESSION['invalid']['lastName'] = 'Please fill out your surname.';
        $hasError = true;
    }
    $lastName = $_POST['lastName'];

    if (empty($_POST['password'])) {
        $_SESSION['invalid']['password'] = 'Please choose a password.';
        $hasError = true;
    }
    $password = $_POST['password']; // password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (empty($_POST['passwordRepeat'])) {
        $_SESSION['invalid']['passwordRepeat'] = 'Please reenter your chosen password.';
        $hasError = true;
    }
    $passwordRepeat = $_POST['passwordRepeat']; // password_hash($_POST['passwordRepeat'], PASSWORD_DEFAULT);

    // Check if passwords match
    if ($password != $passwordRepeat) {
        $_SESSION['invalid']['passwordRepeat'] = 'Passwords do not match';
        $hasError = true;
    } else {
        unset($passwordRepeat);
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    if (empty($_POST['addressLine1'])) {
        $_SESSION['invalid']['addressLine1'] = 'Please enter an address.';
        $hasError = true;
    }
    $addressLine1 = $_POST['addressLine1'];

    $addressLine2 = $_POST['addressLine2'] ?? null;

    if (empty($_POST['city'])) {
        $_SESSION['invalid']['city'] = 'Please enter a city.';
        $hasError = true;
    }
    $city = $_POST['city'];

    if (empty($_POST['county'])) {
        $_SESSION['invalid']['county'] = 'Please select a county.';
        $hasError = true;
    }
    $county = $_POST['county'];

    if (empty($_POST['postalCode'])) {
        $_SESSION['invalid']['postalCode'] = 'Please enter an Éircode/Postcode.';
        $hasError = true;
    }
    $postalCode = $_POST['postalCode'];

    if (empty($_POST['country'])) {
        $_SESSION['invalid']['country'] = 'Please select a country.';
        $hasError = true;
    }
    $country = $_POST['country'];

    if ($hasError) {
        header('Location: ../?p=register');
        die;
    }

    if ($db->createUser($firstName, $lastName, $email, $password, $gdpr)) {
        $_SESSION['ui-message'] = 'Your account has been successfully created, you can now log in';
        header('Location: ../?p=login');
    } else {
        $_SESSION['ui-message'] = 'Your account couldn\'t be created, please try again';
        header('Location: ../?p=register');
    }
    die;
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
    header('Location: ../?p=' . ($_GET['burl'] ?? ''));
}

function goto_login(): void
{
    header('Location: ../?p=login');
    die();
}
