<?php
?>

<div class="nav-item dropdown mx-4">
    <a
      class="nav-link dropdown-toggle text-center"
      href="#"
      role="button"
      data-bs-toggle="dropdown"
      aria-expanded="false"
    >
        <?= $_SESSION['user']['first_name'] ?>
    </a>
    <div class="dropdown-menu mb-3 mt-0">
        <a class="dropdown-item" href="">Orders</a>
        <hr class="dropdown-divider">
        <a class="dropdown-item" href="controller/account.php?action=logout">Logout</a>
    </div>
</div>

<style>
    .dropdown:hover .dropdown-menu {
        display: block;
        /* remove the gap so it doesn't close */
        margin-top: 0;
    }
</style>
