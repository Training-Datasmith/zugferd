<?php

namespace horstoeko\zugferd\entities\basicwl\udt;

/**
 * Class representing AmountType
 *
 * XSD Type: AmountType
 */
class AmountType
{

    /**
     * @var float $__value
     */
    private $__value;

    /**
     * @var string $currencyID
     */
    private $currencyID;

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
    public function getCurrencyID()
    {
        return $this->currencyID;
    }

    /**
     * Sets a new currencyID
     *
     * @param  string $currencyID
     */
    public function setCurrencyID($currencyID): self
    {
        $this->currencyID = $currencyID;
        return $this;
    }
}
