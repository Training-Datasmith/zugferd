<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basicwl\udt;

/**
 * Class representing IndicatorType
 *
 * XSD Type: IndicatorType
 */
class Indicator_Type
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
    public function get_indicator()
    {
        return $this->indicator;
    }
    /**
     * Sets a new indicator
     *
     * @param  bool $indicator
     */
    public function set_indicator($indicator): self
    {
        $this->indicator = $indicator;
        return $this;
    }
}