<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing SpecifiedPeriodType
 *
 * XSD Type: SpecifiedPeriodType
 */
class SpecifiedPeriodType
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\DateTimeType $startDateTime
     */
    private $startDateTime;

    /**
     * @var \horstoeko\zugferd\entities\basic\udt\DateTimeType $endDateTime
     */
    private $endDateTime;

    /**
     * Gets as startDateTime
     *
     * @return \horstoeko\zugferd\entities\basic\udt\DateTimeType
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    /**
     * Sets a new startDateTime
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\DateTimeType $startDateTime
     */
    public function setStartDateTime(?\horstoeko\zugferd\entities\basic\udt\DateTimeType $startDateTime = null): self
    {
        $this->startDateTime = $startDateTime;
        return $this;
    }

    /**
     * Gets as endDateTime
     *
     * @return \horstoeko\zugferd\entities\basic\udt\DateTimeType
     */
    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    /**
     * Sets a new endDateTime
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\DateTimeType $endDateTime
     */
    public function setEndDateTime(?\horstoeko\zugferd\entities\basic\udt\DateTimeType $endDateTime = null): self
    {
        $this->endDateTime = $endDateTime;
        return $this;
    }
}
