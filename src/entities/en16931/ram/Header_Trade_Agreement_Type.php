<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing HeaderTradeAgreementType
 *
 * XSD Type: HeaderTradeAgreementType
 */
class Header_Trade_Agreement_Type
{
    /**
     * @var string $buyerReference
     */
    private $buyer_reference;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePartyType $sellerTradeParty
     */
    private $seller_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePartyType $buyerTradeParty
     */
    private $buyer_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePartyType $sellerTaxRepresentativeTradeParty
     */
    private $seller_tax_representative_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $sellerOrderReferencedDocument
     */
    private $seller_order_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyer_order_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $contractReferencedDocument
     */
    private $contract_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[] $additionalReferencedDocument
     */
    private $additional_referenced_document = [];
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ProcuringProjectType $specifiedProcuringProject
     */
    private $specified_procuring_project;
    /**
     * Gets as buyerReference
     *
     * @return string
     */
    public function get_buyer_reference()
    {
        return $this->buyer_reference;
    }
    /**
     * Sets a new buyerReference
     *
     * @param  string $buyerReference
     */
    public function set_buyer_reference($buyer_reference): self
    {
        $this->buyer_reference = $buyer_reference;
        return $this;
    }
    /**
     * Gets as sellerTradeParty
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePartyType
     */
    public function get_seller_trade_party()
    {
        return $this->seller_trade_party;
    }
    /**
     * Sets a new sellerTradeParty
     */
    public function set_seller_trade_party(\horstoeko\zugferd\entities\en16931\ram\Trade_Party_Type $seller_trade_party): self
    {
        $this->seller_trade_party = $seller_trade_party;
        return $this;
    }
    /**
     * Gets as buyerTradeParty
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePartyType
     */
    public function get_buyer_trade_party()
    {
        return $this->buyer_trade_party;
    }
    /**
     * Sets a new buyerTradeParty
     */
    public function set_buyer_trade_party(\horstoeko\zugferd\entities\en16931\ram\Trade_Party_Type $buyer_trade_party): self
    {
        $this->buyer_trade_party = $buyer_trade_party;
        return $this;
    }
    /**
     * Gets as sellerTaxRepresentativeTradeParty
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePartyType
     */
    public function get_seller_tax_representative_trade_party()
    {
        return $this->seller_tax_representative_trade_party;
    }
    /**
     * Sets a new sellerTaxRepresentativeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradePartyType $sellerTaxRepresentativeTradeParty
     */
    public function set_seller_tax_representative_trade_party(?\horstoeko\zugferd\entities\en16931\ram\Trade_Party_Type $seller_tax_representative_trade_party = null): self
    {
        $this->seller_tax_representative_trade_party = $seller_tax_representative_trade_party;
        return $this;
    }
    /**
     * Gets as sellerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function get_seller_order_referenced_document()
    {
        return $this->seller_order_referenced_document;
    }
    /**
     * Sets a new sellerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $sellerOrderReferencedDocument
     */
    public function set_seller_order_referenced_document(?\horstoeko\zugferd\entities\en16931\ram\Referenced_Document_Type $seller_order_referenced_document = null): self
    {
        $this->seller_order_referenced_document = $seller_order_referenced_document;
        return $this;
    }
    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function get_buyer_order_referenced_document()
    {
        return $this->buyer_order_referenced_document;
    }
    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    public function set_buyer_order_referenced_document(?\horstoeko\zugferd\entities\en16931\ram\Referenced_Document_Type $buyer_order_referenced_document = null): self
    {
        $this->buyer_order_referenced_document = $buyer_order_referenced_document;
        return $this;
    }
    /**
     * Gets as contractReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function get_contract_referenced_document()
    {
        return $this->contract_referenced_document;
    }
    /**
     * Sets a new contractReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $contractReferencedDocument
     */
    public function set_contract_referenced_document(?\horstoeko\zugferd\entities\en16931\ram\Referenced_Document_Type $contract_referenced_document = null): self
    {
        $this->contract_referenced_document = $contract_referenced_document;
        return $this;
    }
    /**
     * Adds as additionalReferencedDocument
     */
    public function add_to_additional_referenced_document(\horstoeko\zugferd\entities\en16931\ram\Referenced_Document_Type $additional_referenced_document): self
    {
        $this->additional_referenced_document[] = $additional_referenced_document;
        return $this;
    }
    /**
     * isset additionalReferencedDocument
     *
     * @param  int|string $index
     */
    public function isset_additional_referenced_document($index): bool
    {
        return isset($this->additional_referenced_document[$index]);
    }
    /**
     * unset additionalReferencedDocument
     *
     * @param  int|string $index
     */
    public function unset_additional_referenced_document($index): void
    {
        unset($this->additional_referenced_document[$index]);
    }
    /**
     * Gets as additionalReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[]
     */
    public function get_additional_referenced_document()
    {
        return $this->additional_referenced_document;
    }
    /**
     * Sets a new additionalReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[] $additionalReferencedDocument
     */
    public function set_additional_referenced_document(?array $additional_referenced_document = null): self
    {
        $this->additional_referenced_document = $additional_referenced_document;
        return $this;
    }
    /**
     * Gets as specifiedProcuringProject
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ProcuringProjectType
     */
    public function get_specified_procuring_project()
    {
        return $this->specified_procuring_project;
    }
    /**
     * Sets a new specifiedProcuringProject
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ProcuringProjectType $specifiedProcuringProject
     */
    public function set_specified_procuring_project(?\horstoeko\zugferd\entities\en16931\ram\Procuring_Project_Type $specified_procuring_project = null): self
    {
        $this->specified_procuring_project = $specified_procuring_project;
        return $this;
    }
}