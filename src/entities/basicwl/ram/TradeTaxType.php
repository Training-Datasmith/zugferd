<?php

namespace horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing TradeTaxType
 *
 * XSD Type: TradeTaxType
 */
class TradeTaxType
{

    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\AmountType $calculatedAmount
     */
    private $calculatedAmount;

    /**
     * @var string $typeCode
     */
    private $typeCode;

    /**
     * @var string $exemptionReason
     */
    private $exemptionReason;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\AmountType $basisAmount
     */
    private $basisAmount;

    /**
     * @var string $categoryCode
     */
    private $categoryCode;

    /**
     * @var string $exemptionReasonCode
     */
    private $exemptionReasonCode;

    /**
     * @var string $dueDateTypeCode
     */
    private $dueDateTypeCode;

    /**
     * @var float $rateApplicablePercent
     */
    private $rateApplicablePercent;

    /**
     * Gets as calculatedAmount
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\AmountType
     */
    public function getCalculatedAmount()
    {
        return $this->calculatedAmount;
    }

    /**
     * Sets a new calculatedAmount
     *
     * @param  \horstoeko\zugferd\entities\basicwl\udt\AmountType $calculatedAmount
     */
    public function setCalculatedAmount(?\horstoeko\zugferd\entities\basicwl\udt\AmountType $calculatedAmount = null): self
    {
        $this->calculatedAmount = $calculatedAmount;
        return $this;
    }

    /**
     * Gets as typeCode
     *
     * @return string
     */
    public function getTypeCode()
    {
        return $this->typeCode;
    }

    /**
     * Sets a new typeCode
     *
     * @param  string $typeCode
     */
    public function setTypeCode($typeCode): self
    {
        $this->typeCode = $typeCode;
        return $this;
    }

    /**
     * Gets as exemptionReason
     *
     * @return string
     */
    public function getExemptionReason()
    {
        return $this->exemptionReason;
    }

    /**
     * Sets a new exemptionReason
     *
     * @param  string $exemptionReason
     */
    public function setExemptionReason($exemptionReason): self
    {
        $this->exemptionReason = $exemptionReason;
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
     * Gets as categoryCode
     *
     * @return string
     */
    public function getCategoryCode()
    {
        return $this->categoryCode;
    }

    /**
     * Sets a new categoryCode
     *
     * @param  string $categoryCode
     */
    public function setCategoryCode($categoryCode): self
    {
        $this->categoryCode = $categoryCode;
        return $this;
    }

    /**
     * Gets as exemptionReasonCode
     *
     * @return string
     */
    public function getExemptionReasonCode()
    {
        return $this->exemptionReasonCode;
    }

    /**
     * Sets a new exemptionReasonCode
     *
     * @param  string $exemptionReasonCode
     */
    public function setExemptionReasonCode($exemptionReasonCode): self
    {
        $this->exemptionReasonCode = $exemptionReasonCode;
        return $this;
    }

    /**
     * Gets as dueDateTypeCode
     *
     * @return string
     */
    public function getDueDateTypeCode()
    {
        return $this->dueDateTypeCode;
    }

    /**
     * Sets a new dueDateTypeCode
     *
     * @param  string $dueDateTypeCode
     */
    public function setDueDateTypeCode($dueDateTypeCode): self
    {
        $this->dueDateTypeCode = $dueDateTypeCode;
        return $this;
    }

    /**
     * Gets as rateApplicablePercent
     *
     * @return float
     */
    public function getRateApplicablePercent()
    {
        return $this->rateApplicablePercent;
    }

    /**
     * Sets a new rateApplicablePercent
     *
     * @param  float $rateApplicablePercent
     */
    public function setRateApplicablePercent($rateApplicablePercent): self
    {
        $this->rateApplicablePercent = $rateApplicablePercent;
        return $this;
    }
}
