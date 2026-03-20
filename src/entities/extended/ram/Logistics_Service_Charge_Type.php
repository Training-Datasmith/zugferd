<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LogisticsServiceChargeType
 *
 * XSD Type: LogisticsServiceChargeType
 */
class Logistics_Service_Charge_Type
{
    /**
     * @var string $description
     */
    private $description;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $appliedAmount
     */
    private $applied_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $appliedTradeTax
     */
    private $applied_trade_tax = [];
    /**
     * Gets as description
     *
     * @return string
     */
    public function get_description()
    {
        return $this->description;
    }
    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function set_description($description): self
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Gets as appliedAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_applied_amount()
    {
        return $this->applied_amount;
    }
    /**
     * Sets a new appliedAmount
     */
    public function set_applied_amount(\horstoeko\zugferd\entities\extended\udt\Amount_Type $applied_amount): self
    {
        $this->applied_amount = $applied_amount;
        return $this;
    }
    /**
     * Adds as appliedTradeTax
     */
    public function add_to_applied_trade_tax(\horstoeko\zugferd\entities\extended\ram\Trade_Tax_Type $applied_trade_tax): self
    {
        $this->applied_trade_tax[] = $applied_trade_tax;
        return $this;
    }
    /**
     * isset appliedTradeTax
     *
     * @param  int|string $index
     */
    public function isset_applied_trade_tax($index): bool
    {
        return isset($this->applied_trade_tax[$index]);
    }
    /**
     * unset appliedTradeTax
     *
     * @param  int|string $index
     */
    public function unset_applied_trade_tax($index): void
    {
        unset($this->applied_trade_tax[$index]);
    }
    /**
     * Gets as appliedTradeTax
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeTaxType[]
     */
    public function get_applied_trade_tax()
    {
        return $this->applied_trade_tax;
    }
    /**
     * Sets a new appliedTradeTax
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $appliedTradeTax
     */
    public function set_applied_trade_tax(array $applied_trade_tax): self
    {
        $this->applied_trade_tax = $applied_trade_tax;
        return $this;
    }
}