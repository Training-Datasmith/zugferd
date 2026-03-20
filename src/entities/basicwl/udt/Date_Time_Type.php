<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basicwl\udt;

/**
 * Class representing DateTimeType
 *
 * XSD Type: DateTimeType
 */
class Date_Time_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\DateTimeType\DateTimeStringAType $dateTimeString
     */
    private $date_time_string;
    /**
     * Gets as dateTimeString
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\DateTimeType\DateTimeStringAType
     */
    public function get_date_time_string()
    {
        return $this->date_time_string;
    }
    /**
     * Sets a new dateTimeString
     *
     * @param  \horstoeko\zugferd\entities\basicwl\udt\DateTimeType\DateTimeStringAType $dateTimeString
     */
    public function set_date_time_string(?\horstoeko\zugferd\entities\basicwl\udt\Date_Time_Type\Date_Time_String_A_Type $date_time_string = null): self
    {
        $this->date_time_string = $date_time_string;
        return $this;
    }
}