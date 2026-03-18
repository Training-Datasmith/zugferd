<?php

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing TradePriceType
 *
 * XSD Type: TradePriceType
 */
class TradePriceType
{

    /**
     * @var \horstoeko\zugferd\entities\basic\udt\AmountType $chargeAmount
     */
    private $chargeAmount;

    /**
     * @var \horstoeko\zugferd\entities\basic\udt\QuantityType $basisQuantity
     */
    private $basisQuantity;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge
     */
    private $appliedTradeAllowanceCharge;

    /**
     * Gets as chargeAmount
     *
     * @return \horstoeko\zugferd\entities\basic\udt\AmountType
     */
    public function getChargeAmount()
    {
        return $this->chargeAmount;
    }

    /**
     * Sets a new chargeAmount
     */
    public function setChargeAmount(\horstoeko\zugferd\entities\basic\udt\AmountType $chargeAmount): self
    {
        $this->chargeAmount = $chargeAmount;
        return $this;
    }

    /**
     * Gets as basisQuantity
     *
     * @return \horstoeko\zugferd\entities\basic\udt\QuantityType
     */
    public function getBasisQuantity()
    {
        return $this->basisQuantity;
    }

    /**
     * Sets a new basisQuantity
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\QuantityType $basisQuantity
     */
    public function setBasisQuantity(?\horstoeko\zugferd\entities\basic\udt\QuantityType $basisQuantity = null): self
    {
        $this->basisQuantity = $basisQuantity;
        return $this;
    }

    /**
     * Gets as appliedTradeAllowanceCharge
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradeAllowanceChargeType
     */
    public function getAppliedTradeAllowanceCharge()
    {
        return $this->appliedTradeAllowanceCharge;
    }

    /**
     * Sets a new appliedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge
     */
    public function setAppliedTradeAllowanceCharge(?\horstoeko\zugferd\entities\basic\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge = null): self
    {
        $this->appliedTradeAllowanceCharge = $appliedTradeAllowanceCharge;
        return $this;
    }
}
