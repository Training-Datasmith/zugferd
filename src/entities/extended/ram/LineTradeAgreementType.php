<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LineTradeAgreementType
 *
 * XSD Type: LineTradeAgreementType
 */
class LineTradeAgreementType
{

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
     * @var \horstoeko\zugferd\entities\extended\ram\TradePriceType $grossPriceProductTradePrice
     */
    private $grossPriceProductTradePrice;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePriceType $netPriceProductTradePrice
     */
    private $netPriceProductTradePrice;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $ultimateCustomerOrderReferencedDocument
     */
    private $ultimateCustomerOrderReferencedDocument = [
        
    ];

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
     * Gets as grossPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePriceType
     */
    public function getGrossPriceProductTradePrice()
    {
        return $this->grossPriceProductTradePrice;
    }

    /**
     * Sets a new grossPriceProductTradePrice
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePriceType $grossPriceProductTradePrice
     */
    public function setGrossPriceProductTradePrice(?\horstoeko\zugferd\entities\extended\ram\TradePriceType $grossPriceProductTradePrice = null): self
    {
        $this->grossPriceProductTradePrice = $grossPriceProductTradePrice;
        return $this;
    }

    /**
     * Gets as netPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePriceType
     */
    public function getNetPriceProductTradePrice()
    {
        return $this->netPriceProductTradePrice;
    }

    /**
     * Sets a new netPriceProductTradePrice
     */
    public function setNetPriceProductTradePrice(\horstoeko\zugferd\entities\extended\ram\TradePriceType $netPriceProductTradePrice): self
    {
        $this->netPriceProductTradePrice = $netPriceProductTradePrice;
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
