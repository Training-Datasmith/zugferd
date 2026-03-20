<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradePriceType
 *
 * XSD Type: TradePriceType
 */
class Trade_Price_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $chargeAmount
     */
    private $charge_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\QuantityType $basisQuantity
     */
    private $basis_quantity;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $appliedTradeAllowanceCharge
     */
    private $applied_trade_allowance_charge = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeTaxType $includedTradeTax
     */
    private $included_trade_tax;
    /**
     * Gets as chargeAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_charge_amount()
    {
        return $this->charge_amount;
    }
    /**
     * Sets a new chargeAmount
     */
    public function set_charge_amount(\horstoeko\zugferd\entities\extended\udt\Amount_Type $charge_amount): self
    {
        $this->charge_amount = $charge_amount;
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
     * Adds as appliedTradeAllowanceCharge
     */
    public function add_to_applied_trade_allowance_charge(\horstoeko\zugferd\entities\extended\ram\Trade_Allowance_Charge_Type $applied_trade_allowance_charge): self
    {
        $this->applied_trade_allowance_charge[] = $applied_trade_allowance_charge;
        return $this;
    }
    /**
     * isset appliedTradeAllowanceCharge
     *
     * @param  int|string $index
     */
    public function isset_applied_trade_allowance_charge($index): bool
    {
        return isset($this->applied_trade_allowance_charge[$index]);
    }
    /**
     * unset appliedTradeAllowanceCharge
     *
     * @param  int|string $index
     */
    public function unset_applied_trade_allowance_charge($index): void
    {
        unset($this->applied_trade_allowance_charge[$index]);
    }
    /**
     * Gets as appliedTradeAllowanceCharge
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[]
     */
    public function get_applied_trade_allowance_charge()
    {
        return $this->applied_trade_allowance_charge;
    }
    /**
     * Sets a new appliedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $appliedTradeAllowanceCharge
     */
    public function set_applied_trade_allowance_charge(?array $applied_trade_allowance_charge = null): self
    {
        $this->applied_trade_allowance_charge = $applied_trade_allowance_charge;
        return $this;
    }
    /**
     * Gets as includedTradeTax
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeTaxType
     */
    public function get_included_trade_tax()
    {
        return $this->included_trade_tax;
    }
    /**
     * Sets a new includedTradeTax
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeTaxType $includedTradeTax
     */
    public function set_included_trade_tax(?\horstoeko\zugferd\entities\extended\ram\Trade_Tax_Type $included_trade_tax = null): self
    {
        $this->included_trade_tax = $included_trade_tax;
        return $this;
    }
}