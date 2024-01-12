<?php
include_once "BaseModel.php";

class NotFoundModel extends BaseModel
{
    private string $something;

    public function __construct(string $title, string $something)
    {
        $path = 'view/NotFound.php';

        parent::__construct($title, $path);
        $this->something = $something;
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        global $args;
        $args = ['something' => $this->something];
        ob_start();
        include($this->path);
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }
}
