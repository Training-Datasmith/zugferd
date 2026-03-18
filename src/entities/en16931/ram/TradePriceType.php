<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradePriceType
 *
 * XSD Type: TradePriceType
 */
class TradePriceType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $chargeAmount
     */
    private $chargeAmount;

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\QuantityType $basisQuantity
     */
    private $basisQuantity;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge
     */
    private $appliedTradeAllowanceCharge;

    /**
     * Gets as chargeAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function getChargeAmount()
    {
        return $this->chargeAmount;
    }

    /**
     * Sets a new chargeAmount
     */
    public function setChargeAmount(\horstoeko\zugferd\entities\en16931\udt\AmountType $chargeAmount): self
    {
        $this->chargeAmount = $chargeAmount;
        return $this;
    }

    /**
     * Gets as basisQuantity
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\QuantityType
     */
    public function getBasisQuantity()
    {
        return $this->basisQuantity;
    }

    /**
     * Sets a new basisQuantity
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\QuantityType $basisQuantity
     */
    public function setBasisQuantity(?\horstoeko\zugferd\entities\en16931\udt\QuantityType $basisQuantity = null): self
    {
        $this->basisQuantity = $basisQuantity;
        return $this;
    }

    /**
     * Gets as appliedTradeAllowanceCharge
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType
     */
    public function getAppliedTradeAllowanceCharge()
    {
        return $this->appliedTradeAllowanceCharge;
    }

    /**
     * Sets a new appliedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge
     */
    public function setAppliedTradeAllowanceCharge(?\horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge = null): self
    {
        $this->appliedTradeAllowanceCharge = $appliedTradeAllowanceCharge;
        return $this;
    }
}
