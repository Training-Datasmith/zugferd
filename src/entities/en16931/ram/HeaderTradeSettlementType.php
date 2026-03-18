<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing HeaderTradeSettlementType
 *
 * XSD Type: HeaderTradeSettlementType
 */
class HeaderTradeSettlementType
{

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $creditorReferenceID
     */
    private $creditorReferenceID;

    /**
     * @var string $paymentReference
     */
    private $paymentReference;

    /**
     * @var string $taxCurrencyCode
     */
    private $taxCurrencyCode;

    /**
     * @var string $invoiceCurrencyCode
     */
    private $invoiceCurrencyCode;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePartyType $payeeTradeParty
     */
    private $payeeTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeSettlementPaymentMeansType[] $specifiedTradeSettlementPaymentMeans
     */
    private $specifiedTradeSettlementPaymentMeans = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeTaxType[] $applicableTradeTax
     */
    private $applicableTradeTax = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    private $billingSpecifiedPeriod;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    private $specifiedTradeAllowanceCharge = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePaymentTermsType $specifiedTradePaymentTerms
     */
    private $specifiedTradePaymentTerms;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeSettlementHeaderMonetarySummationType $specifiedTradeSettlementHeaderMonetarySummation
     */
    private $specifiedTradeSettlementHeaderMonetarySummation;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[] $invoiceReferencedDocument
     */
    private $invoiceReferencedDocument = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount
     */
    private $receivableSpecifiedTradeAccountingAccount;

    /**
     * Gets as creditorReferenceID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getCreditorReferenceID()
    {
        return $this->creditorReferenceID;
    }

    /**
     * Sets a new creditorReferenceID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $creditorReferenceID
     */
    public function setCreditorReferenceID(?\horstoeko\zugferd\entities\en16931\udt\IDType $creditorReferenceID = null): self
    {
        $this->creditorReferenceID = $creditorReferenceID;
        return $this;
    }

    /**
     * Gets as paymentReference
     *
     * @return string
     */
    public function getPaymentReference()
    {
        return $this->paymentReference;
    }

    /**
     * Sets a new paymentReference
     *
     * @param  string $paymentReference
     */
    public function setPaymentReference($paymentReference): self
    {
        $this->paymentReference = $paymentReference;
        return $this;
    }

    /**
     * Gets as taxCurrencyCode
     *
     * @return string
     */
    public function getTaxCurrencyCode()
    {
        return $this->taxCurrencyCode;
    }

    /**
     * Sets a new taxCurrencyCode
     *
     * @param  string $taxCurrencyCode
     */
    public function setTaxCurrencyCode($taxCurrencyCode): self
    {
        $this->taxCurrencyCode = $taxCurrencyCode;
        return $this;
    }

    /**
     * Gets as invoiceCurrencyCode
     *
     * @return string
     */
    public function getInvoiceCurrencyCode()
    {
        return $this->invoiceCurrencyCode;
    }

    /**
     * Sets a new invoiceCurrencyCode
     *
     * @param  string $invoiceCurrencyCode
     */
    public function setInvoiceCurrencyCode($invoiceCurrencyCode): self
    {
        $this->invoiceCurrencyCode = $invoiceCurrencyCode;
        return $this;
    }

    /**
     * Gets as payeeTradeParty
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePartyType
     */
    public function getPayeeTradeParty()
    {
        return $this->payeeTradeParty;
    }

    /**
     * Sets a new payeeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradePartyType $payeeTradeParty
     */
    public function setPayeeTradeParty(?\horstoeko\zugferd\entities\en16931\ram\TradePartyType $payeeTradeParty = null): self
    {
        $this->payeeTradeParty = $payeeTradeParty;
        return $this;
    }

    /**
     * Adds as specifiedTradeSettlementPaymentMeans
     */
    public function addToSpecifiedTradeSettlementPaymentMeans(\horstoeko\zugferd\entities\en16931\ram\TradeSettlementPaymentMeansType $specifiedTradeSettlementPaymentMeans): self
    {
        $this->specifiedTradeSettlementPaymentMeans[] = $specifiedTradeSettlementPaymentMeans;
        return $this;
    }

    /**
     * isset specifiedTradeSettlementPaymentMeans
     *
     * @param  int|string $index
     */
    public function issetSpecifiedTradeSettlementPaymentMeans($index): bool
    {
        return isset($this->specifiedTradeSettlementPaymentMeans[$index]);
    }

    /**
     * unset specifiedTradeSettlementPaymentMeans
     *
     * @param  int|string $index
     */
    public function unsetSpecifiedTradeSettlementPaymentMeans($index): void
    {
        unset($this->specifiedTradeSettlementPaymentMeans[$index]);
    }

    /**
     * Gets as specifiedTradeSettlementPaymentMeans
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeSettlementPaymentMeansType[]
     */
    public function getSpecifiedTradeSettlementPaymentMeans()
    {
        return $this->specifiedTradeSettlementPaymentMeans;
    }

    /**
     * Sets a new specifiedTradeSettlementPaymentMeans
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeSettlementPaymentMeansType[] $specifiedTradeSettlementPaymentMeans
     */
    public function setSpecifiedTradeSettlementPaymentMeans(?array $specifiedTradeSettlementPaymentMeans = null): self
    {
        $this->specifiedTradeSettlementPaymentMeans = $specifiedTradeSettlementPaymentMeans;
        return $this;
    }

    /**
     * Adds as applicableTradeTax
     */
    public function addToApplicableTradeTax(\horstoeko\zugferd\entities\en16931\ram\TradeTaxType $applicableTradeTax): self
    {
        $this->applicableTradeTax[] = $applicableTradeTax;
        return $this;
    }

    /**
     * isset applicableTradeTax
     *
     * @param  int|string $index
     */
    public function issetApplicableTradeTax($index): bool
    {
        return isset($this->applicableTradeTax[$index]);
    }

    /**
     * unset applicableTradeTax
     *
     * @param  int|string $index
     */
    public function unsetApplicableTradeTax($index): void
    {
        unset($this->applicableTradeTax[$index]);
    }

    /**
     * Gets as applicableTradeTax
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeTaxType[]
     */
    public function getApplicableTradeTax()
    {
        return $this->applicableTradeTax;
    }

    /**
     * Sets a new applicableTradeTax
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeTaxType[] $applicableTradeTax
     */
    public function setApplicableTradeTax(array $applicableTradeTax): self
    {
        $this->applicableTradeTax = $applicableTradeTax;
        return $this;
    }

    /**
     * Gets as billingSpecifiedPeriod
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\SpecifiedPeriodType
     */
    public function getBillingSpecifiedPeriod()
    {
        return $this->billingSpecifiedPeriod;
    }

    /**
     * Sets a new billingSpecifiedPeriod
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    public function setBillingSpecifiedPeriod(?\horstoeko\zugferd\entities\en16931\ram\SpecifiedPeriodType $billingSpecifiedPeriod = null): self
    {
        $this->billingSpecifiedPeriod = $billingSpecifiedPeriod;
        return $this;
    }

    /**
     * Adds as specifiedTradeAllowanceCharge
     */
    public function addToSpecifiedTradeAllowanceCharge(\horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType $specifiedTradeAllowanceCharge): self
    {
        $this->specifiedTradeAllowanceCharge[] = $specifiedTradeAllowanceCharge;
        return $this;
    }

    /**
     * isset specifiedTradeAllowanceCharge
     *
     * @param  int|string $index
     */
    public function issetSpecifiedTradeAllowanceCharge($index): bool
    {
        return isset($this->specifiedTradeAllowanceCharge[$index]);
    }

    /**
     * unset specifiedTradeAllowanceCharge
     *
     * @param  int|string $index
     */
    public function unsetSpecifiedTradeAllowanceCharge($index): void
    {
        unset($this->specifiedTradeAllowanceCharge[$index]);
    }

    /**
     * Gets as specifiedTradeAllowanceCharge
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType[]
     */
    public function getSpecifiedTradeAllowanceCharge()
    {
        return $this->specifiedTradeAllowanceCharge;
    }

    /**
     * Sets a new specifiedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    public function setSpecifiedTradeAllowanceCharge(?array $specifiedTradeAllowanceCharge = null): self
    {
        $this->specifiedTradeAllowanceCharge = $specifiedTradeAllowanceCharge;
        return $this;
    }

    /**
     * Gets as specifiedTradePaymentTerms
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePaymentTermsType
     */
    public function getSpecifiedTradePaymentTerms()
    {
        return $this->specifiedTradePaymentTerms;
    }

    /**
     * Sets a new specifiedTradePaymentTerms
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradePaymentTermsType $specifiedTradePaymentTerms
     */
    public function setSpecifiedTradePaymentTerms(?\horstoeko\zugferd\entities\en16931\ram\TradePaymentTermsType $specifiedTradePaymentTerms = null): self
    {
        $this->specifiedTradePaymentTerms = $specifiedTradePaymentTerms;
        return $this;
    }

    /**
     * Gets as specifiedTradeSettlementHeaderMonetarySummation
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeSettlementHeaderMonetarySummationType
     */
    public function getSpecifiedTradeSettlementHeaderMonetarySummation()
    {
        return $this->specifiedTradeSettlementHeaderMonetarySummation;
    }

    /**
     * Sets a new specifiedTradeSettlementHeaderMonetarySummation
     */
    public function setSpecifiedTradeSettlementHeaderMonetarySummation(\horstoeko\zugferd\entities\en16931\ram\TradeSettlementHeaderMonetarySummationType $specifiedTradeSettlementHeaderMonetarySummation): self
    {
        $this->specifiedTradeSettlementHeaderMonetarySummation = $specifiedTradeSettlementHeaderMonetarySummation;
        return $this;
    }

    /**
     * Adds as invoiceReferencedDocument
     */
    public function addToInvoiceReferencedDocument(\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $invoiceReferencedDocument): self
    {
        $this->invoiceReferencedDocument[] = $invoiceReferencedDocument;
        return $this;
    }

    /**
     * isset invoiceReferencedDocument
     *
     * @param  int|string $index
     */
    public function issetInvoiceReferencedDocument($index): bool
    {
        return isset($this->invoiceReferencedDocument[$index]);
    }

    /**
     * unset invoiceReferencedDocument
     *
     * @param  int|string $index
     */
    public function unsetInvoiceReferencedDocument($index): void
    {
        unset($this->invoiceReferencedDocument[$index]);
    }

    /**
     * Gets as invoiceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[]
     */
    public function getInvoiceReferencedDocument()
    {
        return $this->invoiceReferencedDocument;
    }

    /**
     * Sets a new invoiceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[] $invoiceReferencedDocument
     */
    public function setInvoiceReferencedDocument(?array $invoiceReferencedDocument = null): self
    {
        $this->invoiceReferencedDocument = $invoiceReferencedDocument;
        return $this;
    }

    /**
     * Gets as receivableSpecifiedTradeAccountingAccount
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType
     */
    public function getReceivableSpecifiedTradeAccountingAccount()
    {
        return $this->receivableSpecifiedTradeAccountingAccount;
    }

    /**
     * Sets a new receivableSpecifiedTradeAccountingAccount
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount
     */
    public function setReceivableSpecifiedTradeAccountingAccount(?\horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount = null): self
    {
        $this->receivableSpecifiedTradeAccountingAccount = $receivableSpecifiedTradeAccountingAccount;
        return $this;
    }
}
