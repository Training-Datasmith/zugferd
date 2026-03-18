<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LineTradeSettlementType
 *
 * XSD Type: LineTradeSettlementType
 */
class LineTradeSettlementType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $applicableTradeTax
     */
    private $applicableTradeTax = [

    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    private $billingSpecifiedPeriod;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    private $specifiedTradeAllowanceCharge = [

    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeSettlementLineMonetarySummationType $specifiedTradeSettlementLineMonetarySummation
     */
    private $specifiedTradeSettlementLineMonetarySummation;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $invoiceReferencedDocument
     */
    private $invoiceReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $additionalReferencedDocument
     */
    private $additionalReferencedDocument = [

    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount
     */
    private $receivableSpecifiedTradeAccountingAccount;

    /**
     * Adds as applicableTradeTax
     */
    public function addToApplicableTradeTax(\horstoeko\zugferd\entities\extended\ram\TradeTaxType $applicableTradeTax): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\TradeTaxType[]
     */
    public function getApplicableTradeTax()
    {
        return $this->applicableTradeTax;
    }

    /**
     * Sets a new applicableTradeTax
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $applicableTradeTax
     */
    public function setApplicableTradeTax(array $applicableTradeTax): self
    {
        $this->applicableTradeTax = $applicableTradeTax;
        return $this;
    }

    /**
     * Gets as billingSpecifiedPeriod
     *
     * @return \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType
     */
    public function getBillingSpecifiedPeriod()
    {
        return $this->billingSpecifiedPeriod;
    }

    /**
     * Sets a new billingSpecifiedPeriod
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    public function setBillingSpecifiedPeriod(?\horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $billingSpecifiedPeriod = null): self
    {
        $this->billingSpecifiedPeriod = $billingSpecifiedPeriod;
        return $this;
    }

    /**
     * Adds as specifiedTradeAllowanceCharge
     */
    public function addToSpecifiedTradeAllowanceCharge(\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType $specifiedTradeAllowanceCharge): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[]
     */
    public function getSpecifiedTradeAllowanceCharge()
    {
        return $this->specifiedTradeAllowanceCharge;
    }

    /**
     * Sets a new specifiedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    public function setSpecifiedTradeAllowanceCharge(?array $specifiedTradeAllowanceCharge = null): self
    {
        $this->specifiedTradeAllowanceCharge = $specifiedTradeAllowanceCharge;
        return $this;
    }

    /**
     * Gets as specifiedTradeSettlementLineMonetarySummation
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeSettlementLineMonetarySummationType
     */
    public function getSpecifiedTradeSettlementLineMonetarySummation()
    {
        return $this->specifiedTradeSettlementLineMonetarySummation;
    }

    /**
     * Sets a new specifiedTradeSettlementLineMonetarySummation
     */
    public function setSpecifiedTradeSettlementLineMonetarySummation(\horstoeko\zugferd\entities\extended\ram\TradeSettlementLineMonetarySummationType $specifiedTradeSettlementLineMonetarySummation): self
    {
        $this->specifiedTradeSettlementLineMonetarySummation = $specifiedTradeSettlementLineMonetarySummation;
        return $this;
    }

    /**
     * Gets as invoiceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getInvoiceReferencedDocument()
    {
        return $this->invoiceReferencedDocument;
    }

    /**
     * Sets a new invoiceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $invoiceReferencedDocument
     */
    public function setInvoiceReferencedDocument(?\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $invoiceReferencedDocument = null): self
    {
        $this->invoiceReferencedDocument = $invoiceReferencedDocument;
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
     * Gets as receivableSpecifiedTradeAccountingAccount
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType
     */
    public function getReceivableSpecifiedTradeAccountingAccount()
    {
        return $this->receivableSpecifiedTradeAccountingAccount;
    }

    /**
     * Sets a new receivableSpecifiedTradeAccountingAccount
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount
     */
    public function setReceivableSpecifiedTradeAccountingAccount(?\horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount = null): self
    {
        $this->receivableSpecifiedTradeAccountingAccount = $receivableSpecifiedTradeAccountingAccount;
        return $this;
    }
}
