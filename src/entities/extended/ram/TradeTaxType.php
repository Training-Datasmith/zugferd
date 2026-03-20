<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeTaxType
 *
 * XSD Type: TradeTaxType
 */
class Trade_Tax_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $calculatedAmount
     */
    private $calculated_amount;
    /**
     * @var string $typeCode
     */
    private $type_code;
    /**
     * @var string $exemptionReason
     */
    private $exemption_reason;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $basisAmount
     */
    private $basis_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $lineTotalBasisAmount
     */
    private $line_total_basis_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $allowanceChargeBasisAmount
     */
    private $allowance_charge_basis_amount;
    /**
     * @var string $categoryCode
     */
    private $category_code;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $exemptionReasonCode
     */
    private $exemption_reason_code;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateType $taxPointDate
     */
    private $tax_point_date;
    /**
     * @var string $dueDateTypeCode
     */
    private $due_date_type_code;
    /**
     * @var float $rateApplicablePercent
     */
    private $rate_applicable_percent;
    /**
     * Gets as calculatedAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_calculated_amount()
    {
        return $this->calculated_amount;
    }
    /**
     * Sets a new calculatedAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $calculatedAmount
     */
    public function set_calculated_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $calculated_amount = null): self
    {
        $this->calculated_amount = $calculated_amount;
        return $this;
    }
    /**
     * Gets as typeCode
     *
     * @return string
     */
    public function get_type_code()
    {
        return $this->type_code;
    }
    /**
     * Sets a new typeCode
     *
     * @param  string $typeCode
     */
    public function set_type_code($type_code): self
    {
        $this->type_code = $type_code;
        return $this;
    }
    /**
     * Gets as exemptionReason
     *
     * @return string
     */
    public function get_exemption_reason()
    {
        return $this->exemption_reason;
    }
    /**
     * Sets a new exemptionReason
     *
     * @param  string $exemptionReason
     */
    public function set_exemption_reason($exemption_reason): self
    {
        $this->exemption_reason = $exemption_reason;
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
     * Gets as lineTotalBasisAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_line_total_basis_amount()
    {
        return $this->line_total_basis_amount;
    }
    /**
     * Sets a new lineTotalBasisAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $lineTotalBasisAmount
     */
    public function set_line_total_basis_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $line_total_basis_amount = null): self
    {
        $this->line_total_basis_amount = $line_total_basis_amount;
        return $this;
    }
    /**
     * Gets as allowanceChargeBasisAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_allowance_charge_basis_amount()
    {
        return $this->allowance_charge_basis_amount;
    }
    /**
     * Sets a new allowanceChargeBasisAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $allowanceChargeBasisAmount
     */
    public function set_allowance_charge_basis_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $allowance_charge_basis_amount = null): self
    {
        $this->allowance_charge_basis_amount = $allowance_charge_basis_amount;
        return $this;
    }
    /**
     * Gets as categoryCode
     *
     * @return string
     */
    public function get_category_code()
    {
        return $this->category_code;
    }
    /**
     * Sets a new categoryCode
     *
     * @param  string $categoryCode
     */
    public function set_category_code($category_code): self
    {
        $this->category_code = $category_code;
        return $this;
    }
    /**
     * Gets as exemptionReasonCode
     *
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function get_exemption_reason_code()
    {
        return $this->exemption_reason_code;
    }
    /**
     * Sets a new exemptionReasonCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $exemptionReasonCode
     */
    public function set_exemption_reason_code(?\horstoeko\zugferd\entities\extended\udt\Code_Type $exemption_reason_code = null): self
    {
        $this->exemption_reason_code = $exemption_reason_code;
        return $this;
    }
    /**
     * Gets as taxPointDate
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateType
     */
    public function get_tax_point_date()
    {
        return $this->tax_point_date;
    }
    /**
     * Sets a new taxPointDate
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateType $taxPointDate
     */
    public function set_tax_point_date(?\horstoeko\zugferd\entities\extended\udt\Date_Type $tax_point_date = null): self
    {
        $this->tax_point_date = $tax_point_date;
        return $this;
    }
    /**
     * Gets as dueDateTypeCode
     *
     * @return string
     */
    public function get_due_date_type_code()
    {
        return $this->due_date_type_code;
    }
    /**
     * Sets a new dueDateTypeCode
     *
     * @param  string $dueDateTypeCode
     */
    public function set_due_date_type_code($due_date_type_code): self
    {
        $this->due_date_type_code = $due_date_type_code;
        return $this;
    }
    /**
     * Gets as rateApplicablePercent
     *
     * @return float
     */
    public function get_rate_applicable_percent()
    {
        return $this->rate_applicable_percent;
    }
    /**
     * Sets a new rateApplicablePercent
     *
     * @param  float $rateApplicablePercent
     */
    public function set_rate_applicable_percent($rate_applicable_percent): self
    {
        $this->rate_applicable_percent = $rate_applicable_percent;
        return $this;
    }
}