<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'includes.php';

if (PHP_SESSION_ACTIVE != session_status()) {
    session_start();
}

$action = $_GET['p'] ?? '';
//$action = 'register';

$model = null;

switch ($action) {
    case '':
    default:
        $model = new HomeModel("Homepage");
        break;
    case 'products':
        $model = new ProductsModel("Products");
        break;
    case 'login':
        $model = new LoginModel('Login');
        break;
    case 'register':
        $model = new RegisterModel('Register');
        break;
}
?>
<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<editor-fold desc="Bootstrap">-->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    >
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    >
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"
    ></script>
    <!--</editor-fold>-->
    <link rel="stylesheet" href="/css/style.css">
    <title><?= $model->title ?></title>
    <?= $model->getModelSpecificHeadContent(); ?>
</head>
<body>
<?php
include 'view_partial/Header.php'; ?>
<main class="col-12 col-xl-6 col-lg-8 col-md-10 mx-auto">
    <?= $model; ?>
</main>
<?php
include 'view_partial/Footer.php';
?>
</body>
</html>
