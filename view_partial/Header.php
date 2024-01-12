<?php
global $action;
$links = [
    ['type' => 'link', 'href' => '?', 'title' => 'Home'],
    ['type' => 'link', 'href' => '?p=products', 'title' => 'Products'],
    ['type' => 'logo', 'href' => '?', 'source' => '../images/logo/logo.png'],
    ['type' => 'link', 'href' => '?p=login', 'title' => 'Login'],
    ['type' => 'link', 'href' => '?p=register', 'title' => 'Register']
];
//    ['type' => 'empty', 'width' => 50],
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
                <div id="navbarContent" class="collapse navbar-collapse justify-content-center">
                    <?php
                    foreach ($links as $item) {
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
                                <div style="width: <?= $item['width'] ?>px"></div>
                                <?php
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
