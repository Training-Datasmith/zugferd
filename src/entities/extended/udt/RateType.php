<?php

namespace horstoeko\zugferd\entities\extended\udt;

/**
 * Class representing RateType
 *
 * XSD Type: RateType
 */
class RateType
{

    /**
     * @var float $__value
     */
    private $__value;

    /**
     * Construct
     *
     * @param float $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value
     *
     * @param  float $value
     * @return float
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
