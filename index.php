<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'includes.php';

if (PHP_SESSION_ACTIVE != session_status()) {
    session_start();
}

$action = $_GET['p'] ?? '';
//$action = 'register';

$uiMessage = '';
if (!empty($_SESSION['ui-message'])) {
    $uiMessage = $_SESSION['ui-message'];
    $_SESSION['ui-message'] = '';
}

$isLoggedIn = isset($_SESSION['user']);

$db = new Database();

$model = null;
switch ($action) {
    case '':
    default:
        if ($isLoggedIn) {
            header('Location: ?p=products');
            die;
        }
        $model = new HomeModel("Clef");
        break;
    case 'products':
        if (!$isLoggedIn) {
            header('Location: ?');
            die;
        }
        $category = 0;
        if (isset($_GET['category'])) {
            $category = $_GET['category'];
        }

        $model = new ProductsModel("Products", $db->getProducts($category), $db->getCategories(), $category);
        break;
    case 'product':
        $productId = null;
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
        }
        $product = $db->getProduct($productId);

        if (!$product) {
            header('Location: ?p=notFound');
            die;
        }

        $model = new ProductModel(
            $product['title'],
            $product['title'],
            $product['price'],
            $product['unit'],
            $product['stock'],
            $product['category'],
            $product['category_id'],
            $product['product_detail']
        );
        break;
    case 'basket':
        if (!$isLoggedIn) {
            header('Location: ?');
            die;
        }
        $model = new BasketModel('Shopping basket');
        break;
    case 'login':
        $model = new LoginModel('Login');
        $model->headContent[] = new \HTML\HeadTag('script', '', ['src' => 'javascript/formKeeper.js', 'defer' => '']);
        break;
    case 'register':
        $model = new RegisterModel('Register');
        $model->headContent[] = new \HTML\HeadTag('script', '', ['src' => 'javascript/formKeeper.js', 'defer' => '']);
        break;
    case 'notFound':
        $model = new NotFoundModel("Page not found");
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
    <link
      rel="icon"
      href="images/favicon/clef-light.png"
      type="image/png"
      media="(prefers-color-scheme: light)"
    >
    <link
      rel="icon"
      href="images/favicon/clef-dark.png"
      type="image/png"
      media="(prefers-color-scheme: dark)"
    >
    <script src="javascript/ShoppingBasket.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <title><?= $model->title ?></title>
    <?= $model->getModelSpecificHeadContent(); ?>
</head>
<body>
<!--<div style="outline: 1px solid red; position: absolute; height: 100vh; left: 50%; transform: translateX(-50%); z-index: 100000"></div>-->
<!--<editor-fold desc="Basket modal">-->
<div
  class="modal fade"
  id="basketModal"
  tabindex="-1"
  aria-labelledby="basketLabel"
  aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="basketLabel">Basket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="basketItemsPlaceholder" class="list-group list-group-flush"></ul>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-primary">Reserve items</a>
            </div>
        </div>
    </div>
</div>
<!--</editor-fold>-->
<?php include 'view_partial/Header.php'; ?>
<main class="col-12 col-xl-6 col-lg-8 col-md-10 mx-auto">
    <?php if ($uiMessage): ?>
        <div class="alert alert-info" role="alert">
            <?= $uiMessage; ?>
        </div>
    <?php endif; ?>
    <?= $model; ?>
</main>
<?php include 'view_partial/Footer.php'; ?>
</body>
</html>
