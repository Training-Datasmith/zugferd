<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeSettlementFinancialCardType
 *
 * XSD Type: TradeSettlementFinancialCardType
 */
class Trade_Settlement_Financial_Card_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $i_d;
    /**
     * @var string $cardholderName
     */
    private $cardholder_name;
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     */
    public function set_id(\horstoeko\zugferd\entities\extended\udt\Id_Type $i_d): self
    {
        $this->i_d = $i_d;
        return $this;
    }
    /**
     * Gets as cardholderName
     *
     * @return string
     */
    public function get_cardholder_name()
    {
        return $this->cardholder_name;
    }
    /**
     * Sets a new cardholderName
     *
     * @param  string $cardholderName
     */
    public function set_cardholder_name($cardholder_name): self
    {
        $this->cardholder_name = $cardholder_name;
        return $this;
    }
}