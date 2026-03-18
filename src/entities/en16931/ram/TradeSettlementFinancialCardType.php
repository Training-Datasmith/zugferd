<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeSettlementFinancialCardType
 *
 * XSD Type: TradeSettlementFinancialCardType
 */
class TradeSettlementFinancialCardType
{

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $iD
     */
    private $iD;

    /**
     * @var string $cardholderName
     */
    private $cardholderName;

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     */
    public function setID(\horstoeko\zugferd\entities\en16931\udt\IDType $iD): self
    {
        $this->iD = $iD;
        return $this;
    }

    /**
     * Gets as cardholderName
     *
     * @return string
     */
    public function getCardholderName()
    {
        return $this->cardholderName;
    }

    /**
     * Sets a new cardholderName
     *
     * @param  string $cardholderName
     */
    public function setCardholderName($cardholderName): self
    {
        $this->cardholderName = $cardholderName;
        return $this;
    }
}
