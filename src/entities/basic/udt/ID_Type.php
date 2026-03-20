<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\udt;

/**
 * Class representing IDType
 *
 * XSD Type: IDType
 */
class Id_Type
{
    /**
     * @var string $__value
     */
    private $__value;
    /**
     * @var string $schemeID
     */
    private $scheme_id;
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
     * Gets as schemeID
     *
     * @return string
     */
    public function get_scheme_id()
    {
        return $this->scheme_id;
    }
    /**
     * Sets a new schemeID
     *
     * @param  string $schemeID
     */
    public function set_scheme_id($scheme_id): self
    {
        $this->scheme_id = $scheme_id;
        return $this;
    }
}