<?php

namespace horstoeko\zugferd\entities\basic\qdt;

/**
 * Class representing FormattedDateTimeType
 *
 * XSD Type: FormattedDateTimeType
 */
class FormattedDateTimeType
{

    /**
     * @var \horstoeko\zugferd\entities\basic\qdt\FormattedDateTimeType\DateTimeStringAType $dateTimeString
     */
    private $dateTimeString;

    /**
     * Gets as dateTimeString
     *
     * @return \horstoeko\zugferd\entities\basic\qdt\FormattedDateTimeType\DateTimeStringAType
     */
    public function getDateTimeString()
    {
        return $this->dateTimeString;
    }

    /**
     * Sets a new dateTimeString
     */
    public function setDateTimeString(\horstoeko\zugferd\entities\basic\qdt\FormattedDateTimeType\DateTimeStringAType $dateTimeString): self
    {
        $this->dateTimeString = $dateTimeString;
        return $this;
    }
}
