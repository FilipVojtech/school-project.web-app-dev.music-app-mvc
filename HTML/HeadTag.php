<?php

namespace HTML;
class HeadTag implements \Stringable
{
    private string $name;

    /** @var array<string, string> */
    private array $attributes;

    private string $content;

    /**
     * @param string $name
     * @param array<string, string> $attributes
     */
    public function __construct(string $name, string $content = "", array $attributes = [])
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->content = $content;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $value = "<$this->name ";
        foreach ($this->attributes as $key => $val) {
            $value .= "$key=\"$val\" ";
        }

        $value .= ">";

        if (!empty($this->content)) {
            $value .= $this->content;
            $value .= "</$this->name>";
        }

        $value .= "</$this->name>";

        return $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * Adds or replaces a value for a specified attribute
     * @param string $name Attribute name
     * @param string $value Attribute value
     * @return void
     */
    public function addAttribute(string $name, string $value = ""): void
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Remove an attribute if it exists
     * @param string $name Name of the attribute
     * @return void
     */
    public function removeAttribute(string $name): void
    {
        if (isset($this->attributes[$name])) {
            unset($this->attributes[$name]);
        }
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
