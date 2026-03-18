<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

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
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePartyType $sellerTradeParty
     */
    private $sellerTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePartyType $buyerTradeParty
     */
    private $buyerTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePartyType $sellerTaxRepresentativeTradeParty
     */
    private $sellerTaxRepresentativeTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $sellerOrderReferencedDocument
     */
    private $sellerOrderReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyerOrderReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $contractReferencedDocument
     */
    private $contractReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[] $additionalReferencedDocument
     */
    private $additionalReferencedDocument = [

    ];

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ProcuringProjectType $specifiedProcuringProject
     */
    private $specifiedProcuringProject;

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
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePartyType
     */
    public function getSellerTradeParty()
    {
        return $this->sellerTradeParty;
    }

    /**
     * Sets a new sellerTradeParty
     */
    public function setSellerTradeParty(\horstoeko\zugferd\entities\en16931\ram\TradePartyType $sellerTradeParty): self
    {
        $this->sellerTradeParty = $sellerTradeParty;
        return $this;
    }

    /**
     * Gets as buyerTradeParty
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePartyType
     */
    public function getBuyerTradeParty()
    {
        return $this->buyerTradeParty;
    }

    /**
     * Sets a new buyerTradeParty
     */
    public function setBuyerTradeParty(\horstoeko\zugferd\entities\en16931\ram\TradePartyType $buyerTradeParty): self
    {
        $this->buyerTradeParty = $buyerTradeParty;
        return $this;
    }

    /**
     * Gets as sellerTaxRepresentativeTradeParty
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePartyType
     */
    public function getSellerTaxRepresentativeTradeParty()
    {
        return $this->sellerTaxRepresentativeTradeParty;
    }

    /**
     * Sets a new sellerTaxRepresentativeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradePartyType $sellerTaxRepresentativeTradeParty
     */
    public function setSellerTaxRepresentativeTradeParty(?\horstoeko\zugferd\entities\en16931\ram\TradePartyType $sellerTaxRepresentativeTradeParty = null): self
    {
        $this->sellerTaxRepresentativeTradeParty = $sellerTaxRepresentativeTradeParty;
        return $this;
    }

    /**
     * Gets as sellerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function getSellerOrderReferencedDocument()
    {
        return $this->sellerOrderReferencedDocument;
    }

    /**
     * Sets a new sellerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $sellerOrderReferencedDocument
     */
    public function setSellerOrderReferencedDocument(?\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $sellerOrderReferencedDocument = null): self
    {
        $this->sellerOrderReferencedDocument = $sellerOrderReferencedDocument;
        return $this;
    }

    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function getBuyerOrderReferencedDocument()
    {
        return $this->buyerOrderReferencedDocument;
    }

    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    public function setBuyerOrderReferencedDocument(?\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument = null): self
    {
        $this->buyerOrderReferencedDocument = $buyerOrderReferencedDocument;
        return $this;
    }

    /**
     * Gets as contractReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function getContractReferencedDocument()
    {
        return $this->contractReferencedDocument;
    }

    /**
     * Sets a new contractReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $contractReferencedDocument
     */
    public function setContractReferencedDocument(?\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $contractReferencedDocument = null): self
    {
        $this->contractReferencedDocument = $contractReferencedDocument;
        return $this;
    }

    /**
     * Adds as additionalReferencedDocument
     */
    public function addToAdditionalReferencedDocument(\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $additionalReferencedDocument): self
    {
        $this->additionalReferencedDocument[] = $additionalReferencedDocument;
        return $this;
    }

    /**
     * isset additionalReferencedDocument
     *
     * @param  int|string $index
     */
    public function issetAdditionalReferencedDocument($index): bool
    {
        return isset($this->additionalReferencedDocument[$index]);
    }

    /**
     * unset additionalReferencedDocument
     *
     * @param  int|string $index
     */
    public function unsetAdditionalReferencedDocument($index): void
    {
        unset($this->additionalReferencedDocument[$index]);
    }

    /**
     * Gets as additionalReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[]
     */
    public function getAdditionalReferencedDocument()
    {
        return $this->additionalReferencedDocument;
    }

    /**
     * Sets a new additionalReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[] $additionalReferencedDocument
     */
    public function setAdditionalReferencedDocument(?array $additionalReferencedDocument = null): self
    {
        $this->additionalReferencedDocument = $additionalReferencedDocument;
        return $this;
    }

    /**
     * Gets as specifiedProcuringProject
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ProcuringProjectType
     */
    public function getSpecifiedProcuringProject()
    {
        return $this->specifiedProcuringProject;
    }

    /**
     * Sets a new specifiedProcuringProject
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ProcuringProjectType $specifiedProcuringProject
     */
    public function setSpecifiedProcuringProject(?\horstoeko\zugferd\entities\en16931\ram\ProcuringProjectType $specifiedProcuringProject = null): self
    {
        $this->specifiedProcuringProject = $specifiedProcuringProject;
        return $this;
    }
}
