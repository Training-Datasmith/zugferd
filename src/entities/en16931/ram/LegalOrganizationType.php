<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing LegalOrganizationType
 *
 * XSD Type: LegalOrganizationType
 */
class LegalOrganizationType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $iD
     */
    private $iD;

    /**
     * @var string $tradingBusinessName
     */
    private $tradingBusinessName;

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $iD
     */
    public function setID(?\horstoeko\zugferd\entities\en16931\udt\IDType $iD = null): self
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
}
