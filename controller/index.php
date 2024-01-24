<?php
include_once '../libraries/Database.php';
if (PHP_SESSION_ACTIVE != session_status()) {
    session_start();
}
$action = null;

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

$db = new Database();

switch ($action) {
    case 'getProductInfo':
        if (!isset($_GET['id'])) {
            die;
        }
        header('Type: application/json');
        echo json_encode($db->getProduct($_GET['id']));
        break;
    default:
        die;
}
die;
