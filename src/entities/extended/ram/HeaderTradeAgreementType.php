<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

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
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $sellerTradeParty
     */
    private $sellerTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $buyerTradeParty
     */
    private $buyerTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $salesAgentTradeParty
     */
    private $salesAgentTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $buyerTaxRepresentativeTradeParty
     */
    private $buyerTaxRepresentativeTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $sellerTaxRepresentativeTradeParty
     */
    private $sellerTaxRepresentativeTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $productEndUserTradeParty
     */
    private $productEndUserTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeDeliveryTermsType $applicableTradeDeliveryTerms
     */
    private $applicableTradeDeliveryTerms;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $sellerOrderReferencedDocument
     */
    private $sellerOrderReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyerOrderReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $quotationReferencedDocument
     */
    private $quotationReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $contractReferencedDocument
     */
    private $contractReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $additionalReferencedDocument
     */
    private $additionalReferencedDocument = [

    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $buyerAgentTradeParty
     */
    private $buyerAgentTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ProcuringProjectType $specifiedProcuringProject
     */
    private $specifiedProcuringProject;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $ultimateCustomerOrderReferencedDocument
     */
    private $ultimateCustomerOrderReferencedDocument = [

    ];

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
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getSellerTradeParty()
    {
        return $this->sellerTradeParty;
    }

    /**
     * Sets a new sellerTradeParty
     */
    public function setSellerTradeParty(\horstoeko\zugferd\entities\extended\ram\TradePartyType $sellerTradeParty): self
    {
        $this->sellerTradeParty = $sellerTradeParty;
        return $this;
    }

    /**
     * Gets as buyerTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getBuyerTradeParty()
    {
        return $this->buyerTradeParty;
    }

    /**
     * Sets a new buyerTradeParty
     */
    public function setBuyerTradeParty(\horstoeko\zugferd\entities\extended\ram\TradePartyType $buyerTradeParty): self
    {
        $this->buyerTradeParty = $buyerTradeParty;
        return $this;
    }

    /**
     * Gets as salesAgentTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getSalesAgentTradeParty()
    {
        return $this->salesAgentTradeParty;
    }

    /**
     * Sets a new salesAgentTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $salesAgentTradeParty
     */
    public function setSalesAgentTradeParty(?\horstoeko\zugferd\entities\extended\ram\TradePartyType $salesAgentTradeParty = null): self
    {
        $this->salesAgentTradeParty = $salesAgentTradeParty;
        return $this;
    }

    /**
     * Gets as buyerTaxRepresentativeTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getBuyerTaxRepresentativeTradeParty()
    {
        return $this->buyerTaxRepresentativeTradeParty;
    }

    /**
     * Sets a new buyerTaxRepresentativeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $buyerTaxRepresentativeTradeParty
     */
    public function setBuyerTaxRepresentativeTradeParty(?\horstoeko\zugferd\entities\extended\ram\TradePartyType $buyerTaxRepresentativeTradeParty = null): self
    {
        $this->buyerTaxRepresentativeTradeParty = $buyerTaxRepresentativeTradeParty;
        return $this;
    }

    /**
     * Gets as sellerTaxRepresentativeTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getSellerTaxRepresentativeTradeParty()
    {
        return $this->sellerTaxRepresentativeTradeParty;
    }

    /**
     * Sets a new sellerTaxRepresentativeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $sellerTaxRepresentativeTradeParty
     */
    public function setSellerTaxRepresentativeTradeParty(?\horstoeko\zugferd\entities\extended\ram\TradePartyType $sellerTaxRepresentativeTradeParty = null): self
    {
        $this->sellerTaxRepresentativeTradeParty = $sellerTaxRepresentativeTradeParty;
        return $this;
    }

    /**
     * Gets as productEndUserTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getProductEndUserTradeParty()
    {
        return $this->productEndUserTradeParty;
    }

    /**
     * Sets a new productEndUserTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $productEndUserTradeParty
     */
    public function setProductEndUserTradeParty(?\horstoeko\zugferd\entities\extended\ram\TradePartyType $productEndUserTradeParty = null): self
    {
        $this->productEndUserTradeParty = $productEndUserTradeParty;
        return $this;
    }

    /**
     * Gets as applicableTradeDeliveryTerms
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeDeliveryTermsType
     */
    public function getApplicableTradeDeliveryTerms()
    {
        return $this->applicableTradeDeliveryTerms;
    }

    /**
     * Sets a new applicableTradeDeliveryTerms
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeDeliveryTermsType $applicableTradeDeliveryTerms
     */
    public function setApplicableTradeDeliveryTerms(?\horstoeko\zugferd\entities\extended\ram\TradeDeliveryTermsType $applicableTradeDeliveryTerms = null): self
    {
        $this->applicableTradeDeliveryTerms = $applicableTradeDeliveryTerms;
        return $this;
    }

    /**
     * Gets as sellerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getSellerOrderReferencedDocument()
    {
        return $this->sellerOrderReferencedDocument;
    }

    /**
     * Sets a new sellerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $sellerOrderReferencedDocument
     */
    public function setSellerOrderReferencedDocument(?\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $sellerOrderReferencedDocument = null): self
    {
        $this->sellerOrderReferencedDocument = $sellerOrderReferencedDocument;
        return $this;
    }

    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getBuyerOrderReferencedDocument()
    {
        return $this->buyerOrderReferencedDocument;
    }

    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    public function setBuyerOrderReferencedDocument(?\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $buyerOrderReferencedDocument = null): self
    {
        $this->buyerOrderReferencedDocument = $buyerOrderReferencedDocument;
        return $this;
    }

    /**
     * Gets as quotationReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getQuotationReferencedDocument()
    {
        return $this->quotationReferencedDocument;
    }

    /**
     * Sets a new quotationReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $quotationReferencedDocument
     */
    public function setQuotationReferencedDocument(?\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $quotationReferencedDocument = null): self
    {
        $this->quotationReferencedDocument = $quotationReferencedDocument;
        return $this;
    }

    /**
     * Gets as contractReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getContractReferencedDocument()
    {
        return $this->contractReferencedDocument;
    }

    /**
     * Sets a new contractReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $contractReferencedDocument
     */
    public function setContractReferencedDocument(?\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $contractReferencedDocument = null): self
    {
        $this->contractReferencedDocument = $contractReferencedDocument;
        return $this;
    }

    /**
     * Adds as additionalReferencedDocument
     */
    public function addToAdditionalReferencedDocument(\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $additionalReferencedDocument): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[]
     */
    public function getAdditionalReferencedDocument()
    {
        return $this->additionalReferencedDocument;
    }

    /**
     * Sets a new additionalReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $additionalReferencedDocument
     */
    public function setAdditionalReferencedDocument(?array $additionalReferencedDocument = null): self
    {
        $this->additionalReferencedDocument = $additionalReferencedDocument;
        return $this;
    }

    /**
     * Gets as buyerAgentTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getBuyerAgentTradeParty()
    {
        return $this->buyerAgentTradeParty;
    }

    /**
     * Sets a new buyerAgentTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $buyerAgentTradeParty
     */
    public function setBuyerAgentTradeParty(?\horstoeko\zugferd\entities\extended\ram\TradePartyType $buyerAgentTradeParty = null): self
    {
        $this->buyerAgentTradeParty = $buyerAgentTradeParty;
        return $this;
    }

    /**
     * Gets as specifiedProcuringProject
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ProcuringProjectType
     */
    public function getSpecifiedProcuringProject()
    {
        return $this->specifiedProcuringProject;
    }

    /**
     * Sets a new specifiedProcuringProject
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ProcuringProjectType $specifiedProcuringProject
     */
    public function setSpecifiedProcuringProject(?\horstoeko\zugferd\entities\extended\ram\ProcuringProjectType $specifiedProcuringProject = null): self
    {
        $this->specifiedProcuringProject = $specifiedProcuringProject;
        return $this;
    }

    /**
     * Adds as ultimateCustomerOrderReferencedDocument
     */
    public function addToUltimateCustomerOrderReferencedDocument(\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $ultimateCustomerOrderReferencedDocument): self
    {
        $this->ultimateCustomerOrderReferencedDocument[] = $ultimateCustomerOrderReferencedDocument;
        return $this;
    }

    /**
     * isset ultimateCustomerOrderReferencedDocument
     *
     * @param  int|string $index
     */
    public function issetUltimateCustomerOrderReferencedDocument($index): bool
    {
        return isset($this->ultimateCustomerOrderReferencedDocument[$index]);
    }

    /**
     * unset ultimateCustomerOrderReferencedDocument
     *
     * @param  int|string $index
     */
    public function unsetUltimateCustomerOrderReferencedDocument($index): void
    {
        unset($this->ultimateCustomerOrderReferencedDocument[$index]);
    }

    /**
     * Gets as ultimateCustomerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[]
     */
    public function getUltimateCustomerOrderReferencedDocument()
    {
        return $this->ultimateCustomerOrderReferencedDocument;
    }

    /**
     * Sets a new ultimateCustomerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $ultimateCustomerOrderReferencedDocument
     */
    public function setUltimateCustomerOrderReferencedDocument(?array $ultimateCustomerOrderReferencedDocument = null): self
    {
        $this->ultimateCustomerOrderReferencedDocument = $ultimateCustomerOrderReferencedDocument;
        return $this;
    }
}
