<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing HeaderTradeSettlementType
 *
 * XSD Type: HeaderTradeSettlementType
 */
class Header_Trade_Settlement_Type
{
    /**
     * @var string $invoiceCurrencyCode
     */
    private $invoice_currency_code;
    /**
     * @var \horstoeko\zugferd\entities\minimum\ram\TradeSettlementHeaderMonetarySummationType $specifiedTradeSettlementHeaderMonetarySummation
     */
    private $specified_trade_settlement_header_monetary_summation;
    /**
     * Gets as invoiceCurrencyCode
     *
     * @return string
     */
    public function get_invoice_currency_code()
    {
        return $this->invoice_currency_code;
    }
    /**
     * Sets a new invoiceCurrencyCode
     *
     * @param  string $invoiceCurrencyCode
     */
    public function set_invoice_currency_code($invoice_currency_code): self
    {
        $this->invoice_currency_code = $invoice_currency_code;
        return $this;
    }
    /**
     * Gets as specifiedTradeSettlementHeaderMonetarySummation
     *
     * @return \horstoeko\zugferd\entities\minimum\ram\TradeSettlementHeaderMonetarySummationType
     */
    public function get_specified_trade_settlement_header_monetary_summation()
    {
        return $this->specified_trade_settlement_header_monetary_summation;
    }
    /**
     * Sets a new specifiedTradeSettlementHeaderMonetarySummation
     */
    public function set_specified_trade_settlement_header_monetary_summation(\horstoeko\zugferd\entities\minimum\ram\Trade_Settlement_Header_Monetary_Summation_Type $specified_trade_settlement_header_monetary_summation): self
    {
        $this->specified_trade_settlement_header_monetary_summation = $specified_trade_settlement_header_monetary_summation;
        return $this;
    }
}