<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LegalOrganizationType
 *
 * XSD Type: LegalOrganizationType
 */
class Legal_Organization_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $i_d;
    /**
     * @var string $tradingBusinessName
     */
    private $trading_business_name;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeAddressType $postalTradeAddress
     */
    private $postal_trade_address;
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    public function set_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $i_d = null): self
    {
        $this->i_d = $i_d;
        return $this;
    }
    /**
     * Gets as tradingBusinessName
     *
     * @return string
     */
    public function get_trading_business_name()
    {
        return $this->trading_business_name;
    }
    /**
     * Sets a new tradingBusinessName
     *
     * @param  string $tradingBusinessName
     */
    public function set_trading_business_name($trading_business_name): self
    {
        $this->trading_business_name = $trading_business_name;
        return $this;
    }
    /**
     * Gets as postalTradeAddress
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeAddressType
     */
    public function get_postal_trade_address()
    {
        return $this->postal_trade_address;
    }
    /**
     * Sets a new postalTradeAddress
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeAddressType $postalTradeAddress
     */
    public function set_postal_trade_address(?\horstoeko\zugferd\entities\extended\ram\Trade_Address_Type $postal_trade_address = null): self
    {
        $this->postal_trade_address = $postal_trade_address;
        return $this;
    }
}