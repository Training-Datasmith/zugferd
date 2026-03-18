<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradePriceType
 *
 * XSD Type: TradePriceType
 */
class TradePriceType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $chargeAmount
     */
    private $chargeAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\QuantityType $basisQuantity
     */
    private $basisQuantity;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $appliedTradeAllowanceCharge
     */
    private $appliedTradeAllowanceCharge = [

    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeTaxType $includedTradeTax
     */
    private $includedTradeTax;

    /**
     * Gets as chargeAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getChargeAmount()
    {
        return $this->chargeAmount;
    }

    /**
     * Sets a new chargeAmount
     */
    public function setChargeAmount(\horstoeko\zugferd\entities\extended\udt\AmountType $chargeAmount): self
    {
        $this->chargeAmount = $chargeAmount;
        return $this;
    }

    /**
     * Gets as basisQuantity
     *
     * @return \horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function getBasisQuantity()
    {
        return $this->basisQuantity;
    }

    /**
     * Sets a new basisQuantity
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\QuantityType $basisQuantity
     */
    public function setBasisQuantity(?\horstoeko\zugferd\entities\extended\udt\QuantityType $basisQuantity = null): self
    {
        $this->basisQuantity = $basisQuantity;
        return $this;
    }

    /**
     * Adds as appliedTradeAllowanceCharge
     */
    public function addToAppliedTradeAllowanceCharge(\horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType $appliedTradeAllowanceCharge): self
    {
        $this->appliedTradeAllowanceCharge[] = $appliedTradeAllowanceCharge;
        return $this;
    }

    /**
     * isset appliedTradeAllowanceCharge
     *
     * @param  int|string $index
     */
    public function issetAppliedTradeAllowanceCharge($index): bool
    {
        return isset($this->appliedTradeAllowanceCharge[$index]);
    }

    /**
     * unset appliedTradeAllowanceCharge
     *
     * @param  int|string $index
     */
    public function unsetAppliedTradeAllowanceCharge($index): void
    {
        unset($this->appliedTradeAllowanceCharge[$index]);
    }

    /**
     * Gets as appliedTradeAllowanceCharge
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[]
     */
    public function getAppliedTradeAllowanceCharge()
    {
        return $this->appliedTradeAllowanceCharge;
    }

    /**
     * Sets a new appliedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $appliedTradeAllowanceCharge
     */
    public function setAppliedTradeAllowanceCharge(?array $appliedTradeAllowanceCharge = null): self
    {
        $this->appliedTradeAllowanceCharge = $appliedTradeAllowanceCharge;
        return $this;
    }

    /**
     * Gets as includedTradeTax
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeTaxType
     */
    public function getIncludedTradeTax()
    {
        return $this->includedTradeTax;
    }

    /**
     * Sets a new includedTradeTax
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeTaxType $includedTradeTax
     */
    public function setIncludedTradeTax(?\horstoeko\zugferd\entities\extended\ram\TradeTaxType $includedTradeTax = null): self
    {
        $this->includedTradeTax = $includedTradeTax;
        return $this;
    }
}
