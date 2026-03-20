<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\udt;

/**
 * Class representing MeasureType
 *
 * XSD Type: MeasureType
 */
class Measure_Type
{
    /**
     * @var float $__value
     */
    private $__value;
    /**
     * @var string $unitCode
     */
    private $unit_code;
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
    /**
     * Gets as unitCode
     *
     * @return string
     */
    public function get_unit_code()
    {
        return $this->unit_code;
    }
    /**
     * Sets a new unitCode
     *
     * @param  string $unitCode
     */
    public function set_unit_code($unit_code): self
    {
        $this->unit_code = $unit_code;
        return $this;
    }
}