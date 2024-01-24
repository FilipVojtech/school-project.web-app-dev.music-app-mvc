<?php
/** @type ProductModel $model */
global $model;

$price = number_format($model->getPrice(), 2, '.', ' ');
?>

<h1 class="text-center"><?= $model->getProductTitle() ?></h1>
<div>
    <span class="fw-semibold"><?= $price; ?>&euro;</span>
    <span class="text-secondary d-inline-block">/<?= $model->getUnit(); ?></span>
</div>
<hr>
<div><?= $model->getDescription() ?></div>
