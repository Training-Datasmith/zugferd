<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeSettlementLineMonetarySummationType
 *
 * XSD Type: TradeSettlementLineMonetarySummationType
 */
class TradeSettlementLineMonetarySummationType
{

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\AmountType $lineTotalAmount
     */
    private $lineTotalAmount;

    /**
     * Gets as lineTotalAmount
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\AmountType
     */
    public function getLineTotalAmount()
    {
        return $this->lineTotalAmount;
    }

    /**
     * Sets a new lineTotalAmount
     */
    public function setLineTotalAmount(\horstoeko\zugferd\entities\en16931\udt\AmountType $lineTotalAmount): self
    {
        $this->lineTotalAmount = $lineTotalAmount;
        return $this;
    }
}
