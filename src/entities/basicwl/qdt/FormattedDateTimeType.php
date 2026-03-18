<?php

namespace horstoeko\zugferd\entities\basicwl\qdt;

/**
 * Class representing FormattedDateTimeType
 *
 * XSD Type: FormattedDateTimeType
 */
class FormattedDateTimeType
{

    /**
     * @var \horstoeko\zugferd\entities\basicwl\qdt\FormattedDateTimeType\DateTimeStringAType $dateTimeString
     */
    private $dateTimeString;

    /**
     * Gets as dateTimeString
     *
     * @return \horstoeko\zugferd\entities\basicwl\qdt\FormattedDateTimeType\DateTimeStringAType
     */
    public function getDateTimeString()
    {
        return $this->dateTimeString;
    }

    /**
     * Sets a new dateTimeString
     */
    public function setDateTimeString(\horstoeko\zugferd\entities\basicwl\qdt\FormattedDateTimeType\DateTimeStringAType $dateTimeString): self
    {
        $this->dateTimeString = $dateTimeString;
        return $this;
    }
}
