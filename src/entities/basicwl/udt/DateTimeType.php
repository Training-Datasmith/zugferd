<?php

namespace horstoeko\zugferd\entities\basicwl\udt;

/**
 * Class representing DateTimeType
 *
 * XSD Type: DateTimeType
 */
class DateTimeType
{

    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\DateTimeType\DateTimeStringAType $dateTimeString
     */
    private $dateTimeString;

    /**
     * Gets as dateTimeString
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\DateTimeType\DateTimeStringAType
     */
    public function getDateTimeString()
    {
        return $this->dateTimeString;
    }

    /**
     * Sets a new dateTimeString
     *
     * @param  \horstoeko\zugferd\entities\basicwl\udt\DateTimeType\DateTimeStringAType $dateTimeString
     */
    public function setDateTimeString(?\horstoeko\zugferd\entities\basicwl\udt\DateTimeType\DateTimeStringAType $dateTimeString = null): self
    {
        $this->dateTimeString = $dateTimeString;
        return $this;
    }
}
