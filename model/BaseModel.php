<?php

include_once 'IBaseModel.php';

use HTML\HeadTag;

abstract class BaseModel implements IBaseModel, Stringable
{
    public string $title;
    /** @var HeadTag[] */
    public array $headContent;
    public string $path;

    /**
     * @param string $title
     * @param string $path
     */
    public function __construct(string $title, string $path)
    {
        $this->title = $title;
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        ob_start();
        include($this->path);
        $result = ob_get_contents();
        ob_end_clean();

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getModelSpecificHeadContent(): string
    {
        $value = "";
        foreach ($this->headContent ?? [] as $item) {
            $value .= "    $item\n";
        }
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->render();
    }


}
