<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeCurrencyExchangeType
 *
 * XSD Type: TradeCurrencyExchangeType
 */
class Trade_Currency_Exchange_Type
{
    /**
     * @var string $sourceCurrencyCode
     */
    private $source_currency_code;
    /**
     * @var string $targetCurrencyCode
     */
    private $target_currency_code;
    /**
     * @var float $conversionRate
     */
    private $conversion_rate;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $conversionRateDateTime
     */
    private $conversion_rate_date_time;
    /**
     * Gets as sourceCurrencyCode
     *
     * @return string
     */
    public function get_source_currency_code()
    {
        return $this->source_currency_code;
    }
    /**
     * Sets a new sourceCurrencyCode
     *
     * @param  string $sourceCurrencyCode
     */
    public function set_source_currency_code($source_currency_code): self
    {
        $this->source_currency_code = $source_currency_code;
        return $this;
    }
    /**
     * Gets as targetCurrencyCode
     *
     * @return string
     */
    public function get_target_currency_code()
    {
        return $this->target_currency_code;
    }
    /**
     * Sets a new targetCurrencyCode
     *
     * @param  string $targetCurrencyCode
     */
    public function set_target_currency_code($target_currency_code): self
    {
        $this->target_currency_code = $target_currency_code;
        return $this;
    }
    /**
     * Gets as conversionRate
     *
     * @return float
     */
    public function get_conversion_rate()
    {
        return $this->conversion_rate;
    }
    /**
     * Sets a new conversionRate
     *
     * @param  float $conversionRate
     */
    public function set_conversion_rate($conversion_rate): self
    {
        $this->conversion_rate = $conversion_rate;
        return $this;
    }
    /**
     * Gets as conversionRateDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function get_conversion_rate_date_time()
    {
        return $this->conversion_rate_date_time;
    }
    /**
     * Sets a new conversionRateDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $conversionRateDateTime
     */
    public function set_conversion_rate_date_time(?\horstoeko\zugferd\entities\extended\udt\Date_Time_Type $conversion_rate_date_time = null): self
    {
        $this->conversion_rate_date_time = $conversion_rate_date_time;
        return $this;
    }
}