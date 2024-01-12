<?php
include_once "BaseModel.php";

class ProductsModel extends BaseModel
{

    /**
     * @param string $title
     */
    public function __construct(string $title)
    {
        $path = 'view/Products.php';
        parent::__construct($title, $path);
    }
}
