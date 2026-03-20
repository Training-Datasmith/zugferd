<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing SpecifiedPeriodType
 *
 * XSD Type: SpecifiedPeriodType
 */
class Specified_Period_Type
{
    /**
     * @var string $description
     */
    private $description;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $startDateTime
     */
    private $start_date_time;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $endDateTime
     */
    private $end_date_time;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $completeDateTime
     */
    private $complete_date_time;
    /**
     * Gets as description
     *
     * @return string
     */
    public function get_description()
    {
        return $this->description;
    }
    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function set_description($description): self
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Gets as startDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function get_start_date_time()
    {
        return $this->start_date_time;
    }
    /**
     * Sets a new startDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $startDateTime
     */
    public function set_start_date_time(?\horstoeko\zugferd\entities\extended\udt\Date_Time_Type $start_date_time = null): self
    {
        $this->start_date_time = $start_date_time;
        return $this;
    }
    /**
     * Gets as endDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function get_end_date_time()
    {
        return $this->end_date_time;
    }
    /**
     * Sets a new endDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $endDateTime
     */
    public function set_end_date_time(?\horstoeko\zugferd\entities\extended\udt\Date_Time_Type $end_date_time = null): self
    {
        $this->end_date_time = $end_date_time;
        return $this;
    }
    /**
     * Gets as completeDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function get_complete_date_time()
    {
        return $this->complete_date_time;
    }
    /**
     * Sets a new completeDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $completeDateTime
     */
    public function set_complete_date_time(?\horstoeko\zugferd\entities\extended\udt\Date_Time_Type $complete_date_time = null): self
    {
        $this->complete_date_time = $complete_date_time;
        return $this;
    }
}