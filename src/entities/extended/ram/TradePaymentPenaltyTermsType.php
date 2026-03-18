<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradePaymentPenaltyTermsType
 *
 * XSD Type: TradePaymentPenaltyTermsType
 */
class TradePaymentPenaltyTermsType
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
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $actualPenaltyAmount
     */
    private $actualPenaltyAmount;

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
     * Gets as actualPenaltyAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getActualPenaltyAmount()
    {
        return $this->actualPenaltyAmount;
    }

    /**
     * Sets a new actualPenaltyAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $actualPenaltyAmount
     */
    public function setActualPenaltyAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $actualPenaltyAmount = null): self
    {
        $this->actualPenaltyAmount = $actualPenaltyAmount;
        return $this;
    }
}
