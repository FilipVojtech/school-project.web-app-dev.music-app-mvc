<?php
global $action;

$loggedOutItems = [
    ['type' => 'empty', 'width' => 25],
    ['type' => 'link', 'href' => '?', 'title' => 'Home'],
    ['type' => 'empty', 'width' => 25],
    ['type' => 'logo', 'href' => '?', 'source' => '../images/logo/logo.png'],
    ['type' => 'link', 'href' => '?p=login', 'title' => 'Login'],
    ['type' => 'link', 'href' => '?p=register', 'title' => 'Register'],
];

$loggedInItems = [
    ['type' => 'empty', 'width' => 10],
    ['type' => 'link', 'href' => '?p=products', 'title' => 'Products'],
    ['type' => 'empty', 'width' => 10],
    ['type' => 'logo', 'href' => '?', 'source' => '../images/logo/logo.png'],
    ['type' => 'component', 'name' => 'userDropdown.php'],
    ['type' => 'component', 'name' => 'basket.php']
];
//    ['type' => 'empty', 'width' => 50],

$navItems = isset($_SESSION['user']) ? $loggedInItems : $loggedOutItems;
//$navItems = $loggedInItems;
?>
<header class="sticky-top py-1 bg-body">
    <div class="container-fluid ">
        <nav class="navbar fs-4 navbar-expand-md">
            <div class="container-fluid ">
                <a href="?" class="navbar-brand mx-5 d-block d-md-none">
                    <img
                      src="../images/logo/logo.png"
                      alt=""
                      class="img-fluid"
                      id="logo"
                    >
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarContent"
                        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarContent" class="collapse navbar-collapse justify-content-center navbar-nav">
                    <?php
                    foreach ($navItems as $item) {
                        switch ($item['type']) {
                            case 'link':
                                ?>
                                <a href="<?= $item['href'] ?>" class="nav-link mx-4">
                                    <?= $item['title'] ?>
                                </a>
                                <?php
                                break;
                            case 'logo':
                                ?>
                                <a href="<?= $item['href'] ?>" class="navbar-brand mx-5 d-none d-md-block">
                                    <img
                                      src="<?= $item['source'] ?>"
                                      alt=""
                                      class="img-fluid"
                                      id="logo"
                                    >
                                </a>
                                <?php
                                break;
                            case 'empty':
                                ?>
                                <div class="nav-item mx-4" style="width: <?= $item['width'] ?>px"></div>
                                <?php
                                break;
                            case 'component':
                                include 'components/' . $item['name'];
                                break;
                            default:
                                continue 2;
                        }
                    }
                    ?>
                </div>
            </div>
        </nav>
    </div>
</header>
