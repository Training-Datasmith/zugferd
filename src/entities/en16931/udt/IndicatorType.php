<?php

namespace horstoeko\zugferd\entities\en16931\udt;

/**
 * Class representing IndicatorType
 *
 * XSD Type: IndicatorType
 */
class IndicatorType
{

    /**
     * @var bool $indicator
     */
    private $indicator;

    /**
     * Gets as indicator
     *
     * @return bool
     */
    public function getIndicator()
    {
        return $this->indicator;
    }

    /**
     * Sets a new indicator
     *
     * @param  bool $indicator
     */
    public function setIndicator($indicator): self
    {
        $this->indicator = $indicator;
        return $this;
    }
}
