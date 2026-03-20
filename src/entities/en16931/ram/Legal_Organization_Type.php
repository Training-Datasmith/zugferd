<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing LegalOrganizationType
 *
 * XSD Type: LegalOrganizationType
 */
class Legal_Organization_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $iD
     */
    private $i_d;
    /**
     * @var string $tradingBusinessName
     */
    private $trading_business_name;
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $iD
     */
    public function set_id(?\horstoeko\zugferd\entities\en16931\udt\Id_Type $i_d = null): self
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
}