<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradePriceType
 *
 * XSD Type: TradePriceType
 */
class Trade_Price_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $chargeAmount
     */
    private $charge_amount;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\QuantityType $basisQuantity
     */
    private $basis_quantity;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge
     */
    private $applied_trade_allowance_charge;
    /**
     * Gets as chargeAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function get_charge_amount()
    {
        return $this->charge_amount;
    }
    /**
     * Sets a new chargeAmount
     */
    public function set_charge_amount(\horstoeko\zugferd\entities\en16931\udt\Amount_Type $charge_amount): self
    {
        $this->charge_amount = $charge_amount;
        return $this;
    }
    /**
     * Gets as basisQuantity
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\QuantityType
     */
    public function get_basis_quantity()
    {
        return $this->basis_quantity;
    }
    /**
     * Sets a new basisQuantity
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\QuantityType $basisQuantity
     */
    public function set_basis_quantity(?\horstoeko\zugferd\entities\en16931\udt\Quantity_Type $basis_quantity = null): self
    {
        $this->basis_quantity = $basis_quantity;
        return $this;
    }
    /**
     * Gets as appliedTradeAllowanceCharge
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType
     */
    public function get_applied_trade_allowance_charge()
    {
        return $this->applied_trade_allowance_charge;
    }
    /**
     * Sets a new appliedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge
     */
    public function set_applied_trade_allowance_charge(?\horstoeko\zugferd\entities\en16931\ram\Trade_Allowance_Charge_Type $applied_trade_allowance_charge = null): self
    {
        $this->applied_trade_allowance_charge = $applied_trade_allowance_charge;
        return $this;
    }
}