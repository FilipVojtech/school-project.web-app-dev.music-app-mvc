<?php

class ProductModel extends BaseModel
{
    private string $productTitle;
    private float $price;
    private string $unit;
    private int $stock;
    private string $category;
    private int $categoryId;
    private string $description;

    /**
     * @param string $title Title for the page
     * @param string $productTitle
     * @param float $price
     * @param string $unit
     * @param string $category
     * @param int $categoryId
     * @param string $description
     */
    public function __construct(string $title, string $productTitle, float $price, string $unit, int $stock, string $category, int $categoryId, string $description)
    {
        $path = 'view/Product.php';
        parent::__construct($title, $path);

        $this->productTitle = $productTitle;
        $this->price = $price;
        $this->unit = $unit;
        $this->stock = $stock;
        $this->category = $category;
        $this->categoryId = $categoryId;
        $this->description = $description;
    }

    public function getProductTitle(): string
    {
        return $this->productTitle;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
