<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing LineTradeSettlementType
 *
 * XSD Type: LineTradeSettlementType
 */
class Line_Trade_Settlement_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradeTaxType $applicableTradeTax
     */
    private $applicable_trade_tax;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    private $billing_specified_period;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    private $specified_trade_allowance_charge = [];
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradeSettlementLineMonetarySummationType $specifiedTradeSettlementLineMonetarySummation
     */
    private $specified_trade_settlement_line_monetary_summation;
    /**
     * Gets as applicableTradeTax
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradeTaxType
     */
    public function get_applicable_trade_tax()
    {
        return $this->applicable_trade_tax;
    }
    /**
     * Sets a new applicableTradeTax
     */
    public function set_applicable_trade_tax(\horstoeko\zugferd\entities\basic\ram\Trade_Tax_Type $applicable_trade_tax): self
    {
        $this->applicable_trade_tax = $applicable_trade_tax;
        return $this;
    }
    /**
     * Gets as billingSpecifiedPeriod
     *
     * @return \horstoeko\zugferd\entities\basic\ram\SpecifiedPeriodType
     */
    public function get_billing_specified_period()
    {
        return $this->billing_specified_period;
    }
    /**
     * Sets a new billingSpecifiedPeriod
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    public function set_billing_specified_period(?\horstoeko\zugferd\entities\basic\ram\Specified_Period_Type $billing_specified_period = null): self
    {
        $this->billing_specified_period = $billing_specified_period;
        return $this;
    }
    /**
     * Adds as specifiedTradeAllowanceCharge
     */
    public function add_to_specified_trade_allowance_charge(\horstoeko\zugferd\entities\basic\ram\Trade_Allowance_Charge_Type $specified_trade_allowance_charge): self
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
     * @return \horstoeko\zugferd\entities\basic\ram\TradeAllowanceChargeType[]
     */
    public function get_specified_trade_allowance_charge()
    {
        return $this->specified_trade_allowance_charge;
    }
    /**
     * Sets a new specifiedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    public function set_specified_trade_allowance_charge(?array $specified_trade_allowance_charge = null): self
    {
        $this->specified_trade_allowance_charge = $specified_trade_allowance_charge;
        return $this;
    }
    /**
     * Gets as specifiedTradeSettlementLineMonetarySummation
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradeSettlementLineMonetarySummationType
     */
    public function get_specified_trade_settlement_line_monetary_summation()
    {
        return $this->specified_trade_settlement_line_monetary_summation;
    }
    /**
     * Sets a new specifiedTradeSettlementLineMonetarySummation
     */
    public function set_specified_trade_settlement_line_monetary_summation(\horstoeko\zugferd\entities\basic\ram\Trade_Settlement_Line_Monetary_Summation_Type $specified_trade_settlement_line_monetary_summation): self
    {
        $this->specified_trade_settlement_line_monetary_summation = $specified_trade_settlement_line_monetary_summation;
        return $this;
    }
}