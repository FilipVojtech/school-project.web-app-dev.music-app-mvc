<?php
?>

<a
  href="?p=basket"
  class="nav-link mx-4 position-relative"
  type="button"
  data-bs-toggle="modal"
  data-bs-target="#basketModal"
>
    Basket
    <span
      id="basketCounter"
      class="badge position-absolute top-0 start-100 translate-middle rounded-pill bg-primary"
    ></span>
</a>

<template id="basketItem">
    <li class="list-group-item">
        <b id="itemTitle"></b>
        <div class="input-group">
            <button class="btn btn-outline-secondary" type="button" id="itemCountDecrease">-</button>
            <input type="text" name="count" id="count" class="form-control" maxlength="3">
            <button class="btn btn-outline-secondary" type="button" id="itemCountIncrease">+</button>
        </div>
    </li>
</template>
