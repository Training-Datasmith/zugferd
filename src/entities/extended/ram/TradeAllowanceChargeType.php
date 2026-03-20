<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeAllowanceChargeType
 *
 * XSD Type: TradeAllowanceChargeType
 */
class Trade_Allowance_Charge_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IndicatorType $chargeIndicator
     */
    private $charge_indicator;
    /**
     * @var float $sequenceNumeric
     */
    private $sequence_numeric;
    /**
     * @var float $calculationPercent
     */
    private $calculation_percent;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $basisAmount
     */
    private $basis_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\QuantityType $basisQuantity
     */
    private $basis_quantity;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $actualAmount
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
     * @var \horstoeko\zugferd\entities\extended\ram\TradeTaxType $categoryTradeTax
     */
    private $category_trade_tax;
    /**
     * Gets as chargeIndicator
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IndicatorType
     */
    public function get_charge_indicator()
    {
        return $this->charge_indicator;
    }
    /**
     * Sets a new chargeIndicator
     */
    public function set_charge_indicator(\horstoeko\zugferd\entities\extended\udt\Indicator_Type $charge_indicator): self
    {
        $this->charge_indicator = $charge_indicator;
        return $this;
    }
    /**
     * Gets as sequenceNumeric
     *
     * @return float
     */
    public function get_sequence_numeric()
    {
        return $this->sequence_numeric;
    }
    /**
     * Sets a new sequenceNumeric
     *
     * @param  float $sequenceNumeric
     */
    public function set_sequence_numeric($sequence_numeric): self
    {
        $this->sequence_numeric = $sequence_numeric;
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
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_basis_amount()
    {
        return $this->basis_amount;
    }
    /**
     * Sets a new basisAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $basisAmount
     */
    public function set_basis_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $basis_amount = null): self
    {
        $this->basis_amount = $basis_amount;
        return $this;
    }
    /**
     * Gets as basisQuantity
     *
     * @return \horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function get_basis_quantity()
    {
        return $this->basis_quantity;
    }
    /**
     * Sets a new basisQuantity
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\QuantityType $basisQuantity
     */
    public function set_basis_quantity(?\horstoeko\zugferd\entities\extended\udt\Quantity_Type $basis_quantity = null): self
    {
        $this->basis_quantity = $basis_quantity;
        return $this;
    }
    /**
     * Gets as actualAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_actual_amount()
    {
        return $this->actual_amount;
    }
    /**
     * Sets a new actualAmount
     */
    public function set_actual_amount(\horstoeko\zugferd\entities\extended\udt\Amount_Type $actual_amount): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\TradeTaxType
     */
    public function get_category_trade_tax()
    {
        return $this->category_trade_tax;
    }
    /**
     * Sets a new categoryTradeTax
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeTaxType $categoryTradeTax
     */
    public function set_category_trade_tax(?\horstoeko\zugferd\entities\extended\ram\Trade_Tax_Type $category_trade_tax = null): self
    {
        $this->category_trade_tax = $category_trade_tax;
        return $this;
    }
}