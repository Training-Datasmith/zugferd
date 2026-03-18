<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeTaxType
 *
 * XSD Type: TradeTaxType
 */
class TradeTaxType
{

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $calculatedAmount
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
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $basisAmount
     */
    private $basisAmount;

    /**
     * @var string $categoryCode
     */
    private $categoryCode;

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\CodeType $exemptionReasonCode
     */
    private $exemptionReasonCode;

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\DateType $taxPointDate
     */
    private $taxPointDate;

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
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function getCalculatedAmount()
    {
        return $this->calculatedAmount;
    }

    /**
     * Sets a new calculatedAmount
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\AmountType $calculatedAmount
     */
    public function setCalculatedAmount(?\horstoeko\zugferd\entities\en16931\udt\AmountType $calculatedAmount = null): self
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
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function getBasisAmount()
    {
        return $this->basisAmount;
    }

    /**
     * Sets a new basisAmount
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\AmountType $basisAmount
     */
    public function setBasisAmount(?\horstoeko\zugferd\entities\en16931\udt\AmountType $basisAmount = null): self
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
     * @return \horstoeko\zugferd\entities\en16931\udt\CodeType
     */
    public function getExemptionReasonCode()
    {
        return $this->exemptionReasonCode;
    }

    /**
     * Sets a new exemptionReasonCode
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\CodeType $exemptionReasonCode
     */
    public function setExemptionReasonCode(?\horstoeko\zugferd\entities\en16931\udt\CodeType $exemptionReasonCode = null): self
    {
        $this->exemptionReasonCode = $exemptionReasonCode;
        return $this;
    }

    /**
     * Gets as taxPointDate
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\DateType
     */
    public function getTaxPointDate()
    {
        return $this->taxPointDate;
    }

    /**
     * Sets a new taxPointDate
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\DateType $taxPointDate
     */
    public function setTaxPointDate(?\horstoeko\zugferd\entities\en16931\udt\DateType $taxPointDate = null): self
    {
        $this->taxPointDate = $taxPointDate;
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
