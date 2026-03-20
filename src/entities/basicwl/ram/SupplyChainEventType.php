<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing SupplyChainEventType
 *
 * XSD Type: SupplyChainEventType
 */
class Supply_Chain_Event_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\DateTimeType $occurrenceDateTime
     */
    private $occurrence_date_time;
    /**
     * Gets as occurrenceDateTime
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\DateTimeType
     */
    public function get_occurrence_date_time()
    {
        return $this->occurrence_date_time;
    }
    /**
     * Sets a new occurrenceDateTime
     */
    public function set_occurrence_date_time(\horstoeko\zugferd\entities\basicwl\udt\Date_Time_Type $occurrence_date_time): self
    {
        $this->occurrence_date_time = $occurrence_date_time;
        return $this;
    }
}