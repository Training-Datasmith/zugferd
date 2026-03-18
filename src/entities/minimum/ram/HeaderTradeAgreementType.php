<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\minimum\ram;

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
     * @var \horstoeko\zugferd\entities\minimum\ram\TradePartyType $sellerTradeParty
     */
    private $sellerTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\TradePartyType $buyerTradeParty
     */
    private $buyerTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyerOrderReferencedDocument;

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
     * @return \horstoeko\zugferd\entities\minimum\ram\TradePartyType
     */
    public function getSellerTradeParty()
    {
        return $this->sellerTradeParty;
    }

    /**
     * Sets a new sellerTradeParty
     */
    public function setSellerTradeParty(\horstoeko\zugferd\entities\minimum\ram\TradePartyType $sellerTradeParty): self
    {
        $this->sellerTradeParty = $sellerTradeParty;
        return $this;
    }

    /**
     * Gets as buyerTradeParty
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\TradePartyType
     */
    public function getBuyerTradeParty()
    {
        return $this->buyerTradeParty;
    }

    /**
     * Sets a new buyerTradeParty
     */
    public function setBuyerTradeParty(\horstoeko\zugferd\entities\minimum\ram\TradePartyType $buyerTradeParty): self
    {
        $this->buyerTradeParty = $buyerTradeParty;
        return $this;
    }

    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\ReferencedDocumentType
     */
    public function getBuyerOrderReferencedDocument()
    {
        return $this->buyerOrderReferencedDocument;
    }

    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\minimum\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    public function setBuyerOrderReferencedDocument(?\horstoeko\zugferd\entities\minimum\ram\ReferencedDocumentType $buyerOrderReferencedDocument = null): self
    {
        $this->buyerOrderReferencedDocument = $buyerOrderReferencedDocument;
        return $this;
    }
}
