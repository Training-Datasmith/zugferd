<?php

namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing HeaderTradeSettlementType
 *
 * XSD Type: HeaderTradeSettlementType
 */
class HeaderTradeSettlementType
{

    /**
     * @var string $invoiceCurrencyCode
     */
    private $invoiceCurrencyCode;

    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\TradeSettlementHeaderMonetarySummationType $specifiedTradeSettlementHeaderMonetarySummation
     */
    private $specifiedTradeSettlementHeaderMonetarySummation;

    /**
     * Gets as invoiceCurrencyCode
     *
     * @return string
     */
    public function getInvoiceCurrencyCode()
    {
        return $this->invoiceCurrencyCode;
    }

    /**
     * Sets a new invoiceCurrencyCode
     *
     * @param  string $invoiceCurrencyCode
     */
    public function setInvoiceCurrencyCode($invoiceCurrencyCode): self
    {
        $this->invoiceCurrencyCode = $invoiceCurrencyCode;
        return $this;
    }

    /**
     * Gets as specifiedTradeSettlementHeaderMonetarySummation
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\TradeSettlementHeaderMonetarySummationType
     */
    public function getSpecifiedTradeSettlementHeaderMonetarySummation()
    {
        return $this->specifiedTradeSettlementHeaderMonetarySummation;
    }

    /**
     * Sets a new specifiedTradeSettlementHeaderMonetarySummation
     */
    public function setSpecifiedTradeSettlementHeaderMonetarySummation(\horstoeko\zugferd\entities\minimum\ram\TradeSettlementHeaderMonetarySummationType $specifiedTradeSettlementHeaderMonetarySummation): self
    {
        $this->specifiedTradeSettlementHeaderMonetarySummation = $specifiedTradeSettlementHeaderMonetarySummation;
        return $this;
    }
}
