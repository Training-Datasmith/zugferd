<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\udt;

/**
 * Class representing DateType
 *
 * XSD Type: DateType
 */
class DateType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\DateType\DateStringAType $dateString
     */
    private $dateString;

    /**
     * Gets as dateString
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\DateType\DateStringAType
     */
    public function getDateString()
    {
        return $this->dateString;
    }

    /**
     * Sets a new dateString
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\DateType\DateStringAType $dateString
     */
    public function setDateString(?\horstoeko\zugferd\entities\en16931\udt\DateType\DateStringAType $dateString = null): self
    {
        $this->dateString = $dateString;
        return $this;
    }
}
