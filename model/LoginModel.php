<?php

class LoginModel extends BaseModel
{
    public function __construct(string $title)
    {
        $path = 'view/Login.php';
        parent::__construct($title, $path);
    }
}
