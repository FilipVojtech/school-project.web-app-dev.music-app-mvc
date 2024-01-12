<?php
if (PHP_SESSION_ACTIVE != session_status()) {
    session_start();
}
$action = null;

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($action) {
    case 'addToBasket':
        // todo: Add to basket
        break;
    default:
        // todo: Back to main page
        die;
}
die;
