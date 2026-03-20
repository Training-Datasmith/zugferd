<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\rsm;

/**
 * Class representing CrossIndustryInvoiceType
 *
 * XSD Type: CrossIndustryInvoiceType
 */
class Cross_Industry_Invoice_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ExchangedDocumentContextType $exchangedDocumentContext
     */
    private $exchanged_document_context;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ExchangedDocumentType $exchangedDocument
     */
    private $exchanged_document;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\SupplyChainTradeTransactionType $supplyChainTradeTransaction
     */
    private $supply_chain_trade_transaction;
    /**
     * Gets as exchangedDocumentContext
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ExchangedDocumentContextType
     */
    public function get_exchanged_document_context()
    {
        return $this->exchanged_document_context;
    }
    /**
     * Sets a new exchangedDocumentContext
     */
    public function set_exchanged_document_context(\horstoeko\zugferd\entities\en16931\ram\Exchanged_Document_Context_Type $exchanged_document_context): self
    {
        $this->exchanged_document_context = $exchanged_document_context;
        return $this;
    }
    /**
     * Gets as exchangedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ExchangedDocumentType
     */
    public function get_exchanged_document()
    {
        return $this->exchanged_document;
    }
    /**
     * Sets a new exchangedDocument
     */
    public function set_exchanged_document(\horstoeko\zugferd\entities\en16931\ram\Exchanged_Document_Type $exchanged_document): self
    {
        $this->exchanged_document = $exchanged_document;
        return $this;
    }
    /**
     * Gets as supplyChainTradeTransaction
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\SupplyChainTradeTransactionType
     */
    public function get_supply_chain_trade_transaction()
    {
        return $this->supply_chain_trade_transaction;
    }
    /**
     * Sets a new supplyChainTradeTransaction
     */
    public function set_supply_chain_trade_transaction(\horstoeko\zugferd\entities\en16931\ram\Supply_Chain_Trade_Transaction_Type $supply_chain_trade_transaction): self
    {
        $this->supply_chain_trade_transaction = $supply_chain_trade_transaction;
        return $this;
    }
}