<?php
/** @var ProductsModel $model */
global $model;

$products = $model->getProducts();
// todo: Product page
// todo: Shopping basket
// todo: Checkout
//       - Checkout page
?>

<main>
    <h1>Products</h1>
    <div class="card card-body mt-4 mb-3">
        <a
          href="#filters-collapse"
          data-bs-toggle="collapse"
          role="button"
          aria-expanded="true"
          aria-controls="filters-collapse"
        >
            <h5>Filters</h5>
        </a>
        <div class="collapse show mt-2" id="filters-collapse">
            <form method="get">
                <input type="hidden" name="p" value="products">
                <div class="form-floating mb-2">
                    <select class="form-select" name="category" id="category" onchange="this.form.submit()">
                        <option value="0">Everything</option>
                        <?php foreach ($model->getCategories() as $category): ?>
                            <option
                              value="<?= $category['id'] ?>"
                                <?php if ($model->getSelectedCategory() == $category['id']) echo 'selected' ?>
                            >
                                <?= $category['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="category">Category</label>
                </div>
                <a href="?p=products" class="btn btn-secondary">Clear filters</a>
            </form>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($products as $product):
            $price = number_format($product['price'], 2, '.', ' ');
            ?>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['title']; ?></h5>
                        <p class="card-text"><?= $product['short_text']; ?></p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="fw-semibold"><?= $price; ?>&euro;</span>
                                <span class="text-secondary d-inline-block">/<?= $product['unit']; ?></span>
                            </div>
                            <div class="d-flex">
                                <a
                                  class="btn btn-primary z-2"
                                  href="javascript:addToBasket(<?= $product['id']; ?>)"
                                >
                                    Add to basket
                                </a>
                                <a
                                  class="btn btn-secondary stretched-link ms-2"
                                  href="?p=product&id=<?= $product['id']; ?>"
                                >
                                    View product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
