<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeSettlementLineMonetarySummationType
 *
 * XSD Type: TradeSettlementLineMonetarySummationType
 */
class Trade_Settlement_Line_Monetary_Summation_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $lineTotalAmount
     */
    private $line_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $chargeTotalAmount
     */
    private $charge_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $allowanceTotalAmount
     */
    private $allowance_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $taxTotalAmount
     */
    private $tax_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $grandTotalAmount
     */
    private $grand_total_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $totalAllowanceChargeAmount
     */
    private $total_allowance_charge_amount;
    /**
     * Gets as lineTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_line_total_amount()
    {
        return $this->line_total_amount;
    }
    /**
     * Sets a new lineTotalAmount
     */
    public function set_line_total_amount(\horstoeko\zugferd\entities\extended\udt\Amount_Type $line_total_amount): self
    {
        $this->line_total_amount = $line_total_amount;
        return $this;
    }
    /**
     * Gets as chargeTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_charge_total_amount()
    {
        return $this->charge_total_amount;
    }
    /**
     * Sets a new chargeTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $chargeTotalAmount
     */
    public function set_charge_total_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $charge_total_amount = null): self
    {
        $this->charge_total_amount = $charge_total_amount;
        return $this;
    }
    /**
     * Gets as allowanceTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_allowance_total_amount()
    {
        return $this->allowance_total_amount;
    }
    /**
     * Sets a new allowanceTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $allowanceTotalAmount
     */
    public function set_allowance_total_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $allowance_total_amount = null): self
    {
        $this->allowance_total_amount = $allowance_total_amount;
        return $this;
    }
    /**
     * Gets as taxTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_tax_total_amount()
    {
        return $this->tax_total_amount;
    }
    /**
     * Sets a new taxTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $taxTotalAmount
     */
    public function set_tax_total_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $tax_total_amount = null): self
    {
        $this->tax_total_amount = $tax_total_amount;
        return $this;
    }
    /**
     * Gets as grandTotalAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_grand_total_amount()
    {
        return $this->grand_total_amount;
    }
    /**
     * Sets a new grandTotalAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $grandTotalAmount
     */
    public function set_grand_total_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $grand_total_amount = null): self
    {
        $this->grand_total_amount = $grand_total_amount;
        return $this;
    }
    /**
     * Gets as totalAllowanceChargeAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_total_allowance_charge_amount()
    {
        return $this->total_allowance_charge_amount;
    }
    /**
     * Sets a new totalAllowanceChargeAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $totalAllowanceChargeAmount
     */
    public function set_total_allowance_charge_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $total_allowance_charge_amount = null): self
    {
        $this->total_allowance_charge_amount = $total_allowance_charge_amount;
        return $this;
    }
}