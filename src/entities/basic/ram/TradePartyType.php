<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing TradePartyType
 *
 * XSD Type: TradePartyType
 */
class Trade_Party_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType[] $iD
     */
    private $i_d = [];
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType[] $globalID
     */
    private $global_id = [];
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\LegalOrganizationType $specifiedLegalOrganization
     */
    private $specified_legal_organization;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradeAddressType $postalTradeAddress
     */
    private $postal_trade_address;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\UniversalCommunicationType $uRIUniversalCommunication
     */
    private $u_ri_universal_communication;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TaxRegistrationType[] $specifiedTaxRegistration
     */
    private $specified_tax_registration = [];
    /**
     * Adds as iD
     */
    public function add_to_id(\horstoeko\zugferd\entities\basic\udt\Id_Type $i_d): self
    {
        $this->i_d[] = $i_d;
        return $this;
    }
    /**
     * isset iD
     *
     * @param  int|string $index
     */
    public function isset_id($index): bool
    {
        return isset($this->i_d[$index]);
    }
    /**
     * unset iD
     *
     * @param  int|string $index
     */
    public function unset_id($index): void
    {
        unset($this->i_d[$index]);
    }
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType[]
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\IDType[] $iD
     */
    public function set_id(?array $i_d = null): self
    {
        $this->i_d = $i_d;
        return $this;
    }
    /**
     * Adds as globalID
     */
    public function add_to_global_id(\horstoeko\zugferd\entities\basic\udt\Id_Type $global_id): self
    {
        $this->global_id[] = $global_id;
        return $this;
    }
    /**
     * isset globalID
     *
     * @param  int|string $index
     */
    public function isset_global_id($index): bool
    {
        return isset($this->global_id[$index]);
    }
    /**
     * unset globalID
     *
     * @param  int|string $index
     */
    public function unset_global_id($index): void
    {
        unset($this->global_id[$index]);
    }
    /**
     * Gets as globalID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType[]
     */
    public function get_global_id()
    {
        return $this->global_id;
    }
    /**
     * Sets a new globalID
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\IDType[] $globalID
     */
    public function set_global_id(?array $global_id = null): self
    {
        $this->global_id = $global_id;
        return $this;
    }
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
     * @return \horstoeko\zugferd\entities\basic\ram\LegalOrganizationType
     */
    public function get_specified_legal_organization()
    {
        return $this->specified_legal_organization;
    }
    /**
     * Sets a new specifiedLegalOrganization
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\LegalOrganizationType $specifiedLegalOrganization
     */
    public function set_specified_legal_organization(?\horstoeko\zugferd\entities\basic\ram\Legal_Organization_Type $specified_legal_organization = null): self
    {
        $this->specified_legal_organization = $specified_legal_organization;
        return $this;
    }
    /**
     * Gets as postalTradeAddress
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradeAddressType
     */
    public function get_postal_trade_address()
    {
        return $this->postal_trade_address;
    }
    /**
     * Sets a new postalTradeAddress
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\TradeAddressType $postalTradeAddress
     */
    public function set_postal_trade_address(?\horstoeko\zugferd\entities\basic\ram\Trade_Address_Type $postal_trade_address = null): self
    {
        $this->postal_trade_address = $postal_trade_address;
        return $this;
    }
    /**
     * Gets as uRIUniversalCommunication
     *
     * @return \horstoeko\zugferd\entities\basic\ram\UniversalCommunicationType
     */
    public function get_uri_universal_communication()
    {
        return $this->u_ri_universal_communication;
    }
    /**
     * Sets a new uRIUniversalCommunication
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\UniversalCommunicationType $uRIUniversalCommunication
     */
    public function set_uri_universal_communication(?\horstoeko\zugferd\entities\basic\ram\Universal_Communication_Type $u_ri_universal_communication = null): self
    {
        $this->u_ri_universal_communication = $u_ri_universal_communication;
        return $this;
    }
    /**
     * Adds as specifiedTaxRegistration
     */
    public function add_to_specified_tax_registration(\horstoeko\zugferd\entities\basic\ram\Tax_Registration_Type $specified_tax_registration): self
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
     * @return \horstoeko\zugferd\entities\basic\ram\TaxRegistrationType[]
     */
    public function get_specified_tax_registration()
    {
        return $this->specified_tax_registration;
    }
    /**
     * Sets a new specifiedTaxRegistration
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\TaxRegistrationType[] $specifiedTaxRegistration
     */
    public function set_specified_tax_registration(?array $specified_tax_registration = null): self
    {
        $this->specified_tax_registration = $specified_tax_registration;
        return $this;
    }
}