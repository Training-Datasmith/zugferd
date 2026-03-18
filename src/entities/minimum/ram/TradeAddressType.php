<?php

namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing TradeAddressType
 *
 * XSD Type: TradeAddressType
 */
class TradeAddressType
{

    /**
     * @var string $countryID
     */
    private $countryID;

    /**
     * Gets as countryID
     *
     * @return string
     */
    public function getCountryID()
    {
        return $this->countryID;
    }

    /**
     * Sets a new countryID
     *
     * @param  string $countryID
     */
    public function setCountryID($countryID): self
    {
        $this->countryID = $countryID;
        return $this;
    }
}
