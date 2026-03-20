<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing LineTradeAgreementType
 *
 * XSD Type: LineTradeAgreementType
 */
class Line_Trade_Agreement_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyer_order_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePriceType $grossPriceProductTradePrice
     */
    private $gross_price_product_trade_price;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePriceType $netPriceProductTradePrice
     */
    private $net_price_product_trade_price;
    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function get_buyer_order_referenced_document()
    {
        return $this->buyer_order_referenced_document;
    }
    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    public function set_buyer_order_referenced_document(?\horstoeko\zugferd\entities\en16931\ram\Referenced_Document_Type $buyer_order_referenced_document = null): self
    {
        $this->buyer_order_referenced_document = $buyer_order_referenced_document;
        return $this;
    }
    /**
     * Gets as grossPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePriceType
     */
    public function get_gross_price_product_trade_price()
    {
        return $this->gross_price_product_trade_price;
    }
    /**
     * Sets a new grossPriceProductTradePrice
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradePriceType $grossPriceProductTradePrice
     */
    public function set_gross_price_product_trade_price(?\horstoeko\zugferd\entities\en16931\ram\Trade_Price_Type $gross_price_product_trade_price = null): self
    {
        $this->gross_price_product_trade_price = $gross_price_product_trade_price;
        return $this;
    }
    /**
     * Gets as netPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePriceType
     */
    public function get_net_price_product_trade_price()
    {
        return $this->net_price_product_trade_price;
    }
    /**
     * Sets a new netPriceProductTradePrice
     */
    public function set_net_price_product_trade_price(\horstoeko\zugferd\entities\en16931\ram\Trade_Price_Type $net_price_product_trade_price): self
    {
        $this->net_price_product_trade_price = $net_price_product_trade_price;
        return $this;
    }
}