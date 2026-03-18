<?php

namespace horstoeko\zugferd\entities\basic\rsm;

/**
 * Class representing CrossIndustryInvoiceType
 *
 * XSD Type: CrossIndustryInvoiceType
 */
class CrossIndustryInvoiceType
{

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\ExchangedDocumentContextType $exchangedDocumentContext
     */
    private $exchangedDocumentContext;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\ExchangedDocumentType $exchangedDocument
     */
    private $exchangedDocument;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\SupplyChainTradeTransactionType $supplyChainTradeTransaction
     */
    private $supplyChainTradeTransaction;

    /**
     * Gets as exchangedDocumentContext
     *
     * @return \horstoeko\zugferd\entities\basic\ram\ExchangedDocumentContextType
     */
    public function getExchangedDocumentContext()
    {
        return $this->exchangedDocumentContext;
    }

    /**
     * Sets a new exchangedDocumentContext
     */
    public function setExchangedDocumentContext(\horstoeko\zugferd\entities\basic\ram\ExchangedDocumentContextType $exchangedDocumentContext): self
    {
        $this->exchangedDocumentContext = $exchangedDocumentContext;
        return $this;
    }

    /**
     * Gets as exchangedDocument
     *
     * @return \horstoeko\zugferd\entities\basic\ram\ExchangedDocumentType
     */
    public function getExchangedDocument()
    {
        return $this->exchangedDocument;
    }

    /**
     * Sets a new exchangedDocument
     */
    public function setExchangedDocument(\horstoeko\zugferd\entities\basic\ram\ExchangedDocumentType $exchangedDocument): self
    {
        $this->exchangedDocument = $exchangedDocument;
        return $this;
    }

    /**
     * Gets as supplyChainTradeTransaction
     *
     * @return \horstoeko\zugferd\entities\basic\ram\SupplyChainTradeTransactionType
     */
    public function getSupplyChainTradeTransaction()
    {
        return $this->supplyChainTradeTransaction;
    }

    /**
     * Sets a new supplyChainTradeTransaction
     */
    public function setSupplyChainTradeTransaction(\horstoeko\zugferd\entities\basic\ram\SupplyChainTradeTransactionType $supplyChainTradeTransaction): self
    {
        $this->supplyChainTradeTransaction = $supplyChainTradeTransaction;
        return $this;
    }
}
