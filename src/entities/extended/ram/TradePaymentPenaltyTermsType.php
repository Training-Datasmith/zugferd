<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradePaymentPenaltyTermsType
 *
 * XSD Type: TradePaymentPenaltyTermsType
 */
class Trade_Payment_Penalty_Terms_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $basisDateTime
     */
    private $basis_date_time;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\MeasureType $basisPeriodMeasure
     */
    private $basis_period_measure;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $basisAmount
     */
    private $basis_amount;
    /**
     * @var float $calculationPercent
     */
    private $calculation_percent;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $actualPenaltyAmount
     */
    private $actual_penalty_amount;
    /**
     * Gets as basisDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function get_basis_date_time()
    {
        return $this->basis_date_time;
    }
    /**
     * Sets a new basisDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $basisDateTime
     */
    public function set_basis_date_time(?\horstoeko\zugferd\entities\extended\udt\Date_Time_Type $basis_date_time = null): self
    {
        $this->basis_date_time = $basis_date_time;
        return $this;
    }
    /**
     * Gets as basisPeriodMeasure
     *
     * @return \horstoeko\zugferd\entities\extended\udt\MeasureType
     */
    public function get_basis_period_measure()
    {
        return $this->basis_period_measure;
    }
    /**
     * Sets a new basisPeriodMeasure
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\MeasureType $basisPeriodMeasure
     */
    public function set_basis_period_measure(?\horstoeko\zugferd\entities\extended\udt\Measure_Type $basis_period_measure = null): self
    {
        $this->basis_period_measure = $basis_period_measure;
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
     * Gets as actualPenaltyAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_actual_penalty_amount()
    {
        return $this->actual_penalty_amount;
    }
    /**
     * Sets a new actualPenaltyAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $actualPenaltyAmount
     */
    public function set_actual_penalty_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $actual_penalty_amount = null): self
    {
        $this->actual_penalty_amount = $actual_penalty_amount;
        return $this;
    }
}