<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing TradeAllowanceChargeType
 *
 * XSD Type: TradeAllowanceChargeType
 */
class TradeAllowanceChargeType
{
    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\IndicatorType $chargeIndicator
     */
    private $chargeIndicator;

    /**
     * @var float $calculationPercent
     */
    private $calculationPercent;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\AmountType $basisAmount
     */
    private $basisAmount;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\AmountType $actualAmount
     */
    private $actualAmount;

    /**
     * @var string $reasonCode
     */
    private $reasonCode;

    /**
     * @var string $reason
     */
    private $reason;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\TradeTaxType $categoryTradeTax
     */
    private $categoryTradeTax;

    /**
     * Gets as chargeIndicator
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\IndicatorType
     */
    public function getChargeIndicator()
    {
        return $this->chargeIndicator;
    }

    /**
     * Sets a new chargeIndicator
     */
    public function setChargeIndicator(\horstoeko\zugferd\entities\basicwl\udt\IndicatorType $chargeIndicator): self
    {
        $this->chargeIndicator = $chargeIndicator;
        return $this;
    }

    /**
     * Gets as calculationPercent
     *
     * @return float
     */
    public function getCalculationPercent()
    {
        return $this->calculationPercent;
    }

    /**
     * Sets a new calculationPercent
     *
     * @param  float $calculationPercent
     */
    public function setCalculationPercent($calculationPercent): self
    {
        $this->calculationPercent = $calculationPercent;
        return $this;
    }

    /**
     * Gets as basisAmount
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\AmountType
     */
    public function getBasisAmount()
    {
        return $this->basisAmount;
    }

    /**
     * Sets a new basisAmount
     *
     * @param  \horstoeko\zugferd\entities\basicwl\udt\AmountType $basisAmount
     */
    public function setBasisAmount(?\horstoeko\zugferd\entities\basicwl\udt\AmountType $basisAmount = null): self
    {
        $this->basisAmount = $basisAmount;
        return $this;
    }

    /**
     * Gets as actualAmount
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\AmountType
     */
    public function getActualAmount()
    {
        return $this->actualAmount;
    }

    /**
     * Sets a new actualAmount
     */
    public function setActualAmount(\horstoeko\zugferd\entities\basicwl\udt\AmountType $actualAmount): self
    {
        $this->actualAmount = $actualAmount;
        return $this;
    }

    /**
     * Gets as reasonCode
     *
     * @return string
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * Sets a new reasonCode
     *
     * @param  string $reasonCode
     */
    public function setReasonCode($reasonCode): self
    {
        $this->reasonCode = $reasonCode;
        return $this;
    }

    /**
     * Gets as reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Sets a new reason
     *
     * @param  string $reason
     */
    public function setReason($reason): self
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * Gets as categoryTradeTax
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\TradeTaxType
     */
    public function getCategoryTradeTax()
    {
        return $this->categoryTradeTax;
    }

    /**
     * Sets a new categoryTradeTax
     */
    public function setCategoryTradeTax(\horstoeko\zugferd\entities\basicwl\ram\TradeTaxType $categoryTradeTax): self
    {
        $this->categoryTradeTax = $categoryTradeTax;
        return $this;
    }
}
