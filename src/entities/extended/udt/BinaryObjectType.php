<?php

namespace horstoeko\zugferd\entities\extended\udt;

/**
 * Class representing BinaryObjectType
 *
 * XSD Type: BinaryObjectType
 */
class BinaryObjectType
{

    /**
     * @var string $__value
     */
    private $__value;

    /**
     * @var string $mimeCode
     */
    private $mimeCode;

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
    public function getMimeCode()
    {
        return $this->mimeCode;
    }

    /**
     * Sets a new mimeCode
     *
     * @param  string $mimeCode
     */
    public function setMimeCode($mimeCode): self
    {
        $this->mimeCode = $mimeCode;
        return $this;
    }

    /**
     * Gets as filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Sets a new filename
     *
     * @param  string $filename
     */
    public function setFilename($filename): self
    {
        $this->filename = $filename;
        return $this;
    }
}
