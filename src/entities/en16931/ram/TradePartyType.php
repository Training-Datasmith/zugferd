<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradePartyType
 *
 * XSD Type: TradePartyType
 */
class TradePartyType
{

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType[] $iD
     */
    private $iD = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType[] $globalID
     */
    private $globalID = [
        
    ];

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\LegalOrganizationType $specifiedLegalOrganization
     */
    private $specifiedLegalOrganization;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeContactType $definedTradeContact
     */
    private $definedTradeContact;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeAddressType $postalTradeAddress
     */
    private $postalTradeAddress;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $uRIUniversalCommunication
     */
    private $uRIUniversalCommunication;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TaxRegistrationType[] $specifiedTaxRegistration
     */
    private $specifiedTaxRegistration = [
        
    ];

    /**
     * Adds as iD
     */
    public function addToID(\horstoeko\zugferd\entities\en16931\udt\IDType $iD): self
    {
        $this->iD[] = $iD;
        return $this;
    }

    /**
     * isset iD
     *
     * @param  int|string $index
     */
    public function issetID($index): bool
    {
        return isset($this->iD[$index]);
    }

    /**
     * unset iD
     *
     * @param  int|string $index
     */
    public function unsetID($index): void
    {
        unset($this->iD[$index]);
    }

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType[]
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType[] $iD
     */
    public function setID(?array $iD = null): self
    {
        $this->iD = $iD;
        return $this;
    }

    /**
     * Adds as globalID
     */
    public function addToGlobalID(\horstoeko\zugferd\entities\en16931\udt\IDType $globalID): self
    {
        $this->globalID[] = $globalID;
        return $this;
    }

    /**
     * isset globalID
     *
     * @param  int|string $index
     */
    public function issetGlobalID($index): bool
    {
        return isset($this->globalID[$index]);
    }

    /**
     * unset globalID
     *
     * @param  int|string $index
     */
    public function unsetGlobalID($index): void
    {
        unset($this->globalID[$index]);
    }

    /**
     * Gets as globalID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType[]
     */
    public function getGlobalID()
    {
        return $this->globalID;
    }

    /**
     * Sets a new globalID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType[] $globalID
     */
    public function setGlobalID(?array $globalID = null): self
    {
        $this->globalID = $globalID;
        return $this;
    }

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
     * Gets as description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets as specifiedLegalOrganization
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\LegalOrganizationType
     */
    public function getSpecifiedLegalOrganization()
    {
        return $this->specifiedLegalOrganization;
    }

    /**
     * Sets a new specifiedLegalOrganization
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\LegalOrganizationType $specifiedLegalOrganization
     */
    public function setSpecifiedLegalOrganization(?\horstoeko\zugferd\entities\en16931\ram\LegalOrganizationType $specifiedLegalOrganization = null): self
    {
        $this->specifiedLegalOrganization = $specifiedLegalOrganization;
        return $this;
    }

    /**
     * Gets as definedTradeContact
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeContactType
     */
    public function getDefinedTradeContact()
    {
        return $this->definedTradeContact;
    }

    /**
     * Sets a new definedTradeContact
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeContactType $definedTradeContact
     */
    public function setDefinedTradeContact(?\horstoeko\zugferd\entities\en16931\ram\TradeContactType $definedTradeContact = null): self
    {
        $this->definedTradeContact = $definedTradeContact;
        return $this;
    }

    /**
     * Gets as postalTradeAddress
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeAddressType
     */
    public function getPostalTradeAddress()
    {
        return $this->postalTradeAddress;
    }

    /**
     * Sets a new postalTradeAddress
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeAddressType $postalTradeAddress
     */
    public function setPostalTradeAddress(?\horstoeko\zugferd\entities\en16931\ram\TradeAddressType $postalTradeAddress = null): self
    {
        $this->postalTradeAddress = $postalTradeAddress;
        return $this;
    }

    /**
     * Gets as uRIUniversalCommunication
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType
     */
    public function getURIUniversalCommunication()
    {
        return $this->uRIUniversalCommunication;
    }

    /**
     * Sets a new uRIUniversalCommunication
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $uRIUniversalCommunication
     */
    public function setURIUniversalCommunication(?\horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $uRIUniversalCommunication = null): self
    {
        $this->uRIUniversalCommunication = $uRIUniversalCommunication;
        return $this;
    }

    /**
     * Adds as specifiedTaxRegistration
     */
    public function addToSpecifiedTaxRegistration(\horstoeko\zugferd\entities\en16931\ram\TaxRegistrationType $specifiedTaxRegistration): self
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
     * @return \horstoeko\zugferd\entities\en16931\ram\TaxRegistrationType[]
     */
    public function getSpecifiedTaxRegistration()
    {
        return $this->specifiedTaxRegistration;
    }

    /**
     * Sets a new specifiedTaxRegistration
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TaxRegistrationType[] $specifiedTaxRegistration
     */
    public function setSpecifiedTaxRegistration(?array $specifiedTaxRegistration = null): self
    {
        $this->specifiedTaxRegistration = $specifiedTaxRegistration;
        return $this;
    }
}
