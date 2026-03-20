<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basicwl\ram;

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
     * @var \horstoeko\zugferd\entities\basicwl\ram\TradePartyType $sellerTradeParty
     */
    private $seller_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\TradePartyType $buyerTradeParty
     */
    private $buyer_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\TradePartyType $sellerTaxRepresentativeTradeParty
     */
    private $seller_tax_representative_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyer_order_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\ReferencedDocumentType $contractReferencedDocument
     */
    private $contract_referenced_document;
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
     * @return \horstoeko\zugferd\entities\basicwl\ram\TradePartyType
     */
    public function get_seller_trade_party()
    {
        return $this->seller_trade_party;
    }
    /**
     * Sets a new sellerTradeParty
     */
    public function set_seller_trade_party(\horstoeko\zugferd\entities\basicwl\ram\Trade_Party_Type $seller_trade_party): self
    {
        $this->seller_trade_party = $seller_trade_party;
        return $this;
    }
    /**
     * Gets as buyerTradeParty
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\TradePartyType
     */
    public function get_buyer_trade_party()
    {
        return $this->buyer_trade_party;
    }
    /**
     * Sets a new buyerTradeParty
     */
    public function set_buyer_trade_party(\horstoeko\zugferd\entities\basicwl\ram\Trade_Party_Type $buyer_trade_party): self
    {
        $this->buyer_trade_party = $buyer_trade_party;
        return $this;
    }
    /**
     * Gets as sellerTaxRepresentativeTradeParty
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\TradePartyType
     */
    public function get_seller_tax_representative_trade_party()
    {
        return $this->seller_tax_representative_trade_party;
    }
    /**
     * Sets a new sellerTaxRepresentativeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\basicwl\ram\TradePartyType $sellerTaxRepresentativeTradeParty
     */
    public function set_seller_tax_representative_trade_party(?\horstoeko\zugferd\entities\basicwl\ram\Trade_Party_Type $seller_tax_representative_trade_party = null): self
    {
        $this->seller_tax_representative_trade_party = $seller_tax_representative_trade_party;
        return $this;
    }
    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\ReferencedDocumentType
     */
    public function get_buyer_order_referenced_document()
    {
        return $this->buyer_order_referenced_document;
    }
    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\basicwl\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    public function set_buyer_order_referenced_document(?\horstoeko\zugferd\entities\basicwl\ram\Referenced_Document_Type $buyer_order_referenced_document = null): self
    {
        $this->buyer_order_referenced_document = $buyer_order_referenced_document;
        return $this;
    }
    /**
     * Gets as contractReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\ReferencedDocumentType
     */
    public function get_contract_referenced_document()
    {
        return $this->contract_referenced_document;
    }
    /**
     * Sets a new contractReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\basicwl\ram\ReferencedDocumentType $contractReferencedDocument
     */
    public function set_contract_referenced_document(?\horstoeko\zugferd\entities\basicwl\ram\Referenced_Document_Type $contract_referenced_document = null): self
    {
        $this->contract_referenced_document = $contract_referenced_document;
        return $this;
    }
}