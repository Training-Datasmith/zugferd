<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeSettlementHeaderMonetarySummationType
 *
 * XSD Type: TradeSettlementHeaderMonetarySummationType
 */
class Trade_Settlement_Header_Monetary_Summation_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $lineTotalAmount
     */
    private $line_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $chargeTotalAmount
     */
    private $charge_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $allowanceTotalAmount
     */
    private $allowance_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $taxBasisTotalAmount
     */
    private $tax_basis_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType[] $taxTotalAmount
     */
    private $tax_total_amount = [];
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $roundingAmount
     */
    private $rounding_amount;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $grandTotalAmount
     */
    private $grand_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $totalPrepaidAmount
     */
    private $total_prepaid_amount;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $duePayableAmount
     */
    private $due_payable_amount;
    /**
     * Gets as lineTotalAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function get_line_total_amount()
    {
        return $this->line_total_amount;
    }
    /**
     * Sets a new lineTotalAmount
     */
    public function set_line_total_amount(\horstoeko\zugferd\entities\en16931\udt\Amount_Type $line_total_amount): self
    {
        $this->line_total_amount = $line_total_amount;
        return $this;
    }
    /**
     * Gets as chargeTotalAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function get_charge_total_amount()
    {
        return $this->charge_total_amount;
    }
    /**
     * Sets a new chargeTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\AmountType $chargeTotalAmount
     */
    public function set_charge_total_amount(?\horstoeko\zugferd\entities\en16931\udt\Amount_Type $charge_total_amount = null): self
    {
        $this->charge_total_amount = $charge_total_amount;
        return $this;
    }
    /**
     * Gets as allowanceTotalAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function get_allowance_total_amount()
    {
        return $this->allowance_total_amount;
    }
    /**
     * Sets a new allowanceTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\AmountType $allowanceTotalAmount
     */
    public function set_allowance_total_amount(?\horstoeko\zugferd\entities\en16931\udt\Amount_Type $allowance_total_amount = null): self
    {
        $this->allowance_total_amount = $allowance_total_amount;
        return $this;
    }
    /**
     * Gets as taxBasisTotalAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function get_tax_basis_total_amount()
    {
        return $this->tax_basis_total_amount;
    }
    /**
     * Sets a new taxBasisTotalAmount
     */
    public function set_tax_basis_total_amount(\horstoeko\zugferd\entities\en16931\udt\Amount_Type $tax_basis_total_amount): self
    {
        $this->tax_basis_total_amount = $tax_basis_total_amount;
        return $this;
    }
    /**
     * Adds as taxTotalAmount
     */
    public function add_to_tax_total_amount(\horstoeko\zugferd\entities\en16931\udt\Amount_Type $tax_total_amount): self
    {
        $this->tax_total_amount[] = $tax_total_amount;
        return $this;
    }
    /**
     * isset taxTotalAmount
     *
     * @param  int|string $index
     */
    public function isset_tax_total_amount($index): bool
    {
        return isset($this->tax_total_amount[$index]);
    }
    /**
     * unset taxTotalAmount
     *
     * @param  int|string $index
     */
    public function unset_tax_total_amount($index): void
    {
        unset($this->tax_total_amount[$index]);
    }
    /**
     * Gets as taxTotalAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType[]
     */
    public function get_tax_total_amount()
    {
        return $this->tax_total_amount;
    }
    /**
     * Sets a new taxTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\AmountType[] $taxTotalAmount
     */
    public function set_tax_total_amount(?array $tax_total_amount = null): self
    {
        $this->tax_total_amount = $tax_total_amount;
        return $this;
    }
    /**
     * Gets as roundingAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function get_rounding_amount()
    {
        return $this->rounding_amount;
    }
    /**
     * Sets a new roundingAmount
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\AmountType $roundingAmount
     */
    public function set_rounding_amount(?\horstoeko\zugferd\entities\en16931\udt\Amount_Type $rounding_amount = null): self
    {
        $this->rounding_amount = $rounding_amount;
        return $this;
    }
    /**
     * Gets as grandTotalAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function get_grand_total_amount()
    {
        return $this->grand_total_amount;
    }
    /**
     * Sets a new grandTotalAmount
     */
    public function set_grand_total_amount(\horstoeko\zugferd\entities\en16931\udt\Amount_Type $grand_total_amount): self
    {
        $this->grand_total_amount = $grand_total_amount;
        return $this;
    }
    /**
     * Gets as totalPrepaidAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function get_total_prepaid_amount()
    {
        return $this->total_prepaid_amount;
    }
    /**
     * Sets a new totalPrepaidAmount
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\AmountType $totalPrepaidAmount
     */
    public function set_total_prepaid_amount(?\horstoeko\zugferd\entities\en16931\udt\Amount_Type $total_prepaid_amount = null): self
    {
        $this->total_prepaid_amount = $total_prepaid_amount;
        return $this;
    }
    /**
     * Gets as duePayableAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function get_due_payable_amount()
    {
        return $this->due_payable_amount;
    }
    /**
     * Sets a new duePayableAmount
     */
    public function set_due_payable_amount(\horstoeko\zugferd\entities\en16931\udt\Amount_Type $due_payable_amount): self
    {
        $this->due_payable_amount = $due_payable_amount;
        return $this;
    }
}