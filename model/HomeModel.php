<?php
include_once "BaseModel.php";

class HomeModel extends BaseModel
{
    public function __construct(string $title)
    {
        $path = 'view/Home.php';
        parent::__construct($title, $path);
    }

//    /**
//     * @inheritDoc
//     */
//    public function render(): string
//    {
//        ob_start();
//        include($this->path);
//        $result = ob_get_contents();
//        ob_end_clean();
//
//        return $result;
//    }
}
