<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeCurrencyExchangeType
 *
 * XSD Type: TradeCurrencyExchangeType
 */
class TradeCurrencyExchangeType
{

    /**
     * @var string $sourceCurrencyCode
     */
    private $sourceCurrencyCode;

    /**
     * @var string $targetCurrencyCode
     */
    private $targetCurrencyCode;

    /**
     * @var float $conversionRate
     */
    private $conversionRate;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $conversionRateDateTime
     */
    private $conversionRateDateTime;

    /**
     * Gets as sourceCurrencyCode
     *
     * @return string
     */
    public function getSourceCurrencyCode()
    {
        return $this->sourceCurrencyCode;
    }

    /**
     * Sets a new sourceCurrencyCode
     *
     * @param  string $sourceCurrencyCode
     */
    public function setSourceCurrencyCode($sourceCurrencyCode): self
    {
        $this->sourceCurrencyCode = $sourceCurrencyCode;
        return $this;
    }

    /**
     * Gets as targetCurrencyCode
     *
     * @return string
     */
    public function getTargetCurrencyCode()
    {
        return $this->targetCurrencyCode;
    }

    /**
     * Sets a new targetCurrencyCode
     *
     * @param  string $targetCurrencyCode
     */
    public function setTargetCurrencyCode($targetCurrencyCode): self
    {
        $this->targetCurrencyCode = $targetCurrencyCode;
        return $this;
    }

    /**
     * Gets as conversionRate
     *
     * @return float
     */
    public function getConversionRate()
    {
        return $this->conversionRate;
    }

    /**
     * Sets a new conversionRate
     *
     * @param  float $conversionRate
     */
    public function setConversionRate($conversionRate): self
    {
        $this->conversionRate = $conversionRate;
        return $this;
    }

    /**
     * Gets as conversionRateDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getConversionRateDateTime()
    {
        return $this->conversionRateDateTime;
    }

    /**
     * Sets a new conversionRateDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $conversionRateDateTime
     */
    public function setConversionRateDateTime(?\horstoeko\zugferd\entities\extended\udt\DateTimeType $conversionRateDateTime = null): self
    {
        $this->conversionRateDateTime = $conversionRateDateTime;
        return $this;
    }
}
