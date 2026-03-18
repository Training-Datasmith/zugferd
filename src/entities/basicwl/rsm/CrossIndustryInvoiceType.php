<?php

namespace horstoeko\zugferd\entities\basicwl\rsm;

/**
 * Class representing CrossIndustryInvoiceType
 *
 * XSD Type: CrossIndustryInvoiceType
 */
class CrossIndustryInvoiceType
{

    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\ExchangedDocumentContextType $exchangedDocumentContext
     */
    private $exchangedDocumentContext;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\ExchangedDocumentType $exchangedDocument
     */
    private $exchangedDocument;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\SupplyChainTradeTransactionType $supplyChainTradeTransaction
     */
    private $supplyChainTradeTransaction;

    /**
     * Gets as exchangedDocumentContext
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\ExchangedDocumentContextType
     */
    public function getExchangedDocumentContext()
    {
        return $this->exchangedDocumentContext;
    }

    /**
     * Sets a new exchangedDocumentContext
     */
    public function setExchangedDocumentContext(\horstoeko\zugferd\entities\basicwl\ram\ExchangedDocumentContextType $exchangedDocumentContext): self
    {
        $this->exchangedDocumentContext = $exchangedDocumentContext;
        return $this;
    }

    /**
     * Gets as exchangedDocument
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\ExchangedDocumentType
     */
    public function getExchangedDocument()
    {
        return $this->exchangedDocument;
    }

    /**
     * Sets a new exchangedDocument
     */
    public function setExchangedDocument(\horstoeko\zugferd\entities\basicwl\ram\ExchangedDocumentType $exchangedDocument): self
    {
        $this->exchangedDocument = $exchangedDocument;
        return $this;
    }

    /**
     * Gets as supplyChainTradeTransaction
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\SupplyChainTradeTransactionType
     */
    public function getSupplyChainTradeTransaction()
    {
        return $this->supplyChainTradeTransaction;
    }

    /**
     * Sets a new supplyChainTradeTransaction
     */
    public function setSupplyChainTradeTransaction(\horstoeko\zugferd\entities\basicwl\ram\SupplyChainTradeTransactionType $supplyChainTradeTransaction): self
    {
        $this->supplyChainTradeTransaction = $supplyChainTradeTransaction;
        return $this;
    }
}
