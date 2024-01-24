<?php
include_once "BaseModel.php";

class ProductsModel extends BaseModel
{
    private array $products;

    private array $categories;

    private int $selectedCategory;


    /**
     * @param string $title Title for the page
     * @param array $products Products to be listed on the page
     */
    public function __construct(string $title, array $products, array $categories, int $selectedCategory)
    {
        $path = 'view/Products.php';
        parent::__construct($title, $path);

        $this->products = $products;
        $this->categories = $categories;
        $this->selectedCategory = $selectedCategory;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getSelectedCategory(): int
    {
        return $this->selectedCategory;
    }


}
