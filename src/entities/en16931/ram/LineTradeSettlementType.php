<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing LineTradeSettlementType
 *
 * XSD Type: LineTradeSettlementType
 */
class LineTradeSettlementType
{

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeTaxType $applicableTradeTax
     */
    private $applicableTradeTax;

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
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeSettlementLineMonetarySummationType $specifiedTradeSettlementLineMonetarySummation
     */
    private $specifiedTradeSettlementLineMonetarySummation;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $additionalReferencedDocument
     */
    private $additionalReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount
     */
    private $receivableSpecifiedTradeAccountingAccount;

    /**
     * Gets as applicableTradeTax
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeTaxType
     */
    public function getApplicableTradeTax()
    {
        return $this->applicableTradeTax;
    }

    /**
     * Sets a new applicableTradeTax
     */
    public function setApplicableTradeTax(\horstoeko\zugferd\entities\en16931\ram\TradeTaxType $applicableTradeTax): self
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
     * Gets as specifiedTradeSettlementLineMonetarySummation
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeSettlementLineMonetarySummationType
     */
    public function getSpecifiedTradeSettlementLineMonetarySummation()
    {
        return $this->specifiedTradeSettlementLineMonetarySummation;
    }

    /**
     * Sets a new specifiedTradeSettlementLineMonetarySummation
     */
    public function setSpecifiedTradeSettlementLineMonetarySummation(\horstoeko\zugferd\entities\en16931\ram\TradeSettlementLineMonetarySummationType $specifiedTradeSettlementLineMonetarySummation): self
    {
        $this->specifiedTradeSettlementLineMonetarySummation = $specifiedTradeSettlementLineMonetarySummation;
        return $this;
    }

    /**
     * Gets as additionalReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function getAdditionalReferencedDocument()
    {
        return $this->additionalReferencedDocument;
    }

    /**
     * Sets a new additionalReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $additionalReferencedDocument
     */
    public function setAdditionalReferencedDocument(?\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $additionalReferencedDocument = null): self
    {
        $this->additionalReferencedDocument = $additionalReferencedDocument;
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
