<?php

class RegisterModel extends BaseModel
{
    public function __construct(string $title)
    {
        $path = 'view/Register.php';
        parent::__construct($title, $path);
    }
}
