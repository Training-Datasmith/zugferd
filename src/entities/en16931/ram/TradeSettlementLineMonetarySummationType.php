<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeSettlementLineMonetarySummationType
 *
 * XSD Type: TradeSettlementLineMonetarySummationType
 */
class Trade_Settlement_Line_Monetary_Summation_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $lineTotalAmount
     */
    private $line_total_amount;
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
}