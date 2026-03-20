<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing TradeAllowanceChargeType
 *
 * XSD Type: TradeAllowanceChargeType
 */
class Trade_Allowance_Charge_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IndicatorType $chargeIndicator
     */
    private $charge_indicator;
    /**
     * @var float $calculationPercent
     */
    private $calculation_percent;
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\AmountType $basisAmount
     */
    private $basis_amount;
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\AmountType $actualAmount
     */
    private $actual_amount;
    /**
     * @var string $reasonCode
     */
    private $reason_code;
    /**
     * @var string $reason
     */
    private $reason;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradeTaxType $categoryTradeTax
     */
    private $category_trade_tax;
    /**
     * Gets as chargeIndicator
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IndicatorType
     */
    public function get_charge_indicator()
    {
        return $this->charge_indicator;
    }
    /**
     * Sets a new chargeIndicator
     */
    public function set_charge_indicator(\horstoeko\zugferd\entities\basic\udt\Indicator_Type $charge_indicator): self
    {
        $this->charge_indicator = $charge_indicator;
        return $this;
    }
    /**
     * Gets as calculationPercent
     *
     * @return float
     */
    public function get_calculation_percent()
    {
        return $this->calculation_percent;
    }
    /**
     * Sets a new calculationPercent
     *
     * @param  float $calculationPercent
     */
    public function set_calculation_percent($calculation_percent): self
    {
        $this->calculation_percent = $calculation_percent;
        return $this;
    }
    /**
     * Gets as basisAmount
     *
     * @return \horstoeko\zugferd\entities\basic\udt\AmountType
     */
    public function get_basis_amount()
    {
        return $this->basis_amount;
    }
    /**
     * Sets a new basisAmount
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\AmountType $basisAmount
     */
    public function set_basis_amount(?\horstoeko\zugferd\entities\basic\udt\Amount_Type $basis_amount = null): self
    {
        $this->basis_amount = $basis_amount;
        return $this;
    }
    /**
     * Gets as actualAmount
     *
     * @return \horstoeko\zugferd\entities\basic\udt\AmountType
     */
    public function get_actual_amount()
    {
        return $this->actual_amount;
    }
    /**
     * Sets a new actualAmount
     */
    public function set_actual_amount(\horstoeko\zugferd\entities\basic\udt\Amount_Type $actual_amount): self
    {
        $this->actual_amount = $actual_amount;
        return $this;
    }
    /**
     * Gets as reasonCode
     *
     * @return string
     */
    public function get_reason_code()
    {
        return $this->reason_code;
    }
    /**
     * Sets a new reasonCode
     *
     * @param  string $reasonCode
     */
    public function set_reason_code($reason_code): self
    {
        $this->reason_code = $reason_code;
        return $this;
    }
    /**
     * Gets as reason
     *
     * @return string
     */
    public function get_reason()
    {
        return $this->reason;
    }
    /**
     * Sets a new reason
     *
     * @param  string $reason
     */
    public function set_reason($reason): self
    {
        $this->reason = $reason;
        return $this;
    }
    /**
     * Gets as categoryTradeTax
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradeTaxType
     */
    public function get_category_trade_tax()
    {
        return $this->category_trade_tax;
    }
    /**
     * Sets a new categoryTradeTax
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\TradeTaxType $categoryTradeTax
     */
    public function set_category_trade_tax(?\horstoeko\zugferd\entities\basic\ram\Trade_Tax_Type $category_trade_tax = null): self
    {
        $this->category_trade_tax = $category_trade_tax;
        return $this;
    }
}