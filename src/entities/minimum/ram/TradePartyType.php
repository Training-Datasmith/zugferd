<?php

namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing TradePartyType
 *
 * XSD Type: TradePartyType
 */
class TradePartyType
{

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\LegalOrganizationType $specifiedLegalOrganization
     */
    private $specifiedLegalOrganization;

    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\TradeAddressType $postalTradeAddress
     */
    private $postalTradeAddress;

    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\TaxRegistrationType[] $specifiedTaxRegistration
     */
    private $specifiedTaxRegistration = [
        
    ];

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as specifiedLegalOrganization
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\LegalOrganizationType
     */
    public function getSpecifiedLegalOrganization()
    {
        return $this->specifiedLegalOrganization;
    }

    /**
     * Sets a new specifiedLegalOrganization
     *
     * @param  \horstoeko\zugferd\entities\minimum\ram\LegalOrganizationType $specifiedLegalOrganization
     */
    public function setSpecifiedLegalOrganization(?\horstoeko\zugferd\entities\minimum\ram\LegalOrganizationType $specifiedLegalOrganization = null): self
    {
        $this->specifiedLegalOrganization = $specifiedLegalOrganization;
        return $this;
    }

    /**
     * Gets as postalTradeAddress
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\TradeAddressType
     */
    public function getPostalTradeAddress()
    {
        return $this->postalTradeAddress;
    }

    /**
     * Sets a new postalTradeAddress
     *
     * @param  \horstoeko\zugferd\entities\minimum\ram\TradeAddressType $postalTradeAddress
     */
    public function setPostalTradeAddress(?\horstoeko\zugferd\entities\minimum\ram\TradeAddressType $postalTradeAddress = null): self
    {
        $this->postalTradeAddress = $postalTradeAddress;
        return $this;
    }

    /**
     * Adds as specifiedTaxRegistration
     */
    public function addToSpecifiedTaxRegistration(\horstoeko\zugferd\entities\minimum\ram\TaxRegistrationType $specifiedTaxRegistration): self
    {
        $this->specifiedTaxRegistration[] = $specifiedTaxRegistration;
        return $this;
    }

    /**
     * isset specifiedTaxRegistration
     *
     * @param  int|string $index
     */
    public function issetSpecifiedTaxRegistration($index): bool
    {
        return isset($this->specifiedTaxRegistration[$index]);
    }

    /**
     * unset specifiedTaxRegistration
     *
     * @param  int|string $index
     */
    public function unsetSpecifiedTaxRegistration($index): void
    {
        unset($this->specifiedTaxRegistration[$index]);
    }

    /**
     * Gets as specifiedTaxRegistration
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\TaxRegistrationType[]
     */
    public function getSpecifiedTaxRegistration()
    {
        return $this->specifiedTaxRegistration;
    }

    /**
     * Sets a new specifiedTaxRegistration
     *
     * @param  \horstoeko\zugferd\entities\minimum\ram\TaxRegistrationType[] $specifiedTaxRegistration
     */
    public function setSpecifiedTaxRegistration(?array $specifiedTaxRegistration = null): self
    {
        $this->specifiedTaxRegistration = $specifiedTaxRegistration;
        return $this;
    }
}
