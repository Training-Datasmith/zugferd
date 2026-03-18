<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradePaymentDiscountTermsType
 *
 * XSD Type: TradePaymentDiscountTermsType
 */
class TradePaymentDiscountTermsType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $basisDateTime
     */
    private $basisDateTime;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\MeasureType $basisPeriodMeasure
     */
    private $basisPeriodMeasure;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $basisAmount
     */
    private $basisAmount;

    /**
     * @var float $calculationPercent
     */
    private $calculationPercent;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $actualDiscountAmount
     */
    private $actualDiscountAmount;

    /**
     * Gets as basisDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getBasisDateTime()
    {
        return $this->basisDateTime;
    }

    /**
     * Sets a new basisDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $basisDateTime
     */
    public function setBasisDateTime(?\horstoeko\zugferd\entities\extended\udt\DateTimeType $basisDateTime = null): self
    {
        $this->basisDateTime = $basisDateTime;
        return $this;
    }

    /**
     * Gets as basisPeriodMeasure
     *
     * @return \horstoeko\zugferd\entities\extended\udt\MeasureType
     */
    public function getBasisPeriodMeasure()
    {
        return $this->basisPeriodMeasure;
    }

    /**
     * Sets a new basisPeriodMeasure
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\MeasureType $basisPeriodMeasure
     */
    public function setBasisPeriodMeasure(?\horstoeko\zugferd\entities\extended\udt\MeasureType $basisPeriodMeasure = null): self
    {
        $this->basisPeriodMeasure = $basisPeriodMeasure;
        return $this;
    }

    /**
     * Gets as basisAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getBasisAmount()
    {
        return $this->basisAmount;
    }

    /**
     * Sets a new basisAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $basisAmount
     */
    public function setBasisAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $basisAmount = null): self
    {
        $this->basisAmount = $basisAmount;
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
     * Gets as actualDiscountAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getActualDiscountAmount()
    {
        return $this->actualDiscountAmount;
    }

    /**
     * Sets a new actualDiscountAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $actualDiscountAmount
     */
    public function setActualDiscountAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $actualDiscountAmount = null): self
    {
        $this->actualDiscountAmount = $actualDiscountAmount;
        return $this;
    }
}
