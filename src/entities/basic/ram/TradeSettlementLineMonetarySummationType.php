<?php

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing TradeSettlementLineMonetarySummationType
 *
 * XSD Type: TradeSettlementLineMonetarySummationType
 */
class TradeSettlementLineMonetarySummationType
{

    /**
     * @var \horstoeko\zugferd\entities\basic\udt\AmountType $lineTotalAmount
     */
    private $lineTotalAmount;

    /**
     * Gets as lineTotalAmount
     *
     * @return \horstoeko\zugferd\entities\basic\udt\AmountType
     */
    public function getLineTotalAmount()
    {
        return $this->lineTotalAmount;
    }

    /**
     * Sets a new lineTotalAmount
     */
    public function setLineTotalAmount(\horstoeko\zugferd\entities\basic\udt\AmountType $lineTotalAmount): self
    {
        $this->lineTotalAmount = $lineTotalAmount;
        return $this;
    }
}
