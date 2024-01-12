<?php

interface IBaseModel
{
    /**
     * Render the page.
     * @return string Rendered page as a string.
     */
    public function render(): string;

    /**
     * Returns model specific head contents. For example additional style links.
     * @return string Rendered tags int oa string
     */
    public function getModelSpecificHeadContent(): string;
}
