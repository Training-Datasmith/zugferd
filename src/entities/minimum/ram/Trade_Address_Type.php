<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing TradeAddressType
 *
 * XSD Type: TradeAddressType
 */
class Trade_Address_Type
{
    /**
     * @var string $countryID
     */
    private $country_id;
    /**
     * Gets as countryID
     *
     * @return string
     */
    public function get_country_id()
    {
        return $this->country_id;
    }
    /**
     * Sets a new countryID
     *
     * @param  string $countryID
     */
    public function set_country_id($country_id): self
    {
        $this->country_id = $country_id;
        return $this;
    }
}