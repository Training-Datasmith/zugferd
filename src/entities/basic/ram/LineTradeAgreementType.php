<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing LineTradeAgreementType
 *
 * XSD Type: LineTradeAgreementType
 */
class Line_Trade_Agreement_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradePriceType $grossPriceProductTradePrice
     */
    private $gross_price_product_trade_price;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradePriceType $netPriceProductTradePrice
     */
    private $net_price_product_trade_price;
    /**
     * Gets as grossPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradePriceType
     */
    public function get_gross_price_product_trade_price()
    {
        return $this->gross_price_product_trade_price;
    }
    /**
     * Sets a new grossPriceProductTradePrice
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\TradePriceType $grossPriceProductTradePrice
     */
    public function set_gross_price_product_trade_price(?\horstoeko\zugferd\entities\basic\ram\Trade_Price_Type $gross_price_product_trade_price = null): self
    {
        $this->gross_price_product_trade_price = $gross_price_product_trade_price;
        return $this;
    }
    /**
     * Gets as netPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradePriceType
     */
    public function get_net_price_product_trade_price()
    {
        return $this->net_price_product_trade_price;
    }
    /**
     * Sets a new netPriceProductTradePrice
     */
    public function set_net_price_product_trade_price(\horstoeko\zugferd\entities\basic\ram\Trade_Price_Type $net_price_product_trade_price): self
    {
        $this->net_price_product_trade_price = $net_price_product_trade_price;
        return $this;
    }
}