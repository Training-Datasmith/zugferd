<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing HeaderTradeAgreementType
 *
 * XSD Type: HeaderTradeAgreementType
 */
class HeaderTradeAgreementType
{
    /**
     * @var string $buyerReference
     */
    private $buyerReference;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradePartyType $sellerTradeParty
     */
    private $sellerTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradePartyType $buyerTradeParty
     */
    private $buyerTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradePartyType $sellerTaxRepresentativeTradeParty
     */
    private $sellerTaxRepresentativeTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyerOrderReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType $contractReferencedDocument
     */
    private $contractReferencedDocument;

    /**
     * Gets as buyerReference
     *
     * @return string
     */
    public function getBuyerReference()
    {
        return $this->buyerReference;
    }

    /**
     * Sets a new buyerReference
     *
     * @param  string $buyerReference
     */
    public function setBuyerReference($buyerReference): self
    {
        $this->buyerReference = $buyerReference;
        return $this;
    }

    /**
     * Gets as sellerTradeParty
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradePartyType
     */
    public function getSellerTradeParty()
    {
        return $this->sellerTradeParty;
    }

    /**
     * Sets a new sellerTradeParty
     */
    public function setSellerTradeParty(\horstoeko\zugferd\entities\basic\ram\TradePartyType $sellerTradeParty): self
    {
        $this->sellerTradeParty = $sellerTradeParty;
        return $this;
    }

    /**
     * Gets as buyerTradeParty
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradePartyType
     */
    public function getBuyerTradeParty()
    {
        return $this->buyerTradeParty;
    }

    /**
     * Sets a new buyerTradeParty
     */
    public function setBuyerTradeParty(\horstoeko\zugferd\entities\basic\ram\TradePartyType $buyerTradeParty): self
    {
        $this->buyerTradeParty = $buyerTradeParty;
        return $this;
    }

    /**
     * Gets as sellerTaxRepresentativeTradeParty
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradePartyType
     */
    public function getSellerTaxRepresentativeTradeParty()
    {
        return $this->sellerTaxRepresentativeTradeParty;
    }

    /**
     * Sets a new sellerTaxRepresentativeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\TradePartyType $sellerTaxRepresentativeTradeParty
     */
    public function setSellerTaxRepresentativeTradeParty(?\horstoeko\zugferd\entities\basic\ram\TradePartyType $sellerTaxRepresentativeTradeParty = null): self
    {
        $this->sellerTaxRepresentativeTradeParty = $sellerTaxRepresentativeTradeParty;
        return $this;
    }

    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType
     */
    public function getBuyerOrderReferencedDocument()
    {
        return $this->buyerOrderReferencedDocument;
    }

    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    public function setBuyerOrderReferencedDocument(?\horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType $buyerOrderReferencedDocument = null): self
    {
        $this->buyerOrderReferencedDocument = $buyerOrderReferencedDocument;
        return $this;
    }

    /**
     * Gets as contractReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType
     */
    public function getContractReferencedDocument()
    {
        return $this->contractReferencedDocument;
    }

    /**
     * Sets a new contractReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType $contractReferencedDocument
     */
    public function setContractReferencedDocument(?\horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType $contractReferencedDocument = null): self
    {
        $this->contractReferencedDocument = $contractReferencedDocument;
        return $this;
    }
}
