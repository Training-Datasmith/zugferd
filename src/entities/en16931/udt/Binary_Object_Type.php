<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\udt;

/**
 * Class representing BinaryObjectType
 *
 * XSD Type: BinaryObjectType
 */
class Binary_Object_Type
{
    /**
     * @var string $__value
     */
    private $__value;
    /**
     * @var string $mimeCode
     */
    private $mime_code;
    /**
     * @var string $filename
     */
    private $filename;
    /**
     * Construct
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }
    /**
     * Gets or sets the inner value
     *
     * @param  string $value
     * @return string
     */
    public function value()
    {
        if ($args = func_get_args()) {
            $this->__value = $args[0];
        }
        return $this->__value;
    }
    /**
     * Gets a string value
     */
    public function __toString(): string
    {
        return strval($this->__value);
    }
    /**
     * Gets as mimeCode
     *
     * @return string
     */
    public function get_mime_code()
    {
        return $this->mime_code;
    }
    /**
     * Sets a new mimeCode
     *
     * @param  string $mimeCode
     */
    public function set_mime_code($mime_code): self
    {
        $this->mime_code = $mime_code;
        return $this;
    }
    /**
     * Gets as filename
     *
     * @return string
     */
    public function get_filename()
    {
        return $this->filename;
    }
    /**
     * Sets a new filename
     *
     * @param  string $filename
     */
    public function set_filename($filename): self
    {
        $this->filename = $filename;
        return $this;
    }
}