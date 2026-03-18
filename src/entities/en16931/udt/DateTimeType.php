<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\udt;

/**
 * Class representing DateTimeType
 *
 * XSD Type: DateTimeType
 */
class DateTimeType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\DateTimeType\DateTimeStringAType $dateTimeString
     */
    private $dateTimeString;

    /**
     * Gets as dateTimeString
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\DateTimeType\DateTimeStringAType
     */
    public function getDateTimeString()
    {
        return $this->dateTimeString;
    }

    /**
     * Sets a new dateTimeString
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\DateTimeType\DateTimeStringAType $dateTimeString
     */
    public function setDateTimeString(?\horstoeko\zugferd\entities\en16931\udt\DateTimeType\DateTimeStringAType $dateTimeString = null): self
    {
        $this->dateTimeString = $dateTimeString;
        return $this;
    }
}
