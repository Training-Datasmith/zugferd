<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing LineTradeSettlementType
 *
 * XSD Type: LineTradeSettlementType
 */
class Line_Trade_Settlement_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeTaxType $applicableTradeTax
     */
    private $applicable_trade_tax;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    private $billing_specified_period;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    private $specified_trade_allowance_charge = [];
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeSettlementLineMonetarySummationType $specifiedTradeSettlementLineMonetarySummation
     */
    private $specified_trade_settlement_line_monetary_summation;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $additionalReferencedDocument
     */
    private $additional_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount
     */
    private $receivable_specified_trade_accounting_account;
    /**
     * Gets as applicableTradeTax
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeTaxType
     */
    public function get_applicable_trade_tax()
    {
        return $this->applicable_trade_tax;
    }
    /**
     * Sets a new applicableTradeTax
     */
    public function set_applicable_trade_tax(\horstoeko\zugferd\entities\en16931\ram\Trade_Tax_Type $applicable_trade_tax): self
    {
        $this->applicable_trade_tax = $applicable_trade_tax;
        return $this;
    }
    /**
     * Gets as billingSpecifiedPeriod
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\SpecifiedPeriodType
     */
    public function get_billing_specified_period()
    {
        return $this->billing_specified_period;
    }
    /**
     * Sets a new billingSpecifiedPeriod
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    public function set_billing_specified_period(?\horstoeko\zugferd\entities\en16931\ram\Specified_Period_Type $billing_specified_period = null): self
    {
        $this->billing_specified_period = $billing_specified_period;
        return $this;
    }
    /**
     * Adds as specifiedTradeAllowanceCharge
     */
    public function add_to_specified_trade_allowance_charge(\horstoeko\zugferd\entities\en16931\ram\Trade_Allowance_Charge_Type $specified_trade_allowance_charge): self
    {
        $this->specified_trade_allowance_charge[] = $specified_trade_allowance_charge;
        return $this;
    }
    /**
     * isset specifiedTradeAllowanceCharge
     *
     * @param  int|string $index
     */
    public function isset_specified_trade_allowance_charge($index): bool
    {
        return isset($this->specified_trade_allowance_charge[$index]);
    }
    /**
     * unset specifiedTradeAllowanceCharge
     *
     * @param  int|string $index
     */
    public function unset_specified_trade_allowance_charge($index): void
    {
        unset($this->specified_trade_allowance_charge[$index]);
    }
    /**
     * Gets as specifiedTradeAllowanceCharge
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType[]
     */
    public function get_specified_trade_allowance_charge()
    {
        return $this->specified_trade_allowance_charge;
    }
    /**
     * Sets a new specifiedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    public function set_specified_trade_allowance_charge(?array $specified_trade_allowance_charge = null): self
    {
        $this->specified_trade_allowance_charge = $specified_trade_allowance_charge;
        return $this;
    }
    /**
     * Gets as specifiedTradeSettlementLineMonetarySummation
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeSettlementLineMonetarySummationType
     */
    public function get_specified_trade_settlement_line_monetary_summation()
    {
        return $this->specified_trade_settlement_line_monetary_summation;
    }
    /**
     * Sets a new specifiedTradeSettlementLineMonetarySummation
     */
    public function set_specified_trade_settlement_line_monetary_summation(\horstoeko\zugferd\entities\en16931\ram\Trade_Settlement_Line_Monetary_Summation_Type $specified_trade_settlement_line_monetary_summation): self
    {
        $this->specified_trade_settlement_line_monetary_summation = $specified_trade_settlement_line_monetary_summation;
        return $this;
    }
    /**
     * Gets as additionalReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function get_additional_referenced_document()
    {
        return $this->additional_referenced_document;
    }
    /**
     * Sets a new additionalReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $additionalReferencedDocument
     */
    public function set_additional_referenced_document(?\horstoeko\zugferd\entities\en16931\ram\Referenced_Document_Type $additional_referenced_document = null): self
    {
        $this->additional_referenced_document = $additional_referenced_document;
        return $this;
    }
    /**
     * Gets as receivableSpecifiedTradeAccountingAccount
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType
     */
    public function get_receivable_specified_trade_accounting_account()
    {
        return $this->receivable_specified_trade_accounting_account;
    }
    /**
     * Sets a new receivableSpecifiedTradeAccountingAccount
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount
     */
    public function set_receivable_specified_trade_accounting_account(?\horstoeko\zugferd\entities\en16931\ram\Trade_Accounting_Account_Type $receivable_specified_trade_accounting_account = null): self
    {
        $this->receivable_specified_trade_accounting_account = $receivable_specified_trade_accounting_account;
        return $this;
    }
}