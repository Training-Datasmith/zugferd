<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing TradeSettlementHeaderMonetarySummationType
 *
 * XSD Type: TradeSettlementHeaderMonetarySummationType
 */
class Trade_Settlement_Header_Monetary_Summation_Type
{
    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\AmountType $taxBasisTotalAmount
     */
    private $tax_basis_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\AmountType[] $taxTotalAmount
     */
    private $tax_total_amount = [];
    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\AmountType $grandTotalAmount
     */
    private $grand_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\AmountType $duePayableAmount
     */
    private $due_payable_amount;
    /**
     * Gets as taxBasisTotalAmount
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\AmountType
     */
    public function get_tax_basis_total_amount()
    {
        return $this->tax_basis_total_amount;
    }
    /**
     * Sets a new taxBasisTotalAmount
     */
    public function set_tax_basis_total_amount(\horstoeko\zugferd\entities\minimum\udt\Amount_Type $tax_basis_total_amount): self
    {
        $this->tax_basis_total_amount = $tax_basis_total_amount;
        return $this;
    }
    /**
     * Adds as taxTotalAmount
     */
    public function add_to_tax_total_amount(\horstoeko\zugferd\entities\minimum\udt\Amount_Type $tax_total_amount): self
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
     * @return \horstoeko\zugferd\entities\minimum\udt\AmountType[]
     */
    public function get_tax_total_amount()
    {
        return $this->tax_total_amount;
    }
    /**
     * Sets a new taxTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\minimum\udt\AmountType[] $taxTotalAmount
     */
    public function set_tax_total_amount(?array $tax_total_amount = null): self
    {
        $this->tax_total_amount = $tax_total_amount;
        return $this;
    }
    /**
     * Gets as grandTotalAmount
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\AmountType
     */
    public function get_grand_total_amount()
    {
        return $this->grand_total_amount;
    }
    /**
     * Sets a new grandTotalAmount
     */
    public function set_grand_total_amount(\horstoeko\zugferd\entities\minimum\udt\Amount_Type $grand_total_amount): self
    {
        $this->grand_total_amount = $grand_total_amount;
        return $this;
    }
    /**
     * Gets as duePayableAmount
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\AmountType
     */
    public function get_due_payable_amount()
    {
        return $this->due_payable_amount;
    }
    /**
     * Sets a new duePayableAmount
     */
    public function set_due_payable_amount(\horstoeko\zugferd\entities\minimum\udt\Amount_Type $due_payable_amount): self
    {
        $this->due_payable_amount = $due_payable_amount;
        return $this;
    }
}