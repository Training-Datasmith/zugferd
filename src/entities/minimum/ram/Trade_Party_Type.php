<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing TradePartyType
 *
 * XSD Type: TradePartyType
 */
class Trade_Party_Type
{
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\LegalOrganizationType $specifiedLegalOrganization
     */
    private $specified_legal_organization;
    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\TradeAddressType $postalTradeAddress
     */
    private $postal_trade_address;
    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\TaxRegistrationType[] $specifiedTaxRegistration
     */
    private $specified_tax_registration = [];
    /**
     * Gets as name
     *
     * @return string
     */
    public function get_name()
    {
        return $this->name;
    }
    /**
     * Sets a new name
     *
     * @param  string $name
     */
    public function set_name($name): self
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Gets as specifiedLegalOrganization
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\LegalOrganizationType
     */
    public function get_specified_legal_organization()
    {
        return $this->specified_legal_organization;
    }
    /**
     * Sets a new specifiedLegalOrganization
     *
     * @param  \horstoeko\zugferd\entities\minimum\ram\LegalOrganizationType $specifiedLegalOrganization
     */
    public function set_specified_legal_organization(?\horstoeko\zugferd\entities\minimum\ram\Legal_Organization_Type $specified_legal_organization = null): self
    {
        $this->specified_legal_organization = $specified_legal_organization;
        return $this;
    }
    /**
     * Gets as postalTradeAddress
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\TradeAddressType
     */
    public function get_postal_trade_address()
    {
        return $this->postal_trade_address;
    }
    /**
     * Sets a new postalTradeAddress
     *
     * @param  \horstoeko\zugferd\entities\minimum\ram\TradeAddressType $postalTradeAddress
     */
    public function set_postal_trade_address(?\horstoeko\zugferd\entities\minimum\ram\Trade_Address_Type $postal_trade_address = null): self
    {
        $this->postal_trade_address = $postal_trade_address;
        return $this;
    }
    /**
     * Adds as specifiedTaxRegistration
     */
    public function add_to_specified_tax_registration(\horstoeko\zugferd\entities\minimum\ram\Tax_Registration_Type $specified_tax_registration): self
    {
        $this->specified_tax_registration[] = $specified_tax_registration;
        return $this;
    }
    /**
     * isset specifiedTaxRegistration
     *
     * @param  int|string $index
     */
    public function isset_specified_tax_registration($index): bool
    {
        return isset($this->specified_tax_registration[$index]);
    }
    /**
     * unset specifiedTaxRegistration
     *
     * @param  int|string $index
     */
    public function unset_specified_tax_registration($index): void
    {
        unset($this->specified_tax_registration[$index]);
    }
    /**
     * Gets as specifiedTaxRegistration
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\TaxRegistrationType[]
     */
    public function get_specified_tax_registration()
    {
        return $this->specified_tax_registration;
    }
    /**
     * Sets a new specifiedTaxRegistration
     *
     * @param  \horstoeko\zugferd\entities\minimum\ram\TaxRegistrationType[] $specifiedTaxRegistration
     */
    public function set_specified_tax_registration(?array $specified_tax_registration = null): self
    {
        $this->specified_tax_registration = $specified_tax_registration;
        return $this;
    }
}