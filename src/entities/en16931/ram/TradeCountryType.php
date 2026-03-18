<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeCountryType
 *
 * XSD Type: TradeCountryType
 */
class TradeCountryType
{
    /**
     * @var string $iD
     */
    private $iD;

    /**
     * Gets as iD
     *
     * @return string
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     *
     * @param  string $iD
     */
    public function setID($iD): self
    {
        $this->iD = $iD;
        return $this;
    }
}
