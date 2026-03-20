<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeCountryType
 *
 * XSD Type: TradeCountryType
 */
class Trade_Country_Type
{
    /**
     * @var string $iD
     */
    private $i_d;
    /**
     * Gets as iD
     *
     * @return string
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     *
     * @param  string $iD
     */
    public function set_id($i_d): self
    {
        $this->i_d = $i_d;
        return $this;
    }
}