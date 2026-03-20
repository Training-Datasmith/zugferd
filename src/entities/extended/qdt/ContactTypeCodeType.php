<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\qdt;

/**
 * Class representing ContactTypeCodeType
 *
 * XSD Type: ContactTypeCodeType
 */
class Contact_Type_Code_Type
{
    /**
     * @var string $__value
     */
    private $__value;
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
}