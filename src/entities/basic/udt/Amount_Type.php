<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\udt;

/**
 * Class representing AmountType
 *
 * XSD Type: AmountType
 */
class Amount_Type
{
    /**
     * @var float $__value
     */
    private $__value;
    /**
     * @var string $currencyID
     */
    private $currency_id;
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
     * Gets as currencyID
     *
     * @return string
     */
    public function get_currency_id()
    {
        return $this->currency_id;
    }
    /**
     * Sets a new currencyID
     *
     * @param  string $currencyID
     */
    public function set_currency_id($currency_id): self
    {
        $this->currency_id = $currency_id;
        return $this;
    }
}