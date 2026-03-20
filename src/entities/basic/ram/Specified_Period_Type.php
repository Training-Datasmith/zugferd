<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing SpecifiedPeriodType
 *
 * XSD Type: SpecifiedPeriodType
 */
class Specified_Period_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\DateTimeType $startDateTime
     */
    private $start_date_time;
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\DateTimeType $endDateTime
     */
    private $end_date_time;
    /**
     * Gets as startDateTime
     *
     * @return \horstoeko\zugferd\entities\basic\udt\DateTimeType
     */
    public function get_start_date_time()
    {
        return $this->start_date_time;
    }
    /**
     * Sets a new startDateTime
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\DateTimeType $startDateTime
     */
    public function set_start_date_time(?\horstoeko\zugferd\entities\basic\udt\Date_Time_Type $start_date_time = null): self
    {
        $this->start_date_time = $start_date_time;
        return $this;
    }
    /**
     * Gets as endDateTime
     *
     * @return \horstoeko\zugferd\entities\basic\udt\DateTimeType
     */
    public function get_end_date_time()
    {
        return $this->end_date_time;
    }
    /**
     * Sets a new endDateTime
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\DateTimeType $endDateTime
     */
    public function set_end_date_time(?\horstoeko\zugferd\entities\basic\udt\Date_Time_Type $end_date_time = null): self
    {
        $this->end_date_time = $end_date_time;
        return $this;
    }
}