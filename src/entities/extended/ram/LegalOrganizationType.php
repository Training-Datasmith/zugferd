<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LegalOrganizationType
 *
 * XSD Type: LegalOrganizationType
 */
class LegalOrganizationType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $iD;

    /**
     * @var string $tradingBusinessName
     */
    private $tradingBusinessName;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeAddressType $postalTradeAddress
     */
    private $postalTradeAddress;

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    public function setID(?\horstoeko\zugferd\entities\extended\udt\IDType $iD = null): self
    {
        $this->iD = $iD;
        return $this;
    }

    /**
     * Gets as tradingBusinessName
     *
     * @return string
     */
    public function getTradingBusinessName()
    {
        return $this->tradingBusinessName;
    }

    /**
     * Sets a new tradingBusinessName
     *
     * @param  string $tradingBusinessName
     */
    public function setTradingBusinessName($tradingBusinessName): self
    {
        $this->tradingBusinessName = $tradingBusinessName;
        return $this;
    }

    /**
     * Gets as postalTradeAddress
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeAddressType
     */
    public function getPostalTradeAddress()
    {
        return $this->postalTradeAddress;
    }

    /**
     * Sets a new postalTradeAddress
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeAddressType $postalTradeAddress
     */
    public function setPostalTradeAddress(?\horstoeko\zugferd\entities\extended\ram\TradeAddressType $postalTradeAddress = null): self
    {
        $this->postalTradeAddress = $postalTradeAddress;
        return $this;
    }
}
